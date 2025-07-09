@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-account-edit text-info" style="font-size: 2rem;"></i>
                            <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('backend.customer.show', $customer->id) }}" class="btn btn-info px-3 ml-2"
                                style="border-radius: 8px;">
                                <i class="fas fa-eye mr-2"></i>Detail Customer
                            </a>
                            <a href="{{ route('backend.customer.index') }}" class="btn btn-secondary px-3 ml-2"
                                style="border-radius: 8px;">
                                <i class="mdi mdi-arrow-left mr-2"></i>Kembali
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

                    <form action="{{ route('backend.customer.update', $customer->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        @if ($customer->user->foto)
                                            <img src="{{ asset('storage/img-customer/' . $customer->user->foto) }}"
                                                alt="Foto Customer" class="img-fluid rounded-circle shadow-sm mb-3"
                                                style="width: 200px; height: 200px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 200px; height: 200px;">
                                                <i class="mdi mdi-account text-muted" style="font-size: 4rem;"></i>
                                            </div>
                                        @endif
                                        <div class="position-absolute top-0 end-0">
                                            <label for="foto" class="btn btn-sm btn-info rounded-circle" 
                                                style="width: 40px; height: 40px; cursor: pointer;"
                                                title="Ubah Foto">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="foto" id="foto"
                                            class="form-control @error('foto') is-invalid @enderror" accept="image/*"
                                            style="border-radius: 8px; display: none;">
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 1MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-account"></i>
                                                </span>
                                                <input type="text" name="nama"
                                                    value="{{ old('nama', $customer->user->nama) }}"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    placeholder="Masukkan nama lengkap" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-email"></i>
                                                </span>
                                                <input type="email" name="email"
                                                    value="{{ old('email', $customer->user->email) }}"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Masukkan email" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">Nomor HP <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-phone"></i>
                                                </span>
                                                <input type="text" name="hp"
                                                    value="{{ old('hp', $customer->user->hp) }}"
                                                    class="form-control @error('hp') is-invalid @enderror"
                                                    placeholder="Masukkan nomor HP" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                            @error('hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">Status</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-toggle-switch"></i>
                                                </span>
                                                <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror"
                                                    style="border-radius: 0 8px 8px 0;">
                                                    <option value="1"
                                                        {{ old('status', $customer->user->status) == 1 ? 'selected' : '' }}>
                                                        Aktif</option>
                                                    <option value="0"
                                                        {{ old('status', $customer->user->status) == 0 ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                </select>
                                            </div>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Alamat <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="mdi mdi-map-marker"></i>
                                        </span>
                                        <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
                                            placeholder="Masukkan alamat lengkap" style="border-radius: 0 8px 8px 0;">{{ old('alamat', $customer->alamat) }}</textarea>
                                    </div>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">Kode POS <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="mdi mdi-postage-stamp"></i>
                                                </span>
                                                <input type="text" name="pos"
                                                    value="{{ old('pos', $customer->pos) }}"
                                            <input type="text" name="pos"
                                                value="{{ old('pos', $customer->pos) }}"
                                                class="form-control @error('pos') is-invalid @enderror"
                                                placeholder="Masukkan kode POS" style="border-radius: 8px;">
                                            @error('pos')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info px-4" style="border-radius: 8px;">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('backend.customer.index') }}" class="btn btn-danger  px-4 ml-2"
                            style="border-radius: 8px;">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- contentAkhir -->
@endsection
