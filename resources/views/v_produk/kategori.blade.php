@extends('v_layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="section-title">
            <h3 class="title">
                Daftar Produk Kategori
                @if (isset($kategoriTerpilih) && $kategoriTerpilih)
                    : {{ $kategoriTerpilih->nama_kategori }}
                @endif
            </h3>
        </div>
        <div class="row">
            @if ($produk->count() > 0)
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
                                    <a href="{{ route('produk.detail', $p->id) }}">{{ $p->nama_produk }}</a>
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
                                        <form action="{{ route('order.addToCart', $p->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-shopping-cart"></i> Beli
                                            </button>
                                        </form>
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
            @else
                <div class="col-12">
                    <div class="alert alert-warning text-center" style="margin-top:30px;">
                        Tidak ada produk pada kategori ini.
                    </div>
                </div>
            @endif
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

        .category {
            top: 40px;
            background-color: #D10024;
            color: #fff;
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
            color: white;
        }

        .btn-primary:hover {
            background-color: #b3001f;
            border-color: #b3001f;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #565e64;
            border-color: #565e64;
            color: white;
        }
    </style>
@endsection
