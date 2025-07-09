@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <i class="mdi mdi-account-multiple text-info" style="font-size: 2rem;"></i>
                        <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
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

                    <div class="table-responsive">
                        <table id="zero_config" class="table table-hover table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" style="width: 5%">No</th>
                                    <th style="width: 25%">Nama</th>
                                    <th style="width: 25%">Email</th>
                                    <th style="width: 15%">Status</th>
                                    <th style="width: 15%">Tanggal Registrasi</th>
                                    <th class="text-center" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($row->user->foto)
                                                    <img src="{{ asset('storage/img-customer/' . $row->user->foto) }}"
                                                        alt="Foto" class="rounded-circle me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="mdi mdi-account text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $row->user->nama }}</strong><br>
                                                    <small class="text-muted">{{ $row->user->hp }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $row->user->email }}</td>
                                        <td>
                                            @if ($row->user->status == 1)
                                                <span class="badge bg-success text-white" style="border-radius: 5px; font-weight: 600; ">
                                                    <i class="fas fa-check-circle me-1 text-white"></i><span class="text-white">Aktif</span>
                                                </span>
                                            @else
                                                <span class="badge bg-danger" style="border-radius: 5px; font-weight: 600; ">
                                                    <i class="fas fa-times-circle me-1"></i><span class="text-white">Tidak Aktif</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $row->created_at->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('backend.customer.show', $row->id) }}"
                                                    class="btn btn-info btn-sm" title="Detail Customer"
                                                    style="border-radius: 6px; margin-right: 10px;">
                                                    <i class="fas fa-eye"></i>
                                                    Detail
                                                </a>
                                                <a href="{{ route('backend.customer.edit', $row->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit Customer"
                                                    style="border-radius: 6px; margin-right: 5px;">
                                                    <i class="far fa-edit"></i>
                                                    Edit
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('backend.customer.destroy', $row->id) }}"
                                                    style="display: inline-block;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer {{ $row->user->nama }}?')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Hapus Customer" style="border-radius: 6px; margin-left: 5px;">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
