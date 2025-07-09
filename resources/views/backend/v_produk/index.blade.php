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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-package-variant text-info" style="font-size: 2rem;"></i>
                                <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                            </div>
                            <a href="{{ route('backend.produk.create') }}" class="btn btn-info" style="border-radius: 8px;">
                                <i class="fas fa-plus mr-2"></i>Tambah Produk
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 15%">Kategori</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 25%">Nama Produk</th>
                                        <th style="width: 15%">Harga</th>
                                        <th style="width: 10%">Stok</th>
                                        <th class="text-center" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($index as $row)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $row->kategori->nama_kategori }}</td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <span class="badge badge-success px-3 py-2" style="border-radius: 8px;">
                                                        Publis
                                                    </span>
                                                @elseif($row->status == 0)
                                                    <span class="badge badge-secondary px-3 py-2"
                                                        style="border-radius: 8px;">
                                                        Blok
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $row->nama_produk }}</td>
                                            <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $row->stok }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('backend.produk.edit', $row->id) }}"
                                                        class="btn btn-info btn-sm" title="Ubah Data"
                                                        style="border-radius: 6px; margin-right: 10px;">
                                                        <i class="far fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('backend.produk.show', $row->id) }}"
                                                        class="btn btn-warning btn-sm" title="Kelola Gambar"
                                                        style="border-radius: 6px; margin-right: 5px;">
                                                        <i class="fas fa-images"></i>
                                                        +Gambar
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('backend.produk.destroy', $row->id) }}"
                                                        style="display: inline-block;">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                            data-konf-delete="{{ $row->nama_produk }}" title="Hapus Data"
                                                            style="border-radius: 6px; margin-left: 5px;">
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
</body>

</html>
