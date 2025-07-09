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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-tag-multiple text-info" style="font-size: 2rem;"></i>
                                <h4 class="card-title mb-0 ml-3">{{ $judul }}</h4>
                            </div>
                            <a href="{{ route('backend.kategori.create') }}" class="btn btn-info"
                                style="border-radius: 8px;">
                                <i class="fas fa-plus mr-2"></i>Tambah Kategori
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 75%">Nama Kategori</th>
                                        <th class="text-center" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($index as $row)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama_kategori }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('backend.kategori.edit', $row->id) }}"
                                                        class="btn btn-info btn-sm" title="Ubah Data"
                                                        style="border-radius: 6px; margin-right: 5px;">
                                                        <i class="far fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('backend.kategori.destroy', $row->id) }}"
                                                        style="display: inline-block;">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                            data-konf-delete="{{ $row->nama_kategori }}" title="Hapus Data"
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
