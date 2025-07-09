<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Order</title>
</head>

<body>
    @extends('backend.v_layouts.app')
    @section('content')
        <!-- contentAwal -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-cart text-info" style="font-size: 2rem;"></i>
                                <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                            </div>
                            <div>
                                <a href="{{ route('backend.order.edit', $order->id) }}" class="btn btn-info me-2"
                                    style="border-radius: 8px;">
                                    <i class="fas fa-edit"></i> Edit Status
                                </a>
                                <a href="{{ route('backend.order.index') }}" class="btn btn-secondary"
                                    style="border-radius: 8px;">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Informasi Order -->
                                <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                                    <div class="card-header bg-info text-white" style="border-radius: 15px 15px 0 0;">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-shopping-cart me-2"></i>Informasi Order
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Order ID</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-hashtag"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="#{{ $order->id }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Tanggal Order</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->created_at->format('d/m/Y H:i') }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Status</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-info-circle"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="@if ($order->status == 'pending') Pending @elseif($order->status == 'Paid')Dibayar @elseif($order->status == 'processing')Processing @elseif($order->status == 'shipped')Shipped @elseif($order->status == 'delivered')Delivered @elseif($order->status == 'cancelled')Cancelled @endif"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Total Harga</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-money-bill"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="Rp {{ number_format($order->total_harga, 0, ',', '.') }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Kurir</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-truck"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->kurir ?? '-' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Layanan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-shipping-fast"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->layanan_ongkir ?? '-' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">No. Resi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-barcode"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->noresi ?? '-' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Biaya Ongkir</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-shipping-fast"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="Rp {{ number_format($order->biaya_ongkir ?? 0, 0, ',', '.') }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Customer -->
                                <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                                    <div class="card-header bg-info text-white" style="border-radius: 15px 15px 0 0;">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-user me-2"></i>Informasi Customer
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Nama</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-user"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->customer->user->nama ?? 'N/A' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-envelope"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->customer->user->email ?? 'N/A' }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Telepon</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->customer->user->hp ?? '-' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="font-weight-bold text-dark">Kode Pos</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->pos ?? '-' }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold text-dark">Alamat Pengiriman</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                </div>
                                                <textarea class="form-control" rows="3" readonly>{{ strip_tags($order->alamat ?? '-') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Detail Produk -->
                                <div class="card shadow-sm" style="border-radius: 15px;">
                                    <div class="card-header bg-info text-white" style="border-radius: 15px 15px 0 0;">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-box-open me-2"></i>Detail Produk
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        @if ($order->orderItems->count() > 0)
                                            <div class="product-list">
                                                @foreach ($order->orderItems as $item)
                                                    <div class="product-item mb-4 p-3"
                                                        style="border: 1px solid #e9ecef; border-radius: 10px; background: #f8f9fa;">
                                                        <div class="d-flex align-items-start">
                                                            <div class="product-image me-3">
                                                                <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}"
                                                                    alt="{{ $item->produk->nama_produk }}"
                                                                    class="rounded shadow-sm"
                                                                    style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #fff;">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 fw-bold text-dark">
                                                                    {{ $item->produk->nama_produk }}</h6>
                                                                <div class="product-details">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center mb-1">
                                                                        <span class="badge bg-info text-white">
                                                                            <i class="fas fa-shopping-cart me-1"></i>
                                                                            Qty: {{ $item->quantity }}
                                                                        </span>
                                                                        <span class="badge bg-success text-white">
                                                                            <i class="fas fa-tag me-1"></i>
                                                                            Rp
                                                                            {{ number_format($item->harga, 0, ',', '.') }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="total-price">
                                                                        <strong class="text-primary">
                                                                            Total: Rp
                                                                            {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <!-- Summary Section -->
                                                <div class="summary-section mt-4 p-3"
                                                    style="background: linear-gradient(135deg,rgb(13, 40, 160) 0%,rgb(24, 23, 24) 100%); border-radius: 10px; color: white;">
                                                    <h6 class="mb-3 text-center">
                                                        <i class="fas fa-calculator me-2"></i>Ringkasan
                                                    </h6>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Total Item:</span>
                                                        <strong>{{ $order->orderItems->sum('quantity') }}</strong>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Total Harga:</span>
                                                        <strong>Rp
                                                            {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                                                    </div>
                                                    @if ($order->biaya_ongkir)
                                                        <div class="d-flex justify-content-between mb-2">
                                                            <span>Ongkir:</span>
                                                            <strong>Rp
                                                                {{ number_format($order->biaya_ongkir, 0, ',', '.') }}</strong>
                                                        </div>
                                                        <hr style="border-color: rgba(255,255,255,0.3);">
                                                        <div class="d-flex justify-content-between">
                                                            <span><strong>Grand Total:</strong></span>
                                                            <strong>Rp
                                                                {{ number_format($order->total_harga + $order->biaya_ongkir, 0, ',', '.') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-center py-4">
                                                <i class="fas fa-box-open text-muted" style="font-size: 3rem;"></i>
                                                <p class="text-muted mt-2">Tidak ada produk dalam order ini</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contentAkhir -->
    @endsection

</body>

</html>
