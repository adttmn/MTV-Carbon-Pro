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
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-radius: 15px;">
                        <form action="{{ route('backend.user.update', $edit->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <i class="mdi mdi-account-edit text-info" style="font-size: 2rem;"></i>
                                    <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Foto</label>
                                            <div class="image-preview-container mb-3">
                                                @if ($edit->foto)
                                                    <img src="{{ asset('storage/img-user/' . $edit->foto) }}"
                                                        class="foto-preview img-fluid rounded shadow-sm"
                                                        style="width: 100%; height: auto;">
                                                @else
                                                    <img src="{{ asset('storage/img-user/img-default.jpg') }}"
                                                        class="foto-preview img-fluid rounded shadow-sm"
                                                        style="width: 100%; height: auto;">
                                                @endif
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="foto"
                                                    class="custom-file-input @error('foto') is-invalid @enderror"
                                                    id="foto" onchange="previewFoto()">
                                                <label class="custom-file-label" for="foto">Pilih file...</label>
                                                @error('foto')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Hak Akses</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="mdi mdi-shield-account"></i>
                                                    </span>
                                                </div>
                                                <select name="role"
                                                    class="form-control @error('role') is-invalid @enderror">
                                                    <option value=""
                                                        {{ old('role', $edit->role) == '' ? 'selected' : '' }}>- Pilih Hak
                                                        Akses -</option>
                                                    <option value="1"
                                                        {{ old('role', $edit->role) == '1' ? 'selected' : '' }}>Super Admin
                                                    </option>
                                                    <option value="2"
                                                        {{ old('role', $edit->role) == '2' ? 'selected' : '' }}>Admin
                                                    </option>
                                                    <option value="3"
                                                        {{ old('role', $edit->role) == '3' ? 'selected' : '' }}>Customer
                                                    </option>
                                                </select>
                                                @error('role')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Status</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="mdi mdi-toggle-switch"></i>
                                                    </span>
                                                </div>
                                                <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                    <option value=""
                                                        {{ old('status', $edit->status) == '' ? 'selected' : '' }}>- Pilih
                                                        Status -</option>
                                                    <option value="1"
                                                        {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="0"
                                                        {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>
                                                        NonAktif</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="mdi mdi-account"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="nama" value="{{ old('nama', $edit->nama) }}"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    placeholder="Masukkan Nama">
                                                @error('nama')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="mdi mdi-email"></i>
                                                    </span>
                                                </div>
                                                <input type="email" name="email"
                                                    value="{{ old('email', $edit->email) }}"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Masukkan Email">
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">HP</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="mdi mdi-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="text" onkeypress="return hanyaAngka(event)" name="hp"
                                                    value="{{ old('hp', $edit->hp) }}"
                                                    class="form-control @error('hp') is-invalid @enderror"
                                                    placeholder="Masukkan Nomor HP">
                                                @error('hp')
                                                    <span class="invalid-feedback">{{ $message }}</span>
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
                                    <a href="{{ route('backend.user.index') }}" class="btn btn-danger px-4"
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
