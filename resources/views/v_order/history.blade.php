@extends('v_layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="order-summary clearfix">
            <div class="section-title">
                <p>HISTORY</p>
                <h3 class="title">HISTORY PESANAN</h3>
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
            @if ($orders->count() > 0)
                <table class="shopping-cart-table table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>Rp. {{ number_format($order->total_harga + $order->biaya_ongkir, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        // Status badge color mapping
                                        $status = strtolower($order->status);
                                        $badgeClass = '';
                                        $statusText = '';
                                        switch ($status) {
                                            case 'paid':
                                                $badgeClass = 'badge-warning';
                                                $statusText = 'Dibayar';
                                                break;
                                            case 'processing':
                                                $badgeClass = 'badge-primary';
                                                $statusText = 'Processing';
                                                break;
                                            case 'shipped':
                                                $badgeClass = 'badge-info';
                                                $statusText = 'Shipped';
                                                break;
                                            case 'delivered':
                                                $badgeClass = 'badge-success';
                                                $statusText = 'Delivered';
                                                break;
                                            case 'cancelled':
                                                $badgeClass = 'badge-danger';
                                                $statusText = 'Cancelled';
                                                break;
                                            default:
                                                $badgeClass = 'badge-secondary';
                                                $statusText = ucfirst($order->status);
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#orderDetailModal{{ $order->id }}">
                                        <i class="fa fa-eye"></i> Lihat Detail
                                    </button>
                                    <a href="{{ route('order.invoice', $order->id) }}" target="_blank">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-file-text"></i> Invoice
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal for each order -->
                @foreach ($orders as $order)
                    <div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="orderDetailModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header"
                                    style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                    <h5 class="modal-title" id="orderDetailModalLabel{{ $order->id }}">
                                        <i class="fa fa-shopping-cart"></i> Detail Pesanan #{{ $order->id }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">
                                                    <h6 class="mb-0"><i class="fa fa-truck"></i> Informasi Pengiriman</h6>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-2">
                                                        <strong>Alamat:</strong><br>
                                                        {!! $order->alamat !!}
                                                    </p>
                                                    <p class="mb-2">
                                                        <strong>Kurir:</strong> {{ $order->kurir }}<br>
                                                        <strong>Layanan:</strong> {{ $order->layanan_ongkir }}<br>
                                                        <strong>Estimasi:</strong> {{ $order->estimasi_ongkir }} Hari<br>
                                                        <strong>Berat Total:</strong> {{ $order->total_berat }} Gram
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-info text-white">
                                                    <h6 class="mb-0"><i class="fa fa-info-circle"></i> Status Pesanan</h6>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-2">
                                                        <strong>Status:</strong>
                                                        @php
                                                            $status = strtolower($order->status);
                                                            $badgeClass = '';
                                                            $statusText = '';
                                                            switch ($status) {
                                                                case 'paid':
                                                                    $badgeClass = 'badge-warning text-white';
                                                                    $statusText = 'Dibayar';
                                                                    break;
                                                                case 'processing':
                                                                    $badgeClass = 'badge-primary';
                                                                    $statusText = 'Proses';
                                                                    break;
                                                                case 'shipped':
                                                                    $badgeClass = 'badge-info';
                                                                    $statusText = 'Shipped';
                                                                    break;
                                                                case 'delivered':
                                                                    $badgeClass = 'badge-success';
                                                                    $statusText = 'Delivered';
                                                                    break;
                                                                case 'cancelled':
                                                                    $badgeClass = 'badge-danger';
                                                                    $statusText = 'Cancelled';
                                                                    break;
                                                                default:
                                                                    $badgeClass = 'badge-secondary';
                                                                    $statusText = ucfirst($order->status);
                                                                    break;
                                                            }
                                                        @endphp
                                                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                                    </p>
                                                    <p class="mb-2">
                                                        <strong>Tanggal:</strong>
                                                        {{ $order->created_at->format('d M Y H:i') }}
                                                    </p>
                                                    @if ($order->noresi)
                                                        <p class="mb-0">
                                                            <strong>No. Resi:</strong> {{ $order->noresi }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0"><i class="fa fa-list"></i> Detail Produk</h6>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th style="width: 50%">Produk</th>
                                                            <th class="text-center">Harga</th>
                                                            <th class="text-center">Jumlah</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $totalHarga = 0;
                                                        @endphp
                                                        @foreach ($order->orderItems as $item)
                                                            @php
                                                                $totalHarga += $item->harga * $item->quantity;
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}"
                                                                            alt="{{ $item->produk->nama_produk }}"
                                                                            style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;">
                                                                        <div>
                                                                            <h6 class="mb-1">
                                                                                {{ $item->produk->nama_produk }}</h6>
                                                                            <small class="text-muted">Berat:
                                                                                {{ $item->produk->berat }} Gram</small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center align-middle">Rp.
                                                                    {{ number_format($item->harga, 0, ',', '.') }}</td>
                                                                <td class="text-center align-middle">{{ $item->quantity }}
                                                                </td>
                                                                <td class="text-center align-middle">Rp.
                                                                    {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="bg-light">
                                                        <tr>
                                                            <td colspan="3" class="text-right"><strong>Subtotal:</strong>
                                                            </td>
                                                            <td class="text-center">Rp.
                                                                {{ number_format($totalHarga, 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-right"><strong>Ongkos
                                                                    Kirim:</strong></td>
                                                            <td class="text-center">Rp.
                                                                {{ number_format($order->biaya_ongkir, 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr class="bg-primary text-white">
                                                            <td colspan="3" class="text-right"><strong>Total:</strong>
                                                            </td>
                                                            <td class="text-center"><strong>Rp.
                                                                    {{ number_format($totalHarga + $order->biaya_ongkir, 0, ',', '.') }}</strong>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="background-color: #f8f9fa; border-top: 2px solid #dee2e6;">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <i class="fa fa-times"></i> Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Anda belum memiliki riwayat pesanan.
                </div>
            @endif
        </div>
    </div>

    <style>
        .badge {
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        .badge-primary {
            background-color: #007bff !important;
            color: #fff !important;
        }

        .badge-info {
            background-color: #17a2b8 !important;
            color: #fff !important;
        }

        .badge-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }

        .badge-danger {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        .badge-secondary {
            background-color: #6c757d !important;
            color: #fff !important;
        }

        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 12px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .table th {
            border-top: none;
            background-color: #f8f9fa;
        }

        .modal-content {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 15px 20px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
        }

        .primary-btn {
            margin-right: 5px;
        }

        .primary-btn i {
            margin-right: 5px;
        }
    </style>
@endsection
