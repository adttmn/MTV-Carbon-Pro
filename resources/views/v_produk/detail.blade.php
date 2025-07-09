@extends('v_layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="section-title">
            <h3 class="title">Informasi Produk</h3>
        </div>

        <!-- msgSuccess -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <!-- end msgSuccess -->
        <!-- msgError -->
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('error') }}</strong>
            </div>
        @endif
        <!-- end msgError -->

        <div class="product-detail-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery">
                        <div class="main-image">
                            <img src="{{ asset('storage/img-produk/' . $row->foto) }}" alt="{{ $row->nama_produk }}"
                                class="img-fluid">
                        </div>
                        <div class="product-badge">
                            <span class="badge badge-primary">{{ $row->kategori->nama_kategori }}</span>
                            @if ($row->stok > 0)
                                <span class="badge badge-success">In Stock</span>
                            @else
                                <span class="badge badge-danger">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-info">
                        <h1 class="product-title">{{ $row->nama_produk }}</h1>

                        <div class="product-meta">
                            <div class="meta-item">
                                <i class="fa fa-balance-scale"></i>
                                <span>Berat: {{ $row->berat }} Gram</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa fa-cubes"></i>
                                <span>Stok: {{ $row->stok }} Unit</span>
                            </div>
                        </div>

                        <div class="product-price">
                            <span class="price">Rp. {{ number_format($row->harga, 0, ',', '.') }}</span>
                        </div>

                        <div class="product-description">
                            <h4>Deskripsi Produk</h4>
                            <p>
                                {!! $row->detail !!}
                            </p>
                        </div>

                        <div class="product-actions">
                            @if ($row->stok > 0)
                                @auth
                                    <form action="{{ route('order.addToCart', $row->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-primary btn-lg" onclick="showLoginPopup()">
                                        <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                                    </button>
                                @endauth
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>
                                    <i class="fa fa-ban"></i> Stok Habis
                                </button>
                            @endif
                            <a href="{{ route('produk.all') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Login Popup -->
    <div id="loginPopupOverlay" class="login-popup-overlay" style="display:none;">
        <div id="loginPopup" class="login-popup-animated">
            <div class="login-popup-header">
                <span class="login-popup-icon"><i class="fa fa-user-circle"></i></span>
                <span class="login-popup-close" onclick="closeLoginPopup()">&times;</span>
            </div>
            <div class="login-popup-body">
                <h4>Login Diperlukan</h4>
                <p>Untuk menambahkan produk ke keranjang, silakan login terlebih dahulu.<br>
                    Bergabunglah dan nikmati kemudahan berbelanja di <span style="color:#D10024;font-weight:600;">MTV Carbon
                        Pro</span>!</p>
                <a href="{{ route('auth.redirect') }}" class="btn btn-login-popup">
                    <i class="fa fa-sign-in"></i> Login Sekarang
                </a>
            </div>
        </div>
    </div>

    <style>
        .login-popup-overlay {
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeInOverlay 0.4s;
        }

        @keyframes fadeInOverlay {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .login-popup-animated {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 40px rgba(209, 0, 36, 0.18), 0 1.5px 8px rgba(0, 0, 0, 0.08);
            max-width: 350px;
            width: 90%;
            padding: 0 0 28px 0;
            animation: popupBounceIn 0.6s cubic-bezier(.68, -0.55, .27, 1.55);
            position: relative;
        }

        @keyframes popupBounceIn {
            0% {
                transform: scale(0.7) translateY(60px);
                opacity: 0;
            }

            60% {
                transform: scale(1.05) translateY(-10px);
                opacity: 1;
            }

            80% {
                transform: scale(0.98) translateY(2px);
            }

            100% {
                transform: scale(1) translateY(0);
            }
        }

        .login-popup-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 28px 0 28px;
        }

        .login-popup-icon {
            font-size: 32px;
            color: #D10024;
        }

        .login-popup-close {
            font-size: 28px;
            color: #888;
            cursor: pointer;
            transition: color 0.2s;
        }

        .login-popup-close:hover {
            color: #D10024;
        }

        .login-popup-body {
            padding: 18px 28px 0 28px;
            text-align: center;
        }

        .login-popup-body h4 {
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: 700;
            color: #D10024;
            letter-spacing: 0.5px;
        }

        .login-popup-body p {
            color: #444;
            font-size: 15px;
            margin-bottom: 22px;
            margin-top: 0;
        }

        .btn-login-popup {
            display: inline-block;
            background: linear-gradient(90deg, #D10024 60%, #f8694a 100%);
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            padding: 12px 32px;
            box-shadow: 0 2px 12px rgba(209, 0, 36, 0.10);
            transition: background 0.22s, box-shadow 0.22s, transform 0.18s;
            text-decoration: none;
        }

        .btn-login-popup:hover {
            background: linear-gradient(90deg, #f8694a 60%, #D10024 100%);
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 4px 18px rgba(209, 0, 36, 0.13);
            color: #fff;
        }
    </style>
    <script>
        function showLoginPopup() {
            var overlay = document.getElementById('loginPopupOverlay');
            overlay.style.display = 'flex';
        }

        function closeLoginPopup() {
            var overlay = document.getElementById('loginPopupOverlay');
            overlay.style.display = 'none';
        }
        // Optional: close popup on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                closeLoginPopup();
            }
        });
        // Optional: close popup if click outside
        document.getElementById('loginPopupOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLoginPopup();
            }
        });
    </script>


    <style>
        .product-detail-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 40px;
        }

        .product-gallery {
            position: relative;
            margin-bottom: 30px;
        }

        .main-image {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .main-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            gap: 10px;
        }

        .badge {
            padding: 8px 15px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 4px;
        }

        .badge-primary {
            background-color: #D10024;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .product-info {
            padding: 20px 0;
        }

        .product-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .product-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 15px;
        }

        .meta-item i {
            color: #D10024;
            font-size: 18px;
        }

        .product-price {
            margin-bottom: 25px;
        }

        .price {
            font-size: 32px;
            font-weight: 700;
            color: #D10024;
        }

        .product-description {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .product-description h4 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .product-description p {
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        .product-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #D10024;
            border-color: #D10024;
        }

        .btn-primary:hover {
            background-color: #b3001f;
            border-color: #b3001f;
        }

        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title p {
            color: #D10024;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .section-title h3 {
            color: #333;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .product-detail-container {
                padding: 20px;
            }

            .product-title {
                font-size: 24px;
            }

            .price {
                font-size: 28px;
            }

            .product-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
@endsection
