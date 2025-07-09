<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @Extends('backend.v_layouts.app')
    @section('content')
        <!-- contentAwal -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="mdi mdi-account-plus text-primary" style="font-size: 2rem;"></i>
                            <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                        </div>

                        <form class="form-horizontal" action="{{ route('backend.user.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Foto</label>
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
                                        <label class="font-weight-bold">Hak Akses</label>
                                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                                            <option value="" {{ old('role') == '' ? 'selected' : '' }}>-- Pilih Hak
                                                Akses --</option>
                                            <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Super Admin
                                            </option>
                                            <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Admin</option>
                                            <option value="3" {{ old('role') == '3' ? 'selected' : '' }}>Customer
                                            </option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-account"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="nama" value="{{ old('nama') }}"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="Masukkan Nama" style="border-radius: 0 8px 8px 0;">
                                            @error('nama')
                                                <span class="invalid-feedback alert-danger"
                                                    role="alert">{{ $message }}</span>
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
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukkan Email" style="border-radius: 0 8px 8px 0;">
                                            @error('email')
                                                <span class="invalid-feedback alert-danger"
                                                    role="alert">{{ $message }}</span>
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
                                                value="{{ old('hp') }}"
                                                class="form-control @error('hp') is-invalid @enderror"
                                                placeholder="Masukkan Nomor HP" style="border-radius: 0 8px 8px 0;">
                                            @error('hp')
                                                <span class="invalid-feedback alert-danger"
                                                    role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan Password" style="border-radius: 0 8px 8px 0;">
                                            @error('password')
                                                <span class="invalid-feedback alert-danger"
                                                    role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-lock-check"></i>
                                                </span>
                                            </div>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi Password" style="border-radius: 0 8px 8px 0;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top mt-4">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-info px-4" style="border-radius: 8px;">
                                        <i class="fas fa-save mr-2"></i>Simpan
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
