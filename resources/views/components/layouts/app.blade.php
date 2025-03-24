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

    <style>
        body {
            background-color: #fceff379;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #db8fa6;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #ADB8D6;
            color: white;
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
            color: #333;
        }
        .logout {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="d-flex">
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <h4 class="text-center fw-bold">LIS' Modest Wear</h4>

                    <!-- Tampilkan Nama Pengguna -->
                    <div class="user-info">
                        👤 {{ Auth::user()->name }}
                    </div>

                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>

                    @if(strtolower(Auth::user()->role) == 'admin')
                        <a href="{{ route('user') }}" class="{{ request()->routeIs('user') ? 'active' : '' }}">Pengguna</a>
                        <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk') ? 'active' : '' }}">Produk</a>
                    @endif

                    <a href="{{ route('transaksi') }}" class="{{ request()->routeIs('transaksi') ? 'active' : '' }}">Transaksi</a>
                    <a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'active' : '' }}">Laporan</a>
                </div>

                <!-- Logout Button -->
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">
                    Logout
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
