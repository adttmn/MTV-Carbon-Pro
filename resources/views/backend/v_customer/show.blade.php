@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-account text-info" style="font-size: 2rem;"></i>
                            <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('backend.customer.edit', $customer->id) }}" class="btn btn-info px-3"
                                style="border-radius: 8px;">
                                <i class="far fa-edit mr-2"></i>Edit Customer
                            </a>
                            <a href="{{ route('backend.customer.index') }}" class="btn btn-secondary px-3"
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

                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                                <div class="card-body text-center p-4">
                                    <div class="position-relative mb-4">
                                        @if ($customer->user->foto)
                                            <img src="{{ asset('storage/img-customer/' . $customer->user->foto) }}"
                                                alt="Foto Customer" class="img-fluid rounded-circle shadow-lg"
                                                style="width: 180px; height: 180px; object-fit: cover; border: 4px solid #fff;">
                                        @else
                                            <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-lg"
                                                style="width: 180px; height: 180px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                <i class="mdi mdi-account text-white" style="font-size: 4rem;"></i>
                                            </div>
                                        @endif
                                        <div class="position-absolute bottom-0 end-0">
                                            @if ($customer->user->status == 1)
                                                <span class="badge bg-success rounded-pill px-3 py-2" style="border-radius: 8px;">
                                                    <i class="fas fa-check-circle me-1 text-white"></i><span class="text-white">Aktif</span>
                                                </span>
                                            @else
                                                <span class="badge bg-danger rounded-pill px-3 py-2" style="border-radius: 8px;">
                                                    <i class="fas fa-times-circle me-1"></i><span class="text-white">Tidak Aktif</span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">{{ $customer->user->nama }}</h5>
                                    <p class="text-muted mb-3">
                                        <i class="mdi mdi-email-outline me-1"></i>{{ $customer->user->email }}
                                    </p>
                                    <div class="d-grid">
                                        <a href="{{ route('backend.customer.edit', $customer->id) }}" 
                                           class="btn btn-info btn-sm" style="border-radius: 8px;">
                                            <i class="far fa-edit me-1"></i>Edit Profil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8 col-md-7">
                            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold text-dark mb-4">
                                        <i class="mdi mdi-information-outline me-2 text-primary"></i>Informasi Detail
                                    </h6>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="info-item p-3 bg-light rounded-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="mdi mdi-phone text-primary me-2"></i>
                                                    <small class="text-muted fw-semibold">Nomor HP</small>
                                                </div>
                                                <p class="mb-0 fw-bold text-dark">{{ $customer->user->hp }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="info-item p-3 bg-light rounded-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="mdi mdi-map-marker text-primary me-2"></i>
                                                    <small class="text-muted fw-semibold">Kode POS</small>
                                                </div>
                                                <p class="mb-0 fw-bold text-dark">{{ $customer->pos }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="info-item p-3 bg-light rounded-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="mdi mdi-home text-primary me-2"></i>
                                                    <small class="text-muted fw-semibold">Alamat Lengkap</small>
                                                </div>
                                                <p class="mb-0 fw-bold text-dark">{{ $customer->alamat }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="info-item p-3 bg-light rounded-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="mdi mdi-calendar text-primary me-2"></i>
                                                    <small class="text-muted fw-semibold">Tanggal Registrasi</small>
                                                </div>
                                                <p class="mb-0 fw-bold text-dark">
                                                    {{ \Carbon\Carbon::parse($customer->created_at)->locale('id')->isoFormat('D MMMM Y') }}
                                                </p>
                                                <small class="text-muted">{{ $customer->created_at->format('H:i') }} WIB</small>
                                            </div>
                                        </div>
                                        
                                        @if ($customer->google_id)
                                        <div class="col-md-6">
                                            <div class="info-item p-3 bg-light rounded-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="mdi mdi-google text-primary me-2"></i>
                                                    <small class="text-muted fw-semibold">Google ID</small>
                                                </div>
                                                <p class="mb-0 fw-bold text-dark">{{ $customer->google_id }}</p>
                                                <small class="text-success">
                                                    <i class="fas fa-check-circle me-1"></i>Terdaftar via Google
                                                </small>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
