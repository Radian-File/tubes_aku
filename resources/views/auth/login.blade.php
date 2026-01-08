@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #ECF0F1 0%, #FFFFFF 100%);
            font-family: 'Open Sans', sans-serif;
            color: #2C3E50;
            height: 100vh;
        }

        .login-card {
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

        .login-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .form-section {
            padding: 80px;
        }
    </style>

    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row login-card bg-white w-100">
            <!-- Image Section -->
            <div class="col-md-6 d-none d-md-block p-0">
                <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Sneaker" class="img-fluid left-image">
            </div>

            <!-- Form Section -->
            <div class="col-md-6 form-section">
                <h3 class="login-title mb-4">Masuk ke KickZone</h3>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }} </div>
                @endif
                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required
                            autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                </form>
                <p class="mt-3 text-center">
                    Belum punya akun? <a href="{{ route('register') }}" style="color:#F39C12;">Daftar disini</a>
                </p>
            </div>
        </div>
    </div>
@endsection