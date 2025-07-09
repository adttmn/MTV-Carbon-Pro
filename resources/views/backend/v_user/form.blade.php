<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

                        <form class="form-horizontal" action="{{ route('backend.laporan.cetakuser') }}" method="post"
                            target="_blank">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tanggal Awal</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tanggal Akhir</label>
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
