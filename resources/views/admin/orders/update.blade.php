@extends('layouts.admin')

@section('title', 'Ubah Status Pesanan')

@section('content')
<div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">
    <h2 class="section-title">Ubah Status Pesanan #{{ $order->id }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-back">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="mt-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="status" class="form-label">Status Pesanan</label>
        <select name="status" id="status" class="form-select" required>
            <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Perbarui Status</button>
</form>
@endsection