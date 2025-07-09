<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Laporan Order Berdasarkan Status</title>
</head>

<body>
    @extends('backend.v_layouts.app')
    @section('content')
        <!-- template -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="mdi mdi-file-document text-info" style="font-size: 2rem;"></i>
                            <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                        </div>

                        <form class="form-horizontal" action="{{ route('backend.laporan.cetakorderbystatus') }}"
                            method="post" target="_blank">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Status Order</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-filter"></i>
                                                </span>
                                            </div>
                                            <select name="status"
                                                class="form-control @error('status') is-invalid @enderror"
                                                style="border-radius: 0 8px 8px 0;">
                                                <option value="">Pilih Status Order</option>
                                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="Paid" {{ old('status') == 'Paid' ? 'selected' : '' }}>
                                                    Dibayar
                                                </option>
                                                <option value="processing"
                                                    {{ old('status') == 'processing' ? 'selected' : '' }}>Processing
                                                </option>
                                                <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>
                                                    Shipped</option>
                                                <option value="delivered"
                                                    {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="cancelled"
                                                    {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tanggal Awal (Opsional)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-calendar"></i>
                                                </span>
                                            </div>
                                            <input type="date" name="tanggal_awal" value="{{ old('tanggal_awal') }}"
                                                class="form-control @error('tanggal_awal') is-invalid @enderror"
                                                style="border-radius: 0 8px 8px 0;">
                                            @error('tanggal_awal')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tanggal Akhir (Opsional)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-calendar"></i>
                                                </span>
                                            </div>
                                            <input type="date" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}"
                                                class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                                style="border-radius: 0 8px 8px 0;">
                                            @error('tanggal_akhir')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-info px-4" style="border-radius: 8px;">
                                    <i class="mdi mdi-printer mr-2"></i>Cetak Laporan
                                </button>
                                <a href="{{ route('backend.order.index') }}" class="btn btn-secondary px-4 ml-2"
                                    style="border-radius: 8px;">
                                    <i class="mdi mdi-arrow-left mr-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end template-->
    @endsection

</body>

</html>
