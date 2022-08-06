@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="col-md-3">
    </div>
    <div class="card-header py-3">
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="fas fa-plus"></i>Create</button>
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
                                    <button type="button" class="btn btn-warning mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    {{-- <form action="/deleteDaftarisu/{{ $item->id_kecamatan }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form> --}}
                                    <a href="{{ asset('deleteDaftarIsu') }}/{{ $item->id_kecamatan }}" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
          <h5 class="modal-title" id="exampleModalLabel">Create Data Daftar Isu</h5>
        </div>
        <div class="modal-body">
            <form action="{{ asset('postDaftarisu') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                    <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" id="nama_kecamatan" name="nama_kecamatan" value="{{ old('nama_kecamatan') }}">
                    @error('nama_kecamatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="wilayah" class="form-label">Wilayah</label>
                    <input type="text" class="form-control @error('wilayah') is-invalid @enderror" id="wilayah" name="wilayah" value="{{ old('wilayah') }}">
                    @error('wilayah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kabupaten" id="kabupaten" class="form-label">Kabupaten</label>
                    <select class=" form-control form-select @error('id_kabupaten') is-invalid @enderror" name="id_kabupaten">
                        <option selected>Open this select menu</option>
                        @foreach ($datas as $item)
                            @if (old('id_kabupaten') == $item->id_kabupaten)
                                <option value="{{ $item->id_kabupaten }}" selected>{{ $item->nama_kabupaten }}</option>
                            @else
                                <option value="{{ $item->id_kabupaten }}">{{ $item->nama_kabupaten }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_kabupaten')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- Modal Edit Berita --}}
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data Daftar Isu</h5>
        </div>
        <div class="modal-body">
            @if ($data->count())

            @endif
            <form action="{{ asset('update') }}" method="post">
                @csrf
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
