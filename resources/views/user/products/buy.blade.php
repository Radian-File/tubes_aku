@extends('layouts.user')

@section('title', 'Beli {{ $product->nama }}')

@section('styles')
<style>
    .checkmark-container {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        position: relative;
    }
    .checkmark-circle {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: #28A745;
        position: relative;
        animation: circle-grow 0.5s ease-out forwards;
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    .checkmark {
        width: 40px;
        height: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        opacity: 0;
        animation: check-draw 0.4s ease-in-out 0.5s forwards;
    }
    .checkmark::before {
        content: '';
        position: absolute;
        width: 8px;
        height: 20px;
        background: #FFFFFF;
        left: 0;
        border-radius: 2px;
    }
    .checkmark::after {
        content: '';
        position: absolute;
        width: 28px;
        height: 8px;
        background: #FFFFFF;
        bottom: 0;
        left: 8px;
        border-radius: 2px;
    }
    @keyframes circle-grow {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        60% {
            transform: scale(1.1);
            opacity: 1;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    @keyframes check-draw {
        to {
            opacity: 1;
        }
    }
    .checkmark-circle::after {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border-radius: 50%;
        background: rgba(40, 167, 69, 0.3);
        animation: pulse 1s ease-out 0.9s infinite;
    }
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.7;
        }
        70% {
            transform: scale(1.2);
            opacity: 0;
        }
        100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-header">
    <h2 class="section-title">Pembelian Produk</h2>
</div>

<div class="product-detail-card">
    <div class="row">
        <div class="col-md-6">
            @if ($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" class="product-image w-100" alt="{{ $product->nama }}">
            @else
                <img src="https://via.placeholder.com/400?text=No+Image" class="product-image w-100" alt="No Image">
            @endif
        </div>
        <div class="col-md-6">
            <h3 class="product-title">{{ $product->nama }}</h3>
            <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            <p class="product-info"><strong>Stok:</strong> {{ $product->stok }} unit</p>
            <p class="product-info"><strong>Ukuran Tersedia:</strong> {{ $product->ukuran }}</p>

            <form id="orderForm" action="{{ route('user.orders.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $product->stok }}" value="1" required>
                </div>
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer_bank">Transfer Bank</option>
                        <option value="kartu_kredit">Kartu Kredit</option>
                        <option value="cod">Cash on Delivery (COD)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Pengiriman</label>
                    <textarea name="address" id="address" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <p class="product-info"><strong>Total Harga:</strong> <span id="total_price">Rp {{ number_format($product->harga, 0, ',', '.') }}</span></p>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-action w-50" id="confirmButton">Konfirmasi Pesanan</button>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-back w-50">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Loading -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-warning" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Memproses pesanan...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="checkmark-container">
                    <div class="checkmark-circle">
                        <div class="checkmark"></div>
                    </div>
                </div>
                <p>Pesanan Anda telah berhasil diproses! Anda akan diarahkan ke riwayat pesanan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-action" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const quantityInput = document.getElementById('quantity');
    const totalPriceSpan = document.getElementById('total_price');
    const pricePerUnit = {{ $product->harga }};
    const form = document.getElementById('orderForm');
    const confirmButton = document.getElementById('confirmButton');
    const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'), { backdrop: 'static', keyboard: false });
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));

    // Update total harga saat quantity berubah
    quantityInput.addEventListener('input', function () {
        const quantity = parseInt(this.value) || 1;
        const total = pricePerUnit * quantity;
        totalPriceSpan.textContent = 'Rp ' + total.toLocaleString('id-ID');
    });

    // Animasi loading dan modal sukses saat submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        confirmButton.disabled = true;
        loadingModal.show();

        setTimeout(() => {
            loadingModal.hide();
            successModal.show();

            // Kirim form setelah modal sukses ditutup
            successModal._element.addEventListener('hidden.bs.modal', function () {
                form.submit();
            }, { once: true });
        }, 2000);
    });
</script>
@endsection