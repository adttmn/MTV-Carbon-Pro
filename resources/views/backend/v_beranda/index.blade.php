<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MTV Carbon Pro</title>
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
                            <i class="mdi mdi-view-dashboard text-primary" style="font-size: 2rem;"></i>
                            <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                        </div>

                        <div class="welcome-card p-4 rounded-lg"
                            style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="welcome-icon mr-3">
                                    <i class="mdi mdi-account-circle text-success" style="font-size: 3rem;"></i>
                                </div>
                                <div>
                                    <h3 class="mb-1">Selamat Datang, {{ Auth::user()->nama }}</h3>
                                    <p class="text-muted mb-0">
                                        Anda login sebagai
                                        <span class="badge badge-success px-1 py-2" style="border-radius: 8px;">
                                            @if (Auth::user()->role == 1)
                                                Admin
                                            @elseif(Auth::user()->role == 2)
                                                Customer
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="mb-0">
                                    Ini adalah halaman utama dari Web MTV Carbon Pro.
                                    Gunakan menu di sidebar untuk mengakses fitur-fitur yang tersedia.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contentAkhir -->
    @endsection


</html>
