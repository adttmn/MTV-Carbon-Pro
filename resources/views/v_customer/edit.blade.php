@extends('v_layouts.app')
@section('content')
    <style>
        .profile-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-top: 30px;
            margin-bottom: 30px;
            transition: box-shadow 0.3s;
        }
        .profile-card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        }
        .profile-avatar {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 16px; /* kotak dengan sudut sedikit melengkung */
            border: 4px solid #f1f1f1;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            background: #f8f8f8;
            transition: box-shadow 0.2s;
        }
        .profile-avatar:hover {
            box-shadow: 0 4px 16px rgba(143,148,251,0.18);
        }
        .profile-title {
            font-weight: 700;
            font-size: 2rem;
            color: #2d3e50;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .form-label {
            font-weight: 600;
            color: #34495e;
        }
        .primary-btn {
            background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 0.7rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(78,84,200,0.12);
            transition: background 0.2s, box-shadow 0.2s;
        }
        .primary-btn:hover {
            background: linear-gradient(90deg, #8f94fb 0%, #4e54c8 100%);
            box-shadow: 0 4px 16px rgba(78,84,200,0.18);
        }
        .alert {
            border-radius: 10px;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: #8f94fb;
            box-shadow: 0 0 0 0.2rem rgba(143,148,251,0.15);
        }
        .invalid-feedback {
            font-size: 0.95rem;
        }
        @media (max-width: 767px) {
            .profile-card {
                padding: 1.2rem 0.5rem;
            }
            .profile-title {
                font-size: 1.3rem;
            }
            .profile-avatar {
                width: 100%;
                height: 160px;
            }
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="profile-card">
                    <div class="text-center mb-4">
                        <div class="profile-title">{{ $judul }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 text-center mb-4 mb-md-0 d-flex flex-column align-items-center justify-content-center">
                            {{-- view image --}}
                            <div class="d-flex flex-column align-items-center w-100">
                                @if ($edit->foto)
                                    <img src="{{ asset('storage/img-customer/' . $edit->foto) }}" class="profile-avatar foto-preview" id="fotoPreview">
                                @else
                                    <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="profile-avatar foto-preview" id="fotoPreview">
                                @endif
                                <div style="width:100%;">
                                    <label class="form-label mt-3 mb-0 w-100 text-center" for="foto" style="display:block;">Ubah Foto Profil</label>
                                    <form id="fotoForm" enctype="multipart/form-data" style="width:100%;">
                                        <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror mt-2" style="max-width: 250px; margin: 0 auto;" onchange="previewFoto()">
                                        @error('foto')
                                            <div class="invalid-feedback alert-danger d-block">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form action="{{ route('customer.updateakun', $edit->user->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @method('put')
                                @csrf
                                {{-- Pop Up Modal for Success/Error --}}
                                @if (session()->has('success') || session()->has('msgError'))
                                    <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header {{ session()->has('success') ? 'bg-success' : 'bg-danger' }}">
                                                    <h5 class="modal-title text-white" id="popupModalLabel">
                                                        {{ session()->has('success') ? 'Berhasil' : 'Gagal' }}
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity:1;">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <strong>
                                                        {{ session('success') ?? session('msgError') }}
                                                    </strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn {{ session()->has('success') ? 'btn-success' : 'btn-danger' }}" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            $('#popupModal').modal('show');
                                        });
                                    </script>
                                @endif
                                <div class="form-group mb-3">
                                    <label class="form-label" for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama', $edit->user->nama) }}"
                                        class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                                    @error('nama')
                                        <span class="invalid-feedback alert-danger d-block" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $edit->user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                                    @error('email')
                                        <span class="invalid-feedback alert-danger d-block" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="hp">No. HP</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)" name="hp" id="hp"
                                        value="{{ old('hp', $edit->user->hp) }}"
                                        class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP">
                                    @error('hp')
                                        <span class="invalid-feedback alert-danger d-block" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan Alamat Lengkap">{{ old('alamat', $edit->alamat) }}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback alert-danger d-block" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label" for="pos">Kode Pos</label>
                                    <input type="text" name="pos" id="pos" value="{{ old('pos', $edit->pos) }}"
                                        class="form-control @error('pos') is-invalid @enderror"
                                        placeholder="Masukkan Kode Pos">
                                    @error('pos')
                                        <span class="invalid-feedback alert-danger d-block" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="primary-btn">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFoto() {
            const input = document.getElementById('foto');
            const preview = document.getElementById('fotoPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Hanya angka untuk input HP
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
@endsection
