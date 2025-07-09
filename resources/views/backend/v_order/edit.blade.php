<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Order</title>
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
                            <a href="{{ route('backend.order.index') }}" class="btn btn-secondary"
                                style="border-radius: 8px;">
                                <i class="fas fa-arrow-left"></i><span class="ml-2"> Kembali</span>
                            </a>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow-sm" style="border-radius: 15px;">
                                    <div class="card-header bg-info text-white" style="border-radius: 15px 15px 0 0;">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-edit me-2"></i>Edit Status Order
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="POST" action="{{ route('backend.order.update', $order->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="customer_name" class="form-label fw-bold">
                                                            <i class="fas fa-user me-2"></i><span
                                                                class="ml-2">Customer</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="customer_name"
                                                            value="{{ $order->customer->user->nama ?? 'N/A' }}" readonly
                                                            style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="total_harga" class="form-label fw-bold">
                                                            <i class="fas fa-money-bill me-2"></i>Total Harga
                                                        </label>
                                                        <input type="text" class="form-control" id="total_harga"
                                                            value="Rp {{ number_format($order->total_harga, 0, ',', '.') }}"
                                                            readonly
                                                            style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label fw-bold">
                                                            <i class="fas fa-tasks me-2"></i><span class="ml-2">Status
                                                                Order</span> <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-select" id="status" name="status" required
                                                            style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px; font-size: 14px; transition: all 0.3s ease;">
                                                            <option value="" disabled>Pilih Status Order</option>
                                                            <option value="pending"
                                                                {{ $order->status == 'pending' ? 'selected' : '' }}
                                                                style="padding: 8px;">
                                                                <i class="fas fa-clock"></i> Pending
                                                            </option>
                                                            <option value="Paid"
                                                                {{ $order->status == 'Paid' ? 'selected' : '' }}
                                                                style="padding: 8px;">
                                                                <i class="fas fa-check-circle"></i> Dibayar
                                                            </option>
                                                            <option value="processing"
                                                                {{ $order->status == 'processing' ? 'selected' : '' }}
                                                                style="padding: 8px;">
                                                                <i class="fas fa-cogs"></i> Processing
                                                            </option>
                                                            <option value="shipped"
                                                                {{ $order->status == 'shipped' ? 'selected' : '' }}
                                                                style="padding: 8px;">
                                                                <i class="fas fa-shipping-fast"></i> Shipped
                                                            </option>
                                                            <option value="delivered"
                                                                {{ $order->status == 'delivered' ? 'selected' : '' }}
                                                                style="padding: 8px;">
                                                                <i class="fas fa-box-check"></i> Delivered
                                                            </option>
                                                            <option value="cancelled"
                                                                {{ $order->status == 'cancelled' ? 'selected' : '' }}
                                                                style="padding: 8px;">
                                                                <i class="fas fa-times-circle"></i> Cancelled
                                                            </option>
                                                        </select>
                                                        <div class="form-text">
                                                            <i class="fas fa-info-circle me-1"></i>
                                                            Pilih status yang sesuai dengan kondisi order saat ini
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="noresi" class="form-label fw-bold">
                                                            <i class="fas fa-truck me-2"></i><span class="ml-2">Nomor
                                                                Resi</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="noresi"
                                                            name="noresi" value="{{ $order->noresi }}"
                                                            placeholder="Masukkan nomor resi"
                                                            style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px; font-size: 14px; transition: all 0.3s ease;">
                                                        <div class="form-text">
                                                            <i class="fas fa-info-circle me-1"></i>
                                                            Masukkan nomor resi jika order sudah dikirim
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="kurir" class="form-label fw-bold">
                                                            <i class="fas fa-shipping-fast me-2"></i><span
                                                                class="ml-2">Kurir</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="kurir"
                                                            value="{{ $order->kurir ?? '-' }}" readonly
                                                            style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="created_at" class="form-label fw-bold">
                                                            <i class="fas fa-calendar me-2"></i><span
                                                                class="ml-2">Tanggal Order</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="created_at"
                                                            value="{{ $order->created_at->format('d/m/Y H:i') }}" readonly
                                                            style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat" class="form-label fw-bold">
                                                    <i class="fas fa-map-marker-alt me-2"></i><span class="ml-2">Alamat
                                                        Pengiriman</span>
                                                </label>
                                                <textarea class="form-control" id="alamat" rows="3" readonly
                                                    style="background-color: #f8f9fa; border: 1px solid #e9ecef;">{{ strip_tags($order->alamat ?? '-') }}</textarea>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-info" style="border-radius: 10px;">
                                                    <i class="fas fa-save"></i><span class="ml-2">Update Status</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
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
