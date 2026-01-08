@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('styles')
<style>
    .table thead th {
        background-color: #34495E; /* Warna latar kuning/oranye */
        color: #FFFFFF; /* Teks putih */
        font-weight: 600; /* Tebal untuk header */
        padding: 12px; /* Padding untuk ruang */
        text-align: center; /* Teks rata tengah */
    }
</style>
@endsection

@section('content')
<div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
    <h2 class="section-title">Manajemen Pesanan</h2>
    <div class="d-flex align-items-center flex-wrap gap-2">
        <form class="search-bar input-group" method="GET" action="{{ route('admin.orders.index') }}">
            <input type="text" name="search" class="form-control" placeholder="Cari pesanan..." value="{{ $search ?? '' }}">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <!-- <a href="{{ route('admin.products.index') }}" class="btn btn-back"><i class="fas fa-arrow-left me-2"></i>Kembali ke Produk</a> -->

    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h3 class="section-title mb-4 text-center">Daftar Pesanan</h3>
<div class="table-responsive mt-4">
    <table class="table table-striped table-hover align-middle text-center shadow-sm border rounded">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Produk</th>
                <th scope="col">Banyak Pesanan</th>
                <th scope="col">Metode Bayar</th>
                <th scope="col">Status</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->product->nama }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</td>
                <td>
                    @php
                        $statusClass = [
                            'diproses' => 'warning',
                            'dikirim' => 'info',
                            'selesai' => 'success',
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusClass[$order->status] ?? 'secondary' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="fw-semibold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($order->tanggal_pesan)->format('d M Y') }}</td>
                <td>{{ $order->alamat }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<nav aria-label="Page navigation" class="mt-4 d-flex justify-content-center">
    <nav>
            <ul class="pagination justify-content-center align-items-center gap-2">
                {{-- Tombol Previous --}}
                @if ($orders->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                {{-- Info halaman --}}
                <li class="page-item disabled">
                    <span class="page-link bg-light border-0 text-dark">
                        Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}
                    </span>
                </li>

                {{-- Tombol Next --}}
                @if ($orders->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
</nav>
@endsection