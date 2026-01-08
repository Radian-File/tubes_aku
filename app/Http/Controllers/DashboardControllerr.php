<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardControllerr extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::where('stok', '>', 0)
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode_produk', 'like', "%{$search}%");
            })
            ->paginate(6);
        return view('user.dashboard', compact('products', 'search'));
    }
}