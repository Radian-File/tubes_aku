@extends('layouts.user')

  @section('title', 'Dashboard Pengguna')

  @section('content')
  <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
      <h2 class="section-title">Katalog Sepatu</h2>
      <div class="d-flex align-items-center flex-wrap gap-2">
          <form class="search-bar input-group" method="GET" action="{{ route('user.dashboard') }}">
              <input type="text" name="search" class="form-control" placeholder="Cari sepatu..." value="{{ $search ?? '' }}">
              <button class="btn" type="submit"><i class="fas fa-search"></i></button>
          </form>
      </div>
  </div>
  <h3 class="section-title mb-4 text-center">Daftar Sepatu</h3>
  <div class="row row-cols-1 row-cols-md-3 g-4">
      @forelse ($products as $product)
          <div class="col">
              <div class="card h-100">
                  @if ($product->gambar)
                      <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama }}">
                  @else
                      <img src="https://via.placeholder.com/200?text=No+Image" class="card-img-top" alt="No Image">
                  @endif
                  <div class="card-body">
                      <h5 class="card-title">{{ $product->nama }}</h5>
                      <p class="card-text">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                      <div class="d-flex gap-2">
                          <a href="{{ route('user.products.show', $product) }}" class="btn btn-view w-50">Detail</a>
                          <a href="{{ route('user.products.buy', $product) }}" class="btn btn-add w-50"><i class="fas fa-shopping-cart"></i> Beli</a>
                      </div>
                  </div>
              </div>
          </div>
      @empty
          <div class="col-12 text-center">
              <p>Belum ada sepatu tersedia.</p>
          </div>
      @endforelse
  </div>
  <nav aria-label="Page navigation" class="mt-5 d-flex justify-content-center">
      {{ $products->links() }}
  </nav>
  @endsection