@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
    <h2 class="section-title">Detail Pesanan</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-back">
        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pesanan
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="product-detail-card mt-4">
    <div class="row">
        <!-- <div class="col-md-6">
            @if ($order->product && $order->product->gambar)
                <img src="{{ asset('storage/' . $order->product->gambar) }}" class="product-image w-100" alt="{{ $order->product->nama }}">
            @else
                <img src="https://via.placeholder.com/400?text=No+Image" class="product-image w-100" alt="No Image">
            @endif
        </div> -->
        <div class="col-md-6">
            <h3 class="product-title">Pesanan #{{ $order->id }}</h3>
            <p class="product-info"><strong>Nama Pelanggan:</strong> {{ $order->user->name ?? 'Tidak diketahui' }}</p>
            <p class="product-info"><strong>Produk:</strong> {{ $order->product->nama ?? 'Tidak diketahui' }}</p>
            <p class="product-info">
                <strong>Status:</strong>
                <span class="badge 
                    @if($order->status == 'diproses') bg-warning 
                    @elseif($order->status == 'dikirim') bg-info 
                    @elseif($order->status == 'selesai') bg-success 
                    @else bg-secondary 
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p class="product-info"><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
            <p class="product-info"><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($order->tanggal_pesan)->translatedFormat('d F Y') }}</p>
            <p class="product-info"><strong>Alamat:</strong> {{ $order->alamat ?? 'Tidak diketahui' }}</p>

            <div class="d-flex gap-2 mt-4">
                @if ($order->status === 'diproses')
                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="dikirim">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin mengirim pesanan ini?')">
                            <i class="fas fa-truck me-2"></i>Kirim Sekarang
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection