<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah total produk terjual
        $totalProductsSold = Order::sum('quantity');

        // Produk terlaris
        $topSellingProduct = Order::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->first()
            ?->product;

        // Data penjualan per bulan
        $salesData = Order::select(
                DB::raw('MONTH(tanggal_pesan) as month'),
                DB::raw('YEAR(tanggal_pesan) as year'),
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->groupBy('month', 'year')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => date('F Y', mktime(0, 0, 0, $item->month, 1, $item->year)),
                    'value' => $item->total_quantity,
                ];
            });

        // Distribusi rating
        $ratingDistribution = Review::select('rating', DB::raw('COUNT(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => "Rating {$item->rating}",
                    'value' => $item->count,
                ];
            });

        // Komentar terbaru (semua)
        $comments = Review::with(['user', 'product', 'order'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.dashboard', compact(
            'totalProductsSold',
            'topSellingProduct',
            'salesData',
            'ratingDistribution',
            'comments'
        ));
    }
}
