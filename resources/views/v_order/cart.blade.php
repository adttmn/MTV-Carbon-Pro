@extends('v_layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="order-summary clearfix">
            <div class="section-title">
                <h3 class="title">Keranjang Belanja</h3>
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
            @if ($order && $order->orderItems->count() > 0)
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="shopping-cart-table table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th></th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalHarga = 0;
                                        $totalBerat = 0;
                                    @endphp
                                    @foreach ($order->orderItems as $item)
                                        @php
                                            $totalHarga += $item->harga * $item->quantity;
                                            $totalBerat += $item->produk->berat * $item->quantity;
                                        @endphp
                                        <tr>
                                            <td class="thumb">
                                                <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}"
                                                    alt="{{ $item->produk->nama_produk }}" class="product-img">
                                            </td>
                                            <td class="details">
                                                <a href="#" class="product-name">{{ $item->produk->nama_produk }}</a>
                                                <ul class="product-info">
                                                    <li><span>Berat: {{ $item->produk->berat }} Gram</span></li>
                                                    <li><span>Stok: {{ $item->produk->stok }} Unit</span></li>
                                                </ul>
                                            </td>
                                            <td class="price text-center">
                                                <strong>Rp. {{ number_format($item->harga, 0, ',', '.') }}</strong>
                                            </td>
                                            <td class="qty text-center">
                                                <form action="{{ route('order.updateCart', $item->id) }}" method="post"
                                                    class="quantity-form">
                                                    @csrf
                                                    <div class="quantity-input">
                                                        <button type="button" class="qty-btn minus"
                                                            onclick="decrementQuantity(this)">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                            min="1" max="{{ $item->produk->stok }}"
                                                            class="form-control" onchange="validateQuantity(this)">
                                                        <button type="button" class="qty-btn plus"
                                                            onclick="incrementQuantity(this)">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-warning update-btn">
                                                        <i class="fa fa-refresh"></i> Update
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="total text-center">
                                                <strong class="primary-color">Rp.
                                                    {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</strong>
                                            </td>
                                            <td class="text-right">
                                                <form action="{{ route('order.remove', $item->produk->id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm remove-btn" title="Hapus Item">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="cart-summary">
                                    <h4>Ringkasan Belanja</h4>
                                    <div class="summary-item">
                                        <span>Total Item:</span>
                                        <span>{{ $order->orderItems->count() }} Produk</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Total Berat:</span>
                                        <span>{{ $totalBerat }} Gram</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Subtotal:</span>
                                        <span>Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <form action="{{ route('order.select-shipping') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="total_price" value="{{ $totalHarga }}">
                                    <input type="hidden" name="total_weight" value="{{ $totalBerat }}">
                                    <button class="btn btn-primary btn-lg">
                                        <i class="fa fa-truck"></i> Lanjut ke Pengiriman
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fa fa-shopping-cart"></i> Keranjang belanja kosong.
                </div>
            @endif
        </div>
    </div>

    <style>
        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
        }

        .product-name:hover {
            color: #D10024;
            text-decoration: none;
        }

        .product-info {
            list-style: none;
            padding: 0;
            margin: 5px 0 0 0;
        }

        .product-info li {
            color: #666;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .quantity-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .quantity-input {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: #f8f9fa;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: #e9ecef;
        }

        .qty-btn.minus {
            border-right: 1px solid #ddd;
        }

        .qty-btn.plus {
            border-left: 1px solid #ddd;
        }

        .quantity-input input {
            width: 50px;
            height: 32px;
            border: none;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
        }

        .quantity-input input::-webkit-inner-spin-button,
        .quantity-input input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .update-btn {
            padding: 4px 12px;
            font-size: 12px;
        }

        .remove-btn {
            padding: 6px 10px;
        }

        .cart-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .cart-summary h4 {
            margin-bottom: 15px;
            color: #333;
            font-weight: 600;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .summary-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            border-top: none;
        }

        .table td {
            vertical-align: middle;
        }

        .primary-color {
            color: #D10024;
        }

        .btn-primary {
            background-color: #D10024;
            border-color: #D10024;
        }

        .btn-primary:hover {
            background-color: #b3001f;
            border-color: #b3001f;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            color: #000;
        }
    </style>

    <script>
        function incrementQuantity(button) {
            const input = button.parentElement.querySelector('input');
            const max = parseInt(input.getAttribute('max'));
            const currentValue = parseInt(input.value);
            if (currentValue < max) {
                input.value = currentValue + 1;
            }
        }

        function decrementQuantity(button) {
            const input = button.parentElement.querySelector('input');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }

        function validateQuantity(input) {
            const max = parseInt(input.getAttribute('max'));
            const min = parseInt(input.getAttribute('min'));
            let value = parseInt(input.value);

            if (value < min) {
                value = min;
            } else if (value > max) {
                value = max;
            }

            input.value = value;
        }
    </script>
@endsection
