@extends('v_layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="section-title">
            <h3 class="title">Pilih Metode Pembayaran</h3>
        </div>

        <!-- Alert Messages -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <!-- Payment Section -->
            <div class="col-md-8">
                <div class="payment-container">
                    <!-- Order Summary Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4><i class="fa fa-shopping-cart"></i> Ringkasan Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="order-items">
                                @php
                                    $totalHarga = 0;
                                    $totalBerat = 0;
                                @endphp
                                @foreach ($order->orderItems as $item)
                                    @php
                                        $totalHarga += $item->harga * $item->quantity;
                                        $totalBerat += $item->produk->berat * $item->quantity;
                                    @endphp
                                    <div class="order-item">
                                        <div class="item-image">
                                            <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}"
                                                alt="{{ $item->produk->nama_produk }}">
                                        </div>
                                        <div class="item-details">
                                            <h5>{{ $item->produk->nama_produk }}</h5>
                                            <p class="item-meta">
                                                <span class="quantity">{{ $item->quantity }}x</span>
                                                <span class="price">Rp.
                                                    {{ number_format($item->harga, 0, ',', '.') }}</span>
                                            </p>
                                        </div>
                                        <div class="item-total">
                                            Rp. {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Details Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4><i class="fa fa-truck"></i> Detail Pengiriman</h4>
                        </div>
                        <div class="card-body">
                            <div class="shipping-info">
                                <div class="info-row">
                                    <span class="label">Kurir:</span>
                                    <span class="value">{{ strtoupper($order->kurir) }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Layanan:</span>
                                    <span class="value">{{ $order->layanan_ongkir }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Estimasi:</span>
                                    <span class="value">{{ $order->estimasi_ongkir }} hari</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Alamat:</span>
                                    <span class="value">{!! $order->alamat !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <div class="payment-action">
                        <button id="pay-button" class="btn btn-primary btn-lg btn-block">
                            <i class="fa fa-credit-card"></i> Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-md-4">
                <div class="order-summary-sidebar">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-receipt"></i> Total Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="summary-item">
                                <span>Subtotal</span>
                                <span>Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-item">
                                <span>Ongkos Kirim</span>
                                <span>Rp. {{ number_format($order->biaya_ongkir, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-item total">
                                <span>Total</span>
                                <span>Rp. {{ number_format($totalHarga + $order->biaya_ongkir, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
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
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .alert i {
            margin-right: 10px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            padding: 20px;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-header h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h4 i {
            color: #D10024;
        }

        .card-body {
            padding: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 15px;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-details h5 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #333;
        }

        .item-meta {
            display: flex;
            gap: 15px;
            color: #666;
            font-size: 14px;
        }

        .item-total {
            font-weight: 600;
            color: #D10024;
        }

        .shipping-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #666;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-row .label {
            font-weight: 500;
            color: #333;
        }

        .payment-action {
            margin-top: 30px;
        }

        .btn-primary {
            background-color: #D10024;
            border-color: #D10024;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b3001f;
            border-color: #b3001f;
            transform: translateY(-2px);
        }

        .order-summary-sidebar .card {
            position: sticky;
            top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            color: #666;
        }

        .summary-item.total {
            font-weight: 700;
            color: #333;
            font-size: 18px;
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #eee;
        }

        @media (max-width: 768px) {
            .order-summary-sidebar .card {
                position: static;
                margin-top: 20px;
            }

            .item-image {
                width: 60px;
                height: 60px;
            }

            .item-details h5 {
                font-size: 14px;
            }

            .item-meta {
                font-size: 12px;
            }
        }
    </style>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = '{{ route('order.complete') }}';
                },
                onPending: function(result) {
                    window.location.href = '{{ route('order.history') }}';
                },
                onError: function(result) {
                    window.location.href = '{{ route('order.history') }}';
                },
                onClose: function() {
                    window.location.href = '{{ route('order.history') }}';
                }
            });
        });
    </script>
@endsection
