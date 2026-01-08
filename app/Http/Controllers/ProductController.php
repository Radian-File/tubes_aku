<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('kode_produk', 'like', "%{$search}%");
        })->paginate(6);
        return view('admin.products.index', compact('products', 'search'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'ukuran' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:products,kode_produk',
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.products.show', compact('product'));
        } else {
            return view('user.products.show', compact('product'));
        }
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'ukuran' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:products,kode_produk,' . $product->id,
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function buy(Product $product)
    {
        return view('user.products.buy', compact('product'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:transfer_bank,kartu_kredit,cod',
            'address' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stok < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        $totalHarga = $product->harga * $request->quantity;

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'payment_method' => $request->payment_method,
            'status' => 'diproses',
            'total_harga' => $totalHarga,
            'tanggal_pesan' => now()->toDateString(),
            'alamat' => $request->address,
        ]);

        $product->stok -= $request->quantity;
        $product->save();

        return redirect()->route('user.riwayat')->with('success', 'Pembayaran berhasil!');
    }

    public function riwayat()
    {
        $orders = Order::where('user_id', Auth::id())->with(['product', 'review'])->latest()->get();
        return view('user.riwayat', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        $order->load(['product', 'review']);
        return view('user.orders.show', compact('order'));
    }

    public function completeOrder(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'dikirim' || $order->review) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        $order->update(['status' => 'selesai']);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $order->product_id,
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('user.orders.show', $order)->with('success', 'Pesanan selesai dan ulasan telah dikirim!');
    }
}