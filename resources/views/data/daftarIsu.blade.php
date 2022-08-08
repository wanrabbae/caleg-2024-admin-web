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
                        <th>Nama Kecamatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kecamatan }}</td>
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
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Create Kecamatan --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Data Daftar Isu</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <form action="{{ asset('infoPolitik/daftarIsu') }}/" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                    <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" id="nama_kecamatan" placeholder="Nama Kecamatan">
                </div>
                <div class="mb-3">
                    <label for="wilayah" class="form-label">Wilayah</label>
                    <input type="text" class="form-control" id="wilayah" name="wilayah" id="wilayah" placeholder="Wilayah">
                </div>
                <div class="mb-3">
                    <label for="kabupaten" class="form-label">Kabupaten</label>
                    <select class=" form-control form-select" name="id_kabupaten" id="id_kabupaten">
                        <option selected>Open this select menu</option>
                        @foreach ($datas as $item)
                        @if (old('id_kabupaten')==$item->id_kabupaten)
                            <option value="{{ $item->id_kabupaten }}" selected>{{ $item->nama_kabupaten }}</option>
                        @else
                            <option value="{{ $item->id_kabupaten }}">{{ $item->nama_kabupaten }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Update Data Daftar Isu</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <form action="" method="POST" id="edit_form">
            <div class="modal-body">
            @method('put')
            @csrf
                <div class="mb-3">
                    <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                    <input type="text" class="form-control" name="nama_kecamatan" id="edit_kecamatan" placeholder="Nama Kecamatan">
                </div>
                <div class="mb-3">
                    <label for="wilayah" class="form-label">Wilayah</label>
                    <input type="text" class="form-control" name="wilayah" id="edit_wilayah" placeholder="Wilayah">
                </div>
                <div class="mb-3">
                    <label for="kabupaten" class="form-label">Kabupaten</label>
                    <select class=" form-control form-select" name="id_kabupaten" id="edit_kabupaten">
                        <option selected>Open this select menu</option>
                        @foreach ($datas as $item)
                        @if (old('id_kabupaten')==$item->id_kabupaten)
                            <option value="{{ $item->id_kabupaten }}" selected>{{ $item->nama_kabupaten }}</option>
                        @else
                            <option value="{{ $item->id_kabupaten }}">{{ $item->nama_kabupaten }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
<script src="/js/value.js"></script>
@endsection
