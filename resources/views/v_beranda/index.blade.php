@extends('v_layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="section-title">
            <h3 class="title">Daftar Produk</h3>
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
        <div class="row">
            @foreach ($produk as $p)
                <div class="col-md-4 col-sm-6">
                    <div class="product-card">
                        <div class="product-img">
                            <img src="{{ asset('storage/img-produk/' . $p->foto) }}" alt="{{ $p->nama_produk }}">
                            @if ($p->stok > 0)
                                <div class="product-label in-stock">In Stock</div>
                            @else
                                <div class="product-label out-of-stock">Out of Stock</div>
                            @endif
                        </div>
                        <div class="product-body">
                            <h3 class="product-name">
                                <a href="{{ route('produk.all', $p->id) }}">{{ $p->nama_produk }}</a>
                            </h3>
                            <div class="product-info">
                                <span class="product-weight"><i class="fa fa-balance-scale"></i> {{ $p->berat }}
                                    Gram</span>
                                <span class="product-stock"><i class="fa fa-cubes"></i> {{ $p->stok }} Unit</span>
                            </div>
                            <div class="product-price">
                                <span class="price">Rp. {{ number_format($p->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="product-actions">
                                <a href="{{ route('produk.detail', $p->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                @if ($p->stok > 0)
                                    @auth
                                        <form action="{{ route('order.addToCart', $p->id) }}" method="post" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-shopping-cart"></i> Beli
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-primary btn-sm" onclick="showLoginPopup()">
                                            <i class="fa fa-shopping-cart"></i> Beli
                                        </button>
                                    @endauth
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fa fa-ban"></i> Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                <p>Untuk membeli produk, silakan login terlebih dahulu.<br>
                    Bergabunglah dan nikmati kemudahan berbelanja di <span style="color:#D10024;font-weight:600;">MTV Carbon
                        Pro</span>!</p>
                <a href="{{ route('auth.redirect') }}" class="btn btn-login-popup">
                    <i class="fa fa-sign-in"></i> Login Sekarang
                </a>
            </div>
        </div>
    </div>

    <style>
        .product-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .product-img {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.05);
        }

        .product-label {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .in-stock {
            background-color: #28a745;
            color: white;
        }

        .out-of-stock {
            background-color: #dc3545;
            color: white;
        }

        .product-body {
            padding: 20px;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .product-name a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .product-name a:hover {
            color: #D10024;
        }

        .product-info {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            color: #666;
            font-size: 14px;
        }

        .product-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-info i {
            color: #D10024;
        }

        .product-price {
            margin-bottom: 15px;
        }

        .price {
            font-size: 20px;
            font-weight: 700;
            color: #D10024;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
            color: white;
        }

        .btn-primary {
            background-color: #D10024;
            border-color: #D10024;
        }

        .btn-primary:hover {
            background-color: #b3001f;
            border-color: rgb(84, 25, 35);
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
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
            margin-bottom: 12.5px;
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

        /* Animated Login Popup Styles */
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
            font-size: 38px;
            color: #D10024;
            animation: iconPop 0.7s;
        }

        @keyframes iconPop {
            0% {
                transform: scale(0.5) rotate(-20deg);
                opacity: 0;
            }

            60% {
                transform: scale(1.2) rotate(10deg);
                opacity: 1;
            }

            100% {
                transform: scale(1) rotate(0);
            }
        }

        .login-popup-close {
            font-size: 28px;
            color: #bbb;
            cursor: pointer;
            transition: color 0.2s;
            margin-left: 10px;
        }

        .login-popup-close:hover {
            color: #D10024;
        }

        .login-popup-body {
            padding: 0 28px;
            text-align: center;
        }

        .login-popup-body h4 {
            margin-top: 10px;
            font-size: 22px;
            font-weight: 700;
            color: #D10024;
            margin-bottom: 10px;
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
            margin-top: 5px;
        }

        .btn-login-popup:hover {
            background: linear-gradient(90deg, #f8694a 60%, #D10024 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 18px rgba(209, 0, 36, 0.18);
        }

        @media (max-width: 575px) {
            .login-popup-animated {
                max-width: 95vw;
                padding: 0 0 18px 0;
            }

            .login-popup-header,
            .login-popup-body {
                padding-left: 12px;
                padding-right: 12px;
            }
        }
    </style>
    
    <script>
        function showLoginPopup() {
            var overlay = document.getElementById('loginPopupOverlay');
            overlay.style.display = 'flex';
            setTimeout(function() {
                overlay.classList.add('active');
            }, 10);
        }

        function closeLoginPopup() {
            var overlay = document.getElementById('loginPopupOverlay');
            overlay.classList.remove('active');
            overlay.style.display = 'none';
        }
        // Optional: close popup on ESC or click outside
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") closeLoginPopup();
        });
        document.addEventListener('mousedown', function(e) {
            var popup = document.getElementById('loginPopup');
            var overlay = document.getElementById('loginPopupOverlay');
            if (overlay.style.display !== 'none' && !popup.contains(e.target)) {
                closeLoginPopup();
            }
        });
    </script>
@endsection
