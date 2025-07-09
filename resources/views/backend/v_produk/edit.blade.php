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

                            <form action="{{ route('backend.produk.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Foto Produk</label>
                                            <div class="border rounded p-2 mb-2" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                                @if ($edit->foto)
                                                    <img src="{{ asset('storage/img-produk/' . $edit->foto) }}" class="foto-preview img-fluid" style="max-height: 100%;">
                                                @else
                                                    <img src="{{ asset('storage/img-produk/imgdefault.jpg') }}" class="foto-preview img-fluid" style="max-height: 100%;">
                                                @endif
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" onchange="previewFoto()">
                                                <label class="custom-file-label" for="foto">Pilih file...</label>
                                            </div>
                                            @error('foto')
                                                <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Status</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="" {{ old('status', $edit->status) == '' ? 'selected' : '' }}>Pilih Status</option>
                                                <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Public</option>
                                                <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Block</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Kategori</label>
                                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $row)
                                                    <option value="{{ $row->id }}" {{ old('kategori_id', $edit->kategori_id) == $row->id ? 'selected' : '' }}>
                                                        {{ $row->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Produk</label>
                                            <input type="text" name="nama_produk" value="{{ old('nama_produk', $edit->nama_produk) }}"
                                                class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Masukkan nama produk">
                                            @error('nama_produk')
                                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Detail Produk</label>
                                            <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="ckeditor">{{ old('detail', $edit->detail) }}</textarea>
                                            @error('detail')
                                                <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
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
                                                        <input type="text" onkeypress="return hanyaAngka(event)" name="harga"
                                                            value="{{ old('harga', $edit->harga) }}"
                                                            class="form-control @error('harga') is-invalid @enderror" placeholder="0">
                                                    </div>
                                                    @error('harga')
                                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Berat (gram)</label>
                                                    <input type="text" onkeypress="return hanyaAngka(event)" name="berat"
                                                        value="{{ old('berat', $edit->berat) }}"
                                                        class="form-control @error('berat') is-invalid @enderror" placeholder="0">
                                                    @error('berat')
                                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Stok</label>
                                                    <input type="text" onkeypress="return hanyaAngka(event)" name="stok"
                                                        value="{{ old('stok', $edit->stok) }}"
                                                        class="form-control @error('stok') is-invalid @enderror" placeholder="0">
                                                    @error('stok')
                                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top mt-4">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-info px-4" style="border-radius: 8px;">
                                            <i class="fas fa-save mr-2"></i>Perbaharui
                                        </button>
                                        <a href="{{ route('backend.produk.index') }}" class="btn btn-danger px-4" style="border-radius: 8px;">
                                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contentAkhir -->
    @endsection

</body>

</html>
