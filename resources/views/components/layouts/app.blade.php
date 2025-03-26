<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LIS' Modest Wear</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #dfe2df;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #1e3670;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #71869f;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .user-info {
            margin-bottom: 20px;
            padding: 10px;
            font-weight: bold;
            text-align: center;
            color: #dfe2df;
        }
        .user-info i {
            color: #71869f;
        }
        .logout {
            color: #ff4d4d;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="d-flex">
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <h4 class="text-center fw-bold text-white">LIS' Modest Wear</h4>
                    <div class="user-info">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </div>

                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                    
                    @if(strtolower(Auth::user()->role) == 'admin')
                        <a href="{{ route('user') }}" class="{{ request()->routeIs('user') ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Pengguna
                        </a>
                        <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk') ? 'active' : '' }}">
                            <i class="bi bi-bag"></i> Produk
                        </a>
                    @endif
                    
                    @if(strtolower(Auth::user()->role) == 'kasir')
                    <a href="{{ route('transaksi') }}" class="{{ request()->routeIs('transaksi') ? 'active' : '' }}">
                        <i class="bi bi-cash"></i> Transaksi
                    </a>
                    @endif

                    <a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-data"></i> Laporan
                    </a>
                </div>

                <!-- Logout Button -->
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            <!-- Content -->
            <div class="content">
                <main class="py-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html>
