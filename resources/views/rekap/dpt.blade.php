@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="col-md-3">
        </div>
        <div class="card-header py-3">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Create
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Pemilih</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>JK</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>TPS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @if ($data->count())
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ $item->tgl_lahir }}</td>
                                    <td>{{ $item->jk == '1' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $item->desa->nama_desa }}</td>
                                    <td>{{ $item->desa->nama_desa }}</td>
                                    <td>{{ $item->tps }}</td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-warning mx-3" onclick="getData({{ $item->id_kecamatan }})" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="/infoPolitik/daftarIsu/{{ $item->id_kecamatan }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus kecamatan {{ $item->nama_kecamatan }}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
