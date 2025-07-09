<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori</title>
</head>

<body>
    @extends('backend.v_layouts.app')
    @section('content')
        <!-- contentAwal -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="mdi mdi-tag-multiple text-info" style="font-size: 2rem;"></i>
                            <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                        </div>

                        <form class="form-horizontal" action="{{ route('backend.kategori.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Kategori</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="mdi mdi-tag"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                                        class="form-control @error('nama_kategori') is-invalid @enderror"
                                        placeholder="Masukkan Nama Kategori" style="border-radius: 0 8px 8px 0;">
                                    @error('nama_kategori')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="border-top mt-4">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-info px-4" style="border-radius: 8px;">
                                        <i class="fas fa-save mr-2"></i>Simpan
                                    </button>
                                    <a href="{{ route('backend.kategori.index') }}" class="btn btn-secondary px-4"
                                        style="border-radius: 8px;">
                                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- contentAkhir -->
    @endsection

</body>

</html>
