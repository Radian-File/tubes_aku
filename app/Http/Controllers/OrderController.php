<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar pesanan.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $orders = Order::with(['user', 'product'])
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('admin.orders.index', compact('orders', 'search'));
    }

    /**
     * Tampilkan detail pesanan.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:diproses,dikirim,selesai',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui.');
}
}