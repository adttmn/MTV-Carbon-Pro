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
        <!-- contentAwal -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="mdi mdi-package-variant text-info" style="font-size: 2rem;"></i>
                            <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                        </div>

                        <form class="form-horizontal" action="{{ route('backend.produk.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Foto Produk</label>
                                        <div class="border rounded p-2 mb-2"
                                            style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                            <img class="foto-preview img-fluid" style="max-height: 100%;">
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="foto"
                                                class="custom-file-input @error('foto') is-invalid @enderror" id="foto"
                                                onchange="previewFoto()">
                                            <label class="custom-file-label" for="foto">Pilih file...</label>
                                        </div>
                                        @error('foto')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Kategori</label>
                                        <select class="form-control @error('kategori') is-invalid @enderror"
                                            name="kategori_id">
                                            <option value="" selected>--Pilih Kategori--</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama Produk</label>
                                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                                            class="form-control @error('nama_produk') is-invalid @enderror"
                                            placeholder="Masukkan nama produk">
                                        @error('nama_produk')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Detail Produk</label>
                                        <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="ckeditor" rows="4">{{ old('detail') }}</textarea>
                                        @error('detail')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Harga</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light">Rp</span>
                                                    </div>
                                                    <input type="text" onkeypress="return hanyaAngka(event)"
                                                        name="harga" value="{{ old('harga') }}"
                                                        class="form-control @error('harga') is-invalid @enderror"
                                                        placeholder="0">
                                                </div>
                                                @error('harga')
                                                    <span class="invalid-feedback alert-danger"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Berat (gram)</label>
                                                <input type="text" onkeypress="return hanyaAngka(event)" name="berat"
                                                    value="{{ old('berat') }}"
                                                    class="form-control @error('berat') is-invalid @enderror"
                                                    placeholder="0">
                                                @error('berat')
                                                    <span class="invalid-feedback alert-danger"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Stok</label>
                                                <input type="text" onkeypress="return hanyaAngka(event)" name="stok"
                                                    value="{{ old('stok') }}"
                                                    class="form-control @error('stok') is-invalid @enderror"
                                                    placeholder="0">
                                                @error('stok')
                                                    <span class="invalid-feedback alert-danger"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top mt-4">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-info px-4" style="border-radius: 8px;">
                                        <i class="fas fa-save mr-2"></i>Simpan
                                    </button>
                                    <a href="{{ route('backend.produk.index') }}" class="btn btn-danger px-4"
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
