<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must
come *after* these tags -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>MTV Carbon Pro</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>


</head>

<body>
    <!-- HEADER -->
    <header>

        <!-- header -->
        <div id="header" style="font-family: 'Poppins', 'Segoe UI', 'Hind', Arial, sans-serif;">
            <div class="container">
                <div class="pull-left">
                    <!-- Logo -->
                    <h1 class="text-white"
                        style="font-family: 'Poppins', 'Segoe UI', 'Hind', Arial, sans-serif; font-weight: 700; letter-spacing: 1px; font-size: 2.2rem; margin: 0;">
                        MTV <span style="color: #D10024;">Carbon Pro</span>
                    </h1>
                    <!-- <div class="header-logo">
                        <a class="logo" href="#">
                            <img src="{{ asset('image/logo.png') }}" alt="">
                        </a>
                    </div> -->
                    <!-- /Logo -->
                    <!-- Search -->
                    <!-- /Search -->
                </div>
            </div>
            <!-- header -->
        </div>
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
        <style>
            #header h1,
            #header h3,
            #header .text-white {
                font-family: 'Poppins', 'Segoe UI', 'Hind', Arial, sans-serif !important;
                font-weight: 700;
                letter-spacing: 1px;
            }
        </style>
        <!-- container -->
    </header>
    <!-- /HEADER -->
    <!-- NAVIGATION -->
    <div id="navigation">
        <!-- container -->
        <div class="container">
            <div id="responsive-nav">
                <div class="menu-nav"
                    style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <div class="logo-section">
                        <h3 class="text-white">MTV Carbon Pro</h3>
                    </div>
                    <div class="menu-section" style="display: flex; align-items: center;">
                        <ul class="menu-list" style="display: flex; list-style: none; margin: 0; padding: 0;">
                            <li style="margin: 0 15px;"><a href="{{ route('beranda') }}">Beranda</a></li>
                            <li style="margin: 0 15px;"><a href="{{ route('produk.all') }}">Produk</a></li>
                            <li style="margin: 0 15px;"><a href="#">Lokasi</a></li>
                            <li style="margin: 0 15px;"><a href="#">Hubungi Kami</a></li>
                            @if (Auth::check())
                                <li style="margin: 0 15px;">
                                    <a href="{{ route('order.cart') }}">
                                        <i class="fa fa-shopping-cart"></i> Keranjang
                                    </a>
                                </li>
                            @endif
                            @if (Auth::check())
                                <li style="margin: 0 15px; position: relative;" class="dropdown custom-dropdown">
                                    <a href="#" class="dropdown-toggle" id="userDropdown"
                                        onclick="toggleDropdown(event)">
                                        <i class="fa fa-user-o"></i> {{ Auth::user()->nama }}
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu custom-animated-dropdown" id="dropdownMenuUser"
                                        style="display: none;">
                                        <li>
                                            <a href="{{ route('customer.akun', ['id' => Auth::user()->id]) }}">
                                                <i class="fa fa-user-o"></i> Akun Saya
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('order.history') }}">
                                                <i class="fa fa-check"></i> History
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
                                                <i class="fa fa-power-off"></i> Keluar
                                            </a>
                                            <form id="keluar-app" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <style>
                                    .custom-animated-dropdown {
                                        position: absolute;
                                        top: 100%;
                                        right: 0;
                                        min-width: 180px;
                                        background: #fff;
                                        border-radius: 8px;
                                        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
                                        padding: 10px 0;
                                        opacity: 0;
                                        transform: translateY(20px) scale(0.98);
                                        pointer-events: none;
                                        transition:
                                            opacity 0.3s cubic-bezier(.4, 0, .2, 1),
                                            transform 0.3s cubic-bezier(.4, 0, .2, 1);
                                        z-index: 100;
                                    }

                                    .custom-animated-dropdown.show {
                                        display: block !important;
                                        opacity: 1;
                                        transform: translateY(0) scale(1);
                                        pointer-events: auto;
                                    }

                                    .custom-animated-dropdown li {
                                        padding: 0;
                                    }

                                    .custom-animated-dropdown li a {
                                        display: flex;
                                        align-items: center;
                                        padding: 10px 20px;
                                        color: #333;
                                        text-decoration: none;
                                        font-weight: 500;
                                        transition: background 0.2s, color 0.2s;
                                    }

                                    .custom-animated-dropdown li a:hover {
                                        background: #f5f5f5;
                                        color: #D10024;
                                    }

                                    .custom-animated-dropdown li:not(:last-child) a {
                                        border-bottom: 1px solid #f0f0f0;
                                    }

                                    .custom-animated-dropdown i {
                                        margin-right: 10px;
                                    }
                                </style>
                                <script>
                                    function toggleDropdown(event) {
                                        event.preventDefault();
                                        var dropdown = document.getElementById('dropdownMenuUser');
                                        if (dropdown.classList.contains('show')) {
                                            dropdown.classList.remove('show');
                                            setTimeout(function() {
                                                dropdown.style.display = 'none';
                                            }, 300);
                                        } else {
                                            dropdown.style.display = 'block';
                                            setTimeout(function() {
                                                dropdown.classList.add('show');
                                            }, 10);
                                        }
                                    }
                                    // Close dropdown when clicking outside
                                    document.addEventListener('click', function(e) {
                                        var dropdown = document.getElementById('dropdownMenuUser');
                                        var toggle = document.getElementById('userDropdown');
                                        if (!dropdown || !toggle) return;
                                        if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
                                            if (dropdown.classList.contains('show')) {
                                                dropdown.classList.remove('show');
                                                setTimeout(function() {
                                                    dropdown.style.display = 'none';
                                                }, 300);
                                            }
                                        }
                                    });
                                </script>
                            @else
                                <li style="margin: 0 15px;">
                                    <a href="{{ route('auth.redirect') }}">
                                        <i class="fa fa-user-o"></i> Login
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /NAVIGATION -->
    @if (request()->segment(1) == '' || request()->segment(1) == 'beranda')
        <!-- HOME -->
        <div id="home" style="margin-left: -200px; margin-top: 30px; margin-bottom: 30px;">
            <!-- home wrap -->
            <style>
                @media (min-width: 1200px) {
                    .banner.banner-1 {
                        height: 500px !important;
                        min-width: 1000px;
                        max-width: 1200px;
                        margin: 0 auto;
                    }

                    #home-slick {
                        min-width: 1000px;
                        max-width: 1200px;
                        margin: 0 auto;
                    }

                    .home-wrap .col-md-9 {
                        padding-left: 0 !important;
                        padding-right: 0 !important;
                    }
                }

                @media (max-width: 1199px) {
                    .banner.banner-1 {
                        height: 400px !important;
                    }
                }

                .banner.banner-1 {
                    width: 100%;
                    overflow: hidden;
                    border-radius: 15px;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                    margin-bottom: 20px;
                }

                .banner.banner-1 img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            </style>
            <div class="home-wrap">
                <div class="row justify-content-center">
                    <!-- Category Menu -->

                    <!-- Banner Section -->
                    <div class="col-md-12" style="display: flex; justify-content: center;">
                        <div id="home-slick" style="width: 100%; max-width: 1200px;">
                            <!-- banner -->
                            <div class="banner banner-1">
                                <img src="{{ asset('frontend/banner/body.jpeg') }}" alt="">
                                <div class="banner-caption text-center"
                                    style="background: rgba(0,0,0,0.4); padding: 20px; border-radius: 10px; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 80%;">
                                    <h1 style="font-size: 36px; margin-bottom: 10px; color: #fff;">Plat Karbon Twill
                                    </h1>
                                    <h3 class="font-weak" style="color: #fff; font-size: 22px; margin-bottom: 20px;">
                                        Body</h3>
                                    <button class="primary-btn"
                                        style="padding: 14px 35px; border-radius: 25px; border: none; background: #D10024; color: #fff; font-weight: 600; font-size: 18px; transition: all 0.3s ease;">Pesan
                                        Sekarang</button>
                                </div>
                            </div>
                            <!-- /banner -->
                            <!-- banner -->
                            <div class="banner banner-1">
                                <img src="{{ asset('frontend/banner/suspensi.jpg') }}" alt="">
                                <div class="banner-caption"
                                    style="background: rgba(0,0,0,0.4); padding: 20px; border-radius: 10px; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 80%;">
                                    <h1 class="primary-color"
                                        style="font-size: 36px; margin-bottom: 10px; color: #D10024;">Suspensi
                                        Karbon<br>
                                        <span class="white-color font-weak" style="color: #fff; font-size: 22px;">Plat
                                            Karbon Hexagonal</span>
                                    </h1>
                                    <button class="primary-btn"
                                        style="padding: 14px 35px; border-radius: 25px; border: none; background: #D10024; color: #fff; font-weight: 600; font-size: 18px; transition: all 0.3s ease;">Pesan
                                        Sekarang</button>
                                </div>
                            </div>
                            <!-- /banner -->
                            <!-- banner -->
                            <div class="banner banner-1">
                                <img src="{{ asset('frontend/banner/velg.jpg') }}" alt="">
                                <div class="banner-caption"
                                    style="background: rgba(0,0,0,0.4); padding: 20px; border-radius: 10px; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 80%;">
                                    <h1 style="font-size: 36px; margin-bottom: 10px; color: #f8694a;">Velg Karbon
                                        <span style="color: #fff;">Serat Karbon Big Twill</span>
                                    </h1>
                                    <button class="primary-btn"
                                        style="padding: 14px 35px; border-radius: 25px; border: none; background: #D10024; color: #fff; font-weight: 600; font-size: 18px; transition: all 0.3s ease;">Pesan
                                        Sekarang</button>
                                </div>
                            </div>
                            <!-- /banner -->
                        </div>
                        <!-- /home slick -->
                    </div>
                </div>
            </div>
            <!-- /home wrap -->
        </div>
        <!-- /HOME -->
    @endif
    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <div class="aside">
                        <h3 class="aside-title"
                            style="font-size: 22px; font-weight: 700; margin-bottom: 28px; padding-bottom: 18px; border-bottom: 2.5px solid #e0e0e0; letter-spacing: 0.5px;">
                            Kategori Produk
                        </h3>
                        @php
                            $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
                            // Ambil id kategori yang sedang dipilih dari route (jika ada)
                            $kategoriTerpilihId = null;
                            if (request()->routeIs('produk.kategori') && request()->route('id')) {
                                $kategoriTerpilihId = request()->route('id');
                            }
                        @endphp
                        <div class="kategori-card-list" style="display: flex; flex-direction: column; gap: 18px;">
                            @foreach ($kategori as $row)
                                @php
                                    $isActive = $kategoriTerpilihId == $row->id;
                                @endphp
                                <a href="{{ $isActive ? route('beranda') : route('produk.kategori', $row->id) }}"
                                    class="kategori-card{{ $isActive ? ' kategori-card-active' : '' }}"
                                    style="
                                        display: flex;
                                        align-items: center;
                                        background: {{ $isActive ? 'linear-gradient(90deg, #f8694a 60%, #ffb86c 100%)' : 'linear-gradient(90deg, #fff 80%, #f7f7f7 100%)' }};
                                        border-radius: 14px;
                                        box-shadow: {{ $isActive ? '0 6px 24px rgba(248,105,74,0.13)' : '0 4px 18px rgba(40,40,60,0.07)' }};
                                        padding: 18px 20px;
                                        color: {{ $isActive ? '#fff' : '#232323' }};
                                        font-size: 16px;
                                        font-weight: 600;
                                        text-decoration: none;
                                        border: 1.5px solid {{ $isActive ? '#f8694a' : '#f0f0f0' }};
                                        transition: box-shadow 0.22s, border 0.22s, background 0.22s, color 0.22s;
                                        position: relative;
                                        overflow: hidden;
                                    "
                                    onmouseover="if(!this.classList.contains('kategori-card-active')){this.style.background='linear-gradient(90deg, #f8694a 60%, #ffb86c 100%)';this.style.color='#fff';this.querySelector('i.fa-th-large').style.color='#fff';this.style.border='1.5px solid #f8694a';this.style.boxShadow='0 6px 24px rgba(248,105,74,0.13)';}"
                                    onmouseout="if(!this.classList.contains('kategori-card-active')){this.style.background='linear-gradient(90deg, #fff 80%, #f7f7f7 100%)';this.style.color='#232323';this.querySelector('i.fa-th-large').style.color='#f8694a';this.style.border='1.5px solid #f0f0f0';this.style.boxShadow='0 4px 18px rgba(40,40,60,0.07)';}">
                                    <i class="fa fa-th-large"
                                        style="margin-right: 15px; font-size: 20px; color: {{ $isActive ? '#fff' : '#f8694a' }}; transition: color 0.22s;"></i>
                                    <span style="flex:1;">{{ $row->nama_kategori }}</span>
                                    <i class="fa fa-chevron-right"
                                        style="font-size: 15px; color: #bbb; margin-left: 10px; transition: color 0.22s;"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /ASIDE -->
                <!-- MAIN -->
                <div id="main" class="col-md-9">
                    <!-- store top filter -->
                    <!-- /store top filter -->
                    <!-- @yieldAwal -->
                    @yield('content')
                    <!-- PAGINATION: tampilkan jika produk lebih dari 6 -->
                    @if (isset($produk) && $produk instanceof \Illuminate\Pagination\LengthAwarePaginator && $produk->total() > 6)
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12 text-center">
                                <div class="custom-pagination-wrapper">
                                    {{ $produk->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                        <style>
                            .custom-pagination-wrapper {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                margin-top: 10px;
                            }

                            .pagination {
                                display: inline-flex;
                                background: #fff;
                                border-radius: 30px;
                                box-shadow: 0 2px 12px rgba(209, 0, 36, 0.07);
                                padding: 8px 18px;
                                gap: 4px;
                            }

                            .pagination li {
                                margin: 0 2px;
                            }

                            .pagination li a,
                            .pagination li span {
                                color: #D10024;
                                border: none;
                                background: none;
                                border-radius: 50%;
                                width: 38px;
                                height: 38px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 16px;
                                font-weight: 600;
                                transition: background 0.2s, color 0.2s, box-shadow 0.2s;
                                box-shadow: none;
                            }

                            .pagination li.active span,
                            .pagination li a:hover,
                            .pagination li.active a {
                                background: linear-gradient(90deg, #D10024 60%, #f8694a 100%);
                                color: #fff !important;
                                box-shadow: 0 2px 8px rgba(209, 0, 36, 0.10);
                            }

                            .pagination li.disabled span,
                            .pagination li.disabled a {
                                color: #bbb !important;
                                background: none !important;
                                cursor: not-allowed;
                            }

                            .pagination li:first-child a,
                            .pagination li:first-child span,
                            .pagination li:last-child a,
                            .pagination li:last-child span {
                                border-radius: 50% !important;
                            }

                            @media (max-width: 575px) {
                                .pagination {
                                    padding: 6px 4px;
                                    font-size: 14px;
                                }

                                .pagination li a,
                                .pagination li span {
                                    width: 30px;
                                    height: 30px;
                                    font-size: 14px;
                                }
                            }
                        </style>
                    @endif
                    <!-- @yieldAkhir-->
                    <!-- store bottom filter -->
                    <!-- /store bottom filter -->
                </div>
                <!-- /MAIN -->
            </div>
            <style>
                .kategori-card-list .kategori-card:hover .fa-chevron-right {
                    color: #fff !important;
                }
            </style>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
    <!-- FOOTER -->
    <footer id="footer" class="section section-grey" style="background-color: rgb(55, 53, 54); color: white;">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row" style="display: flex; justify-content: center; gap: 40px; margin-bottom: 0;">
                <!-- MTV Carbon Pro Info -->
                <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 24px;">
                    <div class="footer" style="text-align: left;">
                        <h2
                            style="color: #fff; font-size: 28px; font-weight: 700; margin-bottom: 16px; letter-spacing: 1px;">
                            <span style="color: #D10024;">MTV</span> Carbon Pro
                        </h2>
                        <p
                            style="color: rgba(255,255,255,0.8); font-size: 16px; margin-bottom: 0; text-align: justify;">
                            MTV Carbon adalah bengkel motor yang berlokasi di Jalan Raya Sawangan, Depok. Berdiri sejak
                            tahun 2024 dan dimiliki oleh Mohammad Alfiki, MTV Carbon hadir sebagai bengkel modern yang
                            tidak hanya melayani servis motor, tetapi juga menyediakan berbagai macam suku cadang motor
                            secara praktis dan cepat.
                        </p>
                    </div>
                </div>
                <!-- /MTV Carbon Pro Info -->

                <!-- Contact Us -->
                <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 24px;">
                    <div class="footer" style="text-align: left;">
                        <h3 class="footer-header"
                            style="color: #fff; font-size: 22px; font-weight: 600; margin-bottom: 18px;">
                            Contact Us
                        </h3>
                        <ul class="list-unstyled"
                            style="color: rgba(255,255,255,0.85); font-size: 16px; line-height: 2.2; margin-bottom: 0;">
                            <li style="margin-bottom: 8px; display: flex; align-items: center;">
                                <i class="fa fa-phone" style="width: 28px; color: #D10024; min-width: 28px;"></i>
                                <a href="tel:+6281234567890"
                                    style="color: rgba(255,255,255,0.85); text-decoration: none; margin-left: 8px;">
                                    +62 858-9206-2820
                                </a>
                            </li>
                            <li style="margin-bottom: 8px; display: flex; align-items: center;">
                                <!-- TikTok SVG Icon -->
                                <span
                                    style="display: inline-block; width: 28px; vertical-align: middle; min-width: 28px; margin-left:-5px;">
                                    <svg width="22" height="22" viewBox="0 0 48 48" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="48" height="48" rx="8" fill="none" />
                                        <path
                                            d="M34.5 18.5c2.2 1.5 4.7 2.4 7.5 2.5v5.2c-2.7-.1-5.2-.7-7.5-1.8v8.6c0 6.1-4.9 11-11 11s-11-4.9-11-11 4.9-11 11-11c.3 0 .7 0 1 .1v5.3c-.3 0-.7-.1-1-.1-3.1 0-5.7 2.5-5.7 5.7s2.5 5.7 5.7 5.7 5.7-2.5 5.7-5.7V6.5h5.3c.1 4.3 3.6 7.8 8 8v5.3c-2.2-.1-4.3-.7-6.1-1.8v8.5z"
                                            fill="#D10024" />
                                    </svg>
                                </span>
                                <a href="https://www.tiktok.com/@mtvcarbon69?_t=ZS-8xCHenyqhSU&_r=1" target="_blank"
                                    style="color: rgba(255,255,255,0.85); text-decoration: none; margin-left: 12px;">
                                    @mtvcarbon69
                                </a>
                            </li>
                            <li style="margin-bottom: 8px; display: flex; align-items: center;">
                                <i class="fa fa-instagram" style="width: 28px; color: #D10024; min-width: 28px;"></i>
                                <a href="https://www.instagram.com/mtvcarbon?igsh=OXQ4eDZrcGo0ZWVt" target="_blank"
                                    style="color: rgba(255,255,255,0.85); text-decoration: none; margin-left: 8px;">
                                    @mtvcarbon
                                </a>
                            </li>
                            <li style="display: flex; align-items: center;">
                                <i class="fa fa-map-marker" style="width: 28px; color: #D10024; min-width: 28px;"></i>
                                <a href="https://maps.app.goo.gl/eEyVAMJegk1hGxQA7" target="_blank"
                                    style="color: rgba(255,255,255,0.85); text-decoration: none; margin-left: 8px;">
                                    Jl. Manggis Sawangan, Depok
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Contact Us -->
            </div>
            <style>
                .footer a:hover {
                    color: #D10024 !important;
                    text-decoration: underline;
                }

                @media (max-width: 767px) {
                    .footer {
                        text-align: left !important;
                        margin-bottom: 30px;
                    }
                }
            </style>
            <!-- /row -->
            <hr style="border-color: rgba(255,255,255,0.1);">
            <!-- row -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <!-- footer copyright -->
                    <div class="footer-copyright" style="color: rgba(255,255,255,0.7);">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> MTV Carbon Pro. All rights reserved.
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <!-- /footer copyright -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </footer>
    <!-- /FOOTER -->
    <!-- jQuery Plugins -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        function previewFoto() {
            const foto = document.querySelector('input[name="foto"]');
            const fotoPreview = document.querySelector('.foto-preview');
            fotoPreview.style.display = 'block';
            const fotoReader = new FileReader();
            fotoReader.readAsDataURL(foto.files[0]);
            fotoReader.onload = function(fotoEvent) {
                fotoPreview.src = fotoEvent.target.result;
                fotoPreview.style.width = '100%';
            }
        }
    </script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> -->
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>
