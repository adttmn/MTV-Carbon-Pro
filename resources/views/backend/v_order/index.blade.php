<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
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
                            <div class="d-flex gap-2">
                                <a href="{{ route('backend.laporan.formorder') }}" class="btn btn-info px-3"
                                    style="border-radius: 8px;">
                                    <i class="mdi mdi-file-document mr-2"></i>Laporan Order
                                </a>
                                <a href="{{ route('backend.laporan.formorderbystatus') }}" class="btn btn-warning px-3"
                                    style="border-radius: 8px;">
                                    <i class="mdi mdi-filter mr-2"></i>Laporan by Status
                                </a>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="border-radius: 10px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle me-2" style="font-size: 1.1rem;"></i>
                                    <span class="fw-semibold">{{ session('success') }}</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                    style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%);"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 15%">Customer</th>
                                        <th style="width: 10%">Total Harga</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 15%">Kurir</th>
                                        <th style="width: 15%">No. Resi</th>
                                        <th style="width: 10%">Tanggal</th>
                                        <th class="text-center" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $order->customer->user->nama ?? 'N/A' }}</strong><br>
                                                <small
                                                    class="text-muted">{{ $order->customer->user->email ?? 'N/A' }}</small>
                                            </td>
                                            <td>
                                                <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                                            </td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <span class="badge bg-secondary text-white px-3 py-2 fw-semibold"
                                                        style="border-radius: 8px; font-size: 0.85rem;">
                                                        Pending
                                                    </span>
                                                @elseif($order->status == 'Paid')
                                                    <span class="badge bg-warning text-white px-3 py-2 fw-semibold"
                                                        style="border-radius: 8px; font-size: 0.85rem;">
                                                        Dibayar
                                                    </span>
                                                @elseif($order->status == 'processing')
                                                    <span class="badge bg-primary text-white px-3 py-2 fw-semibold"
                                                        style="border-radius: 8px; font-size: 0.85rem;">
                                                        Processing
                                                    </span>
                                                @elseif($order->status == 'shipped')
                                                    <span class="badge bg-info text-white px-3 py-2 fw-semibold"
                                                        style="border-radius: 8px; font-size: 0.85rem;">
                                                        Shipped
                                                    </span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge bg-success text-white px-3 py-2 fw-semibold"
                                                        style="border-radius: 8px; font-size: 0.85rem;">
                                                        Delivered
                                                    </span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="badge bg-danger text-white px-3 py-2 fw-semibold"
                                                        style="border-radius: 8px; font-size: 0.85rem;">
                                                        Cancelled
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $order->kurir ?? '-' }}</td>
                                            <td>{{ $order->noresi ?? '-' }}</td>
                                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-3">
                                                    <a href="{{ route('backend.order.edit', $order->id) }}"
                                                        class="btn btn-info btn-sm" title="Edit Status"
                                                        style="border-radius: 6px; margin-right: 5px;">
                                                        <i class="far fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('backend.order.show', $order->id) }}"
                                                        class="btn btn-success btn-sm" title="Detail Order"
                                                        style="border-radius: 6px; margin-left: 5px;">
                                                        <i class="fas fa-eye"></i>
                                                        Detail
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contentAkhir -->
    @endsection

</body>

</html>
