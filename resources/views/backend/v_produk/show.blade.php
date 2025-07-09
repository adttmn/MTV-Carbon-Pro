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
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm" style="border-radius: 15px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <i class="mdi mdi-package-variant text-info" style="font-size: 2rem;"></i>
                                    <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kategori</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="mdi mdi-tag"></i>
                                                    </span>
                                                </div>
                                                <select name="kategori_id"
                                                    class="form-control @error('kategori_id') is-invalid @enderror"
                                                    disabled>
                                                    <option value="" selected> - Pilih Kategori - </option>
                                                    @foreach ($kategori as $row)
                                                        <option value="{{ $row->id }}"
                                                            {{ old('kategori_id', $show->kategori_id) == $row->id ? 'selected' : '' }}>
                                                            {{ $row->nama_kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('kategori_id')
                                                <span class="invalid-feedback alert-danger"
                                                    role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Produk</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="mdi mdi-package"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="nama_produk"
                                                    value="{{ old('nama_produk', $show->nama_produk) }}"
                                                    class="form-control @error('nama_produk') is-invalid @enderror"
                                                    placeholder="Masukkan Nama Produk" disabled>
                                            </div>
                                            @error('nama_produk')
                                                <span class="invalid-feedback alert-danger"
                                                    role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Detail Produk</label>
                                            <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="ckeditor" disabled>{{ old('detail', $show->detail) }}</textarea>
                                            @error('detail')
                                                <span class="invalid-feedback alert-danger"
                                                    role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Foto Utama</label>
                                            <div class="border rounded p-2"
                                                style="height: 300px; display: flex; align-items: center; justify-content: center;">
                                                <img src="{{ asset('storage/img-produk/' . $show->foto) }}"
                                                    class="img-fluid" style="max-height: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Foto Tambahan</label>
                                            <div id="foto-container" class="border rounded p-3">
                                                <div class="row">
                                                    @foreach ($show->fotoProduk as $fotoProduk)
                                                        <div class="col-md-8 mb-3">
                                                            <div class="border rounded p-2"
                                                                style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                                                <img src="{{ asset('storage/img-produk/' . $fotoProduk->foto) }}"
                                                                    class="img-fluid" style="max-height: 100%;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3 d-flex align-items-center">
                                                            <form
                                                                action="{{ route('backend.foto_produk.destroy', $fotoProduk->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-block">
                                                                    <i class="fas fa-trash mr-2"></i>Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-info btn-block mt-3 add-foto">
                                                <i class="fas fa-plus mr-2"></i>Tambah Foto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <a href="{{ route('backend.produk.index') }}" class="btn btn-danger px-4"
                                        style="border-radius: 8px;">
                                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contentAkhir -->
        @endsection
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fotoContainer = document.getElementById('foto-container');
                const addFotoButton = document.querySelector('.add-foto');
                addFotoButton.addEventListener('click', function() {
                    const fotoRow = document.createElement('div');
                    fotoRow.classList.add('form-group', 'row');
                    fotoRow.innerHTML = `
                    <form action="{{ route('backend.foto_produk.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                    <input type="hidden" name="produk_id" value="{{ $show->id }}">
                    <input type="file" name="foto_produk[]" class="form-control
                    @error('foto_produk') is-invalid @enderror">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                    `;
                    fotoContainer.appendChild(fotoRow);
                });
            });
        </script>

</body>

</html>
