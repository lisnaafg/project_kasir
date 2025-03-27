<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #a1cee5;
        }
        .hero {
            background: url('{!! asset('images/logo1.png') !!}') center/cover no-repeat;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }
        .hero-content {
            padding: 20px 30px;
            text-align: center;
            max-width: 500px;
            margin: auto;
        }
        .hero-content h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #1e3670;
        }
        .hero-content p {
            font-size: 1.2rem;
            color: #71869f;
            margin-bottom: 15px;
        }
        .hero-content .btn {
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #263847;
            color: white;
        }
        .featured-products {
            text-align: center;
            margin-top: 30px;
        }
        .product-card {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 250px;
            margin: auto;
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <div class="hero"></div>
    <div class="hero-content">
        <h1>LIS' Modest Wear</h1>
        <p>Temukan koleksi terbaik kami, mulai dari Abaya, Khimar, Phasmina, hingga pakaian syar'i berkualitas.</p>
        
    </div>

    <!-- Featured Products Section -->
    <div class="container featured-products">
        <h3 class="mt-5">Produk Pilihan</h3>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/khimar2.jpg') }}" alt="Khimar" class="img-fluid">
                    <p>Khimar Syari</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/phasmina2.jpg') }}" alt="Phasmina" class="img-fluid">
                    <p>Phasmina Cashmere</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/abaya.jpg') }}" alt="Abaya" class="img-fluid">
                    <p>Abaya Dubai</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/phasmina1.jpg') }}" alt="Phasmina" class="img-fluid">
                    <p>Phasmina Premium</p>
                </div>          
            </div>

            <!-- Row 2 -->
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/khimar1.jpg') }}" alt="Khimar" class="img-fluid">
                    <p>Khimar Elegant</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/phasmina1.jpg') }}" alt="Phasmina" class="img-fluid">
                    <p>Phasmina Casual</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/abaya dubai.jpg') }}" alt="Abaya Dubai" class="img-fluid">
                    <p>Abaya Dubai Exclusive</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-card">
                    <img src="{{ asset('images/phasmina1.jpg') }}" alt="Phasmina" class="img-fluid">
                    <p>Phasmina Soft</p>
                </div>          
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
