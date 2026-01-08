<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickZone - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: linear-gradient(135deg, #ECF0F1 0%, #FFFFFF 100%);
            font-family: 'Open Sans', sans-serif;
            color: #2C3E50;
            transition: margin-left 0.4s ease-in-out;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #2C3E50 0%, #34495E 100%);
            position: fixed;
            top: 0;
            left: -260px;
            transition: left 0.4s ease-in-out;
            z-index: 1000;
            color: #ECF0F1;
            font-family: 'Open Sans', sans-serif;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 2px solid #F39C12;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar-header h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #ECF0F1;
            margin: 0;
            font-size: 1.6rem;
            letter-spacing: 1px;
        }

        .sidebar-header img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
            border-radius: 50%;
            border: 2px solid #F39C12;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar-menu li {
            padding: 15px 20px;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
        }

        .sidebar-menu li.logout {
            margin-top: auto;
        }

        .sidebar-menu li a {
            color: #ECF0F1;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .sidebar-menu li a i {
            margin-right: 15px;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-menu li:hover {
            background-color: #F39C12;
            padding-left: 25px;
        }

        .sidebar-menu li:hover a {
            color: #2C3E50;
        }

        .sidebar-menu li.active {
            background-color: #34495E;
            border-left: 4px solid #F39C12;
        }

        .sidebar-menu li.active a {
            color: #F39C12;
        }

        .content-wrapper {
            transition: margin-left 0.4s ease-in-out;
        }

        .content-wrapper.active {
            margin-left: 260px;
        }

        .navbar-toggler-sidebar {
            border: none;
            background: transparent;
            color: #2C3E50;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            font-size: 1.5rem;
        }

        .navbar-toggler-sidebar:focus {
            outline: none;
        }

        .dashboard-header {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .dashboard-header h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #2C3E50;
            margin: 0;
        }

        .card-img-top {
            height: 200px;
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
            font-size: 1.1rem;
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

        .btn-add {
            background-color: #F39C12;
            border-color: #F39C12;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-add:hover {
            background-color: #E67E22;
            border-color: #E67E22;
            transform: scale(1.05);
        }

        .search-bar {
            max-width: 300px;
        }

        .search-bar input {
            border-radius: 8px 0 0 8px;
        }

        .search-bar button {
            border-radius: 0 8px 8px 0;
            background-color: #F39C12;
            border-color: #F39C12;
        }

        .search-bar button:hover {
            background-color: #E67E22;
            border-color: #E67E22;
        }

        .edit-product-card,
        .product-detail-card {
            border: none;
            border-radius: 12px;
            background-color: #FFFFFF;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #2C3E50;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            font-family: 'Open Sans', sans-serif;
            color: #2C3E50;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #F39C12;
            box-shadow: 0 0 5px rgba(243, 156, 18, 0.5);
        }

        .btn-action {
            background-color: #F39C12;
            border-color: #F39C12;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-action:hover {
            background-color: #E67E22;
            border-color: #E67E22;
            transform: scale(1.05);
        }

        .btn-back {
            background-color: #2C3E50;
            border-color: #2C3E50;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-back:hover {
            background-color: #34495E;
            border-color: #34495E;
            transform: scale(1.05);
        }

        .product-image {
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #2C3E50;
            font-size: 1.8rem;
        }

        .product-price {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #F39C12;
            font-size: 1.5rem;
        }

        .product-info {
            font-family: 'Open Sans', sans-serif;
            color: #7F8C8D;
            font-size: 1rem;
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

        @media (max-width: 991px) {
            .sidebar {
                width: 220px;
                left: -220px;
            }

            .content-wrapper.active {
                margin-left: 220px;
            }

            .sidebar-header h3 {
                font-size: 1.4rem;
            }

            .sidebar-menu li a {
                font-size: 0.95rem;
            }

            .sidebar-menu li a i {
                font-size: 1.1rem;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.3rem;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>KickZone</h3>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}"><i class="fas fa-box"></i> Kelola Produk</a>
            </li>
            <li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-cart"></i> Daftar Pesanan</a>
            </li>
            <li class="logout">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="content-wrapper" id="contentWrapper">
        <button class="navbar-toggler-sidebar" type="button" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <section class="py-5">
            <div class="container">
                @yield('content')
            </div>
        </section>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const contentWrapper = document.getElementById('contentWrapper');
            sidebar.classList.toggle('active');
            contentWrapper.classList.toggle('active');
        }
    </script>
    @yield('scripts')
</body>

</html>
