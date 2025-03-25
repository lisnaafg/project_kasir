<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LIS' Modest Wear</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #b4ccea;
        }
        .glow {
            box-shadow: 0 0 20px rgba(30, 54, 112, 0.5);
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    .float-animation {
        animation: float 2s ease-in-out infinite;
    }
       /* Efek Animasi Gradient Bergerak */
    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Efek Glow di Background */
    @keyframes glowEffect {
        0%, 100% { box-shadow: 0 0 30px rgba(30, 54, 112, 0.5); }
        50% { box-shadow: 0 0 50px rgba(30, 54, 112, 0.8); }
    }

    /* Terapkan pada background biru */
    .curved-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 30%;
        height: 100%;
        background: linear-gradient(45deg, #1e3a8a, #3f76cf, #1e40af, #a3cdff);
        background-size: 400% 400%;
        border-top-right-radius: 400px;
        border-bottom-right-radius: 100px;
        z-index: -1;
        filter: blur(1px); /* Efek blur ringan untuk transisi lebih smooth */
        animation: gradientMove 4s ease-in-out infinite alternate, glowEffect 2.5s infinite alternate;
    }

        /* Efek Animasi Muncul */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-out forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Efek Gradasi pada Teks */
        .gradient-text {
            background: linear-gradient(to right, #1e3670, #4a90e2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Efek Hover & Klik untuk Tombol */
        .btn-primary {
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #263847;
            transform: scale(1.05);
        }
        .btn-primary:active {
            transform: scale(0.95);
        }

        .btn-secondary {
            transition: all 0.3s ease-in-out;
        }
        .btn-secondary:hover {
            background-color: #1e3670;
            color: white;
            transform: scale(1.05);
        }
        .btn-secondary:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="curved-background"></div>
    
    
    <nav class="absolute top-4 right-4 flex items-center gap-4">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary bg-[#1e3670] text-white px-4 py-2 rounded-md hover:bg-[#263847] transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary bg-[#1e3670] text-white px-6 py-2 rounded-full mr-4">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-secondary bg-white text-[#1e3670] border border-[#1e3670] px-4 py-2 rounded-md hover:bg-[#1e3670] hover:text-white transition">Register</a>
                @endif
            @endauth
        @endif
    </nav>

    <div class="container mx-auto px-4 py-8 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 relative">
            <img alt="Fashion model wearing modest clothing" class="rounded-full mx-auto glow float-animation" height="380" src={{ asset('images/foto1.png') }} width="380"/>
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4 rounded-lg shadow-lg glow">
                <img src="{{ asset('images/logo1.png') }}" alt="Khimar" class="w-12 h-12 mx-auto">
            </div>
            {{-- <div class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white p-4 rounded-lg shadow-lg glow">
                <span class="text-gray-800 font-bold text-lg">13.4K+</span>
                <p class="text-gray-600 text-sm">Pelanggan Bahagia</p>
            </div> --}}
        </div>

        <div class="text-center md:text-left md:w-1/2">
            <span class="text-[#1e3670] font-bold text-3xl gradient-text fade-in">
                Welcome to LIS' Modest Wear
            </span>
            <h1 class="text-4xl font-bold text-gray-800 mt-2 fade-in">
                Discover Modest & Elegant Muslimah Fashion
            </h1>
            <p class="text-gray-600 mt-4 fade-in">
                LIS' Modest Wear menghadirkan koleksi busana muslimah yang memancarkan kesan syar’i, anggun, dan penuh kenyamanan. Temukan keindahan dalam setiap detail abaya, gamis, khimar, dan beragam outfit elegan yang dirancang untuk memenuhi nilai-nilai Islami tanpa meninggalkan sentuhan modern.
            </p>
            <div class="mt-6">
              
                <a href="/koleksi" class="btn-secondary bg-white text-[#1e3670] border border-[#1e3670] px-6 py-2 rounded-full float-animation inline-block text-center">
                    Jelajahi Koleksi
                </a>
                
            </div>
        </div>
    </div>
</body>
</html>
