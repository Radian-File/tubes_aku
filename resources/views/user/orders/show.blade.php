@extends('layouts.user')

@section('title', 'Detail Pesanan')

@section('styles')
<style>
    .star-rating {
        display: inline-flex;
        font-size: 1.5rem;
        cursor: pointer;
    }
    .star-rating .star {
        color: #d3d3d3; /* Abu-abu untuk bintang kosong */
        transition: color 0.2s ease;
        margin-right: 5px;
    }
    .star-rating .star.selected {
        color: #F39C12; /* Kuning untuk bintang terpilih */
    }
    .star-rating .star:hover,
    .star-rating .star.hovered {
        color: #F39C12; /* Kuning saat hover */
    }
    .star-rating .star:active {
        transform: scale(1.1); /* Efek membesar saat klik */
    }
</style>
@endsection

@section('content')
<div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
    <h2 class="section-title">Detail Pesanan #{{ $order->id }}</h2>
    <a href="{{ route('user.riwayat') }}" class="btn btn-back">
        <i class="fas fa-arrow-left me-2"></i>Kembali ke Riwayat
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="product-detail-card mt-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="product-title">Pesanan #{{ $order->id }}</h3>
            <p class="product-info"><strong>Produk:</strong> {{ $order->product->nama ?? 'Tidak diketahui' }}</p>
            <p class="product-info"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
            <p class="product-info"><strong>Metode Pembayaran:</strong> {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
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

            @if ($order->status === 'dikirim' && !$order->review)
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#completeOrderModal">
                        <i class="fas fa-check me-2"></i>Pesanan Selesai
                    </button>
                </div>
            @endif

            @if ($order->review)
                <div class="mt-4">
                    <h4 class="section-title">Ulasan Anda</h4>
                    <p><strong>Rating:</strong> {{ str_repeat('⭐', $order->review->rating) }}</p>
                    <p><strong>Komentar:</strong> {{ $order->review->comment ?? 'Tidak ada komentar' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Pesanan Selesai dan Ulasan -->
<div class="modal fade" id="completeOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pesanan Selesai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('user.orders.complete', $order) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p>Apakah Anda yakin pesanan ini telah selesai? Berikan ulasan untuk produk ini:</p>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1-5)</label>
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star" data-value="{{ $i }}"><i class="fas fa-star"></i></span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" required>
                        @error('rating')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar (Opsional)</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Konfirmasi & Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const value = parseInt(this.getAttribute('data-value'));
            ratingInput.value = value;

            // Reset semua bintang
            stars.forEach(s => s.classList.remove('selected'));

            // Tandai bintang 1 sampai yang diklik sebagai selected
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('selected');
            }
        });

        star.addEventListener('mouseover', function () {
            const value = parseInt(this.getAttribute('data-value'));

            // Reset hover
            stars.forEach(s => s.classList.remove('hovered'));

            // Tandai bintang 1 sampai yang dihover sebagai hovered
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('hovered');
            }
        });

        star.addEventListener('mouseout', function () {
            // Hapus semua hover
            stars.forEach(s => s.classList.remove('hovered'));
        });
    });
</script>
@endsection