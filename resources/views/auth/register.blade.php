@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ECF0F1 0%, #FFFFFF 100%);
        font-family: 'Open Sans', sans-serif;
        color: #2C3E50;
        height: 100vh;
    }

    .register-card {
        max-width: 900px;
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #F39C12;
        border: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary:hover {
        background-color: #E67E22;
    }

    .left-image {
        object-fit: cover;
        height: 100%;
    }

    .register-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
    }

    .form-section {
        padding: 40px;
    }
</style>

<div class="container h-100 d-flex align-items-center justify-content-center">
    <div class="row register-card bg-white w-100">
        <!-- Image Section -->
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="https://images.unsplash.com/photo-1552346094-f0742e13b3b8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                 alt="Sneaker" class="img-fluid left-image">
        </div>

        <!-- Form Section -->
        <div class="col-md-6 form-section">
            <h3 class="register-title mb-4">Daftar Akun KickZone</h3>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
            <p class="mt-3 text-center">
                Sudah punya akun? <a href="{{ route('login') }}" style="color:#F39C12;">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection