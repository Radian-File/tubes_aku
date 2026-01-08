<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickZone - Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ECF0F1 0%, #FFFFFF 100%);
            font-family: 'Open Sans', sans-serif;
            color: #2C3E50;
        }
        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            height: 85vh;
            display: flex;
            align-items: center;
            color: #FFFFFF;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
            border-bottom: 4px solid #F39C12;
        }
        .navbar {
            background-color: #2C3E50;
        }
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: #ECF0F1 !important;
        }
        .nav-link {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            color: #ECF0F1 !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #F39C12 !important;
        }
        .btn-login {
            background-color: #F39C12;
            border-color: #F39C12;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 8px 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-login:hover {
            background-color: #E67E22;
            border-color: #E67E22;
            transform: scale(1.05);
        }
        .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background-color: #FFFFFF;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        .card:hover .card-img-top {
            transform: scale(1.1);
        }
        .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #2C3E50;
        }
        .card-text {
            font-family: 'Open Sans', sans-serif;
            color: #7F8C8D;
            font-weight: 500;
        }
        .btn-view {
            background-color: #2C3E50;
            border-color: #2C3E50;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-view:hover {
            background-color: #34495E;
            border-color: #34495E;
            transform: scale(1.05);
        }
        .btn-shop {
            background-color: #F39C12;
            border-color: #F39C12;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 12px 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-shop:hover {
            background-color: #E67E22;
            border-color: #E67E22;
            transform: scale(1.05);
        }
        footer {
            background-color: #2C3E50;
            color: #ECF0F1;
            font-family: 'Open Sans', sans-serif;
        }
        footer a {
            color: #ECF0F1;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        footer a:hover {
            color: #F39C12;
        }
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #2C3E50;
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            width: 60px;
            height: 3px;
            background-color: #F39C12;
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">KickZone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-login ms-2" href="/login">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4">Temukan Sepatu Impianmu!</h1>
            <p class="lead mb-5">Koleksi sepatu stylish dan nyaman untuk setiap gaya dan momen.</p>
            <a href="/login" class="btn btn-shop">Belanja Sekarang</a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title mb-5 text-center">Sepatu Unggulan</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Product Card 1 -->
                <div class="col">
                    <div class="card h-100">
                        <img src="https://down-id.img.susercontent.com/file/2a368a77a3d3c2dd82ab6558132fbbe3" class="card-img-top" alt="Sneaker 1">
                        <div class="card-body">
                            <h5 class="card-title">Sneaker Putih Klasik</h5>
                            <p class="card-text">Rp 750.000</p>
                            <a href="/login" class="btn btn-view w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Product Card 2 -->
                <div class="col">
                    <div class="card h-100">
                        <img src="https://images.unsplash.com/photo-1607522370275-f14206abe5d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Sneaker 2">
                        <div class="card-body">
                            <h5 class="card-title">Sepatu Running Hitam</h5>
                            <p class="card-text">Rp 900.000</p>
                            <a href="/login" class="btn btn-view w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Product Card 3 -->
                <div class="col">
                    <div class="card h-100">
                        <img src="https://down-id.img.susercontent.com/file/id-11134207-7r98p-lv4al4a4opj190" class="card-img-top" alt="Sneaker 3">
                        <div class="card-body">
                            <h5 class="card-title">Sneaker Kasual Abu</h5>
                            <p class="card-text">Rp 650.000</p>
                            <a href="/login" class="btn btn-view w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container text-center">
            <p>© 2025 KickZone. Hak Cipta Dilindungi.</p>
            <p>
                <a href="#" class="mx-2">Kontak Kami</a> |
                <a href="#" class="mx-2">Kebijakan Privasi</a> |
                <a href="#" class="mx-2">Syarat & Ketentuan</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>