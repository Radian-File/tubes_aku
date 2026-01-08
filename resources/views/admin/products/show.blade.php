@extends('layouts.admin')

  @section('title', 'Detail Produk')

  @section('content')
  <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
      <h2 class="section-title">Detail Produk</h2>
      <a href="{{ route('admin.products.index') }}" class="btn btn-back"><i class="fas fa-arrow-left me-2"></i>Kembali ke Produk</a>
  </div>
  @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
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
              <p class="product-info"><strong>Deskripsi:</strong> {{ $product->deskripsi }}</p>
              <p class="product-info"><strong>Kategori:</strong> {{ $product->kategori ?? 'Tidak ada' }}</p>
              <p class="product-info"><strong>Stok:</strong> {{ $product->stok }} pasang</p>
              <p class="product-info"><strong>Kode Produk:</strong> {{ $product->kode_produk ?? 'Tidak ada' }}</p>
              <p class="product-info"><strong>Merk:</strong> {{ $product->merk }}</p>
              <p class="product-info"><strong>Ukuran:</strong> {{ $product->ukuran }}</p>
              <div class="d-flex gap-2 mt-4">
                  <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-action"><i class="fas fa-edit me-2"></i>Edit Produk</a>
                  <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash me-2"></i>Hapus Produk</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  @endsection