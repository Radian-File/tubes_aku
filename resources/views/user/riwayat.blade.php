@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('styles')
<style>
    .table thead th {
        background-color: #34495E; /* Warna latar kuning/oranye */
        color: #FFFFFF; /* Teks putih */
        font-weight: 600; /* Tebal untuk header */
        padding: 12px; /* Padding untuk ruang */
        text-align: center; /* Teks rata tengah */
        border-color:rgb(9, 43, 71); /* Border sedikit lebih gelap */
    }
</style>
@endsection

@section('content')
<div class="dashboard-header">
    <h2 class="section-title">Riwayat Pesanan</h2>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle text-center shadow-sm border rounded">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Metode Pembayaran</th>
                <th>Total Harga</th>
                <th>Tanggal Pesan</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->product->nama }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->tanggal_pesan }}</td>
                    <td>{{ $order->alamat }}</td>
                    <td>{{ ucwords($order->status) }}</td>
                    <td>
                        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection