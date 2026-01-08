@extends('layouts.admin')

  @section('title', 'Tambah Produk')

  @section('content')
  <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
      <h2 class="section-title">Tambah Produk</h2>
      <a href="{{ route('admin.products.index') }}" class="btn btn-back"><i class="fas fa-arrow-left me-2"></i>Kembali ke Produk</a>
  </div>
  <div class="edit-product-card">
      <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="nama" class="form-label">Nama Produk</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                      @error('nama')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="harga" class="form-label">Harga</label>
                      <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                      @error('harga')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="deskripsi" class="form-label">Deskripsi</label>
                      <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi') }}</textarea>
                      @error('deskripsi')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="kategori" class="form-label">Kategori</label>
                      <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                          <option value="">Pilih Kategori</option>
                          <option value="Kasual" {{ old('kategori') == 'Kasual' ? 'selected' : '' }}>Kasual</option>
                          <option value="Running" {{ old('kategori') == 'Running' ? 'selected' : '' }}>Running</option>
                          <option value="Sporty" {{ old('kategori') == 'Sporty' ? 'selected' : '' }}>Sporty</option>
                          <option value="Formal" {{ old('kategori') == 'Formal' ? 'selected' : '' }}>Formal</option>
                      </select>
                      @error('kategori')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="stok" class="form-label">Stok</label>
                      <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" required>
                      @error('stok')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="kode_produk" class="form-label">Kode Produk</label>
                      <input type="text" name="kode_produk" class="form-control @error('kode_produk') is-invalid @enderror" value="{{ old('kode_produk') }}" required>
                      @error('kode_produk')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="merk" class="form-label">Merk</label>
                      <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ old('merk') }}" required>
                      @error('merk')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="ukuran" class="form-label">Ukuran</label>
                      <input type="text" name="ukuran" class="form-control @error('ukuran') is-invalid @enderror" value="{{ old('ukuran') }}" required>
                      @error('ukuran')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="gambar" class="form-label">Gambar Produk</label>
                      <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" required>
                      @error('gambar')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
          </div>
          <div class="d-flex gap-2 mt-4">
              <button type="submit" class="btn btn-action"><i class="fas fa-save me-2"></i>Simpan</button>
              <a href="{{ route('admin.products.index') }}" class="btn btn-back">Batal</a>
          </div>
      </form>
  </div>
  @endsection