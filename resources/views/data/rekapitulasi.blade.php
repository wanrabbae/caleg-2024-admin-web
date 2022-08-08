@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="fas fa-plus"></i>Create</a>
    </div>
    <a href=""></a>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Desa</th>
                        <th>Type</th>
                        <th>DPT</th>
                        <th>Jumlah TPS</th>
                        <th>Suara</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_desa }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->dpt }}</td>
                                <td>{{ $item->tps }}</td>
                                <td>{{ $item->suara }}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-warning mx-3" onclick="getValue({{ $item->id_desa }})" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/infoPolitik/rekapitulasi/{{ $item->id_desa }}" method="post" class="d-inline">
                                     @method('delete')
                                     @csrf
                                     <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus desa {{ $item->nama_desa }}')">
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

{{-- Modal Rekapitulasi --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Data Rekapitulasi</h5>
        </div>
        <div class="modal-body">
            <form action="{{ asset('infoPolitik/rekapitulasi') }}/" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name_desa" class="form-label">Nama Desa</label>
                    <input type="text" class="form-control" id="name_desa" name="nama_desa" value="{{ old('nama_desa') }}">
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control " id="type" name="type" value="{{ old('type') }}">
                </div>
                <div class="mb-3">
                    <label for="dpt" class="form-label">DPT</label>
                    <input type="number" class="form-control" id="dpt" name="dpt" value="{{ old('dpt') }}">
                </div>
                <div class="mb-3">
                    <label for="tps" class="form-label">TPS</label>
                    <input type="number" class="form-control " id="tps" name="tps" value="{{ old('tps') }}">
                </div>
                <div class="mb-3">
                    <label for="suara" class="form-label">Suara</label>
                    <input type="number" class="form-control " id="suara" name="suara" value="{{ old('suara') }}">
                </div>
                <div class="mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <select class="form-select form-control" name="id_kecamatan" id="id_kecamatan">
                        <option selected>Open this select menu</option>
                        @foreach ($kecamatan as $item)
                            @if (old('id_kecamatan')== $item->id_kecamatan)
                                <option value="{{ $item->id_kecamatan }}" selected>{{ $item->nama_kecamatan }}</option>
                            @else
                                <option value="{{ $item->id_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data Rekapitulasi</h5>
        </div>
        <div class="modal-body">
            <form action="" method="post" id="update_rekapitulasi">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name_desa" class="form-label">Nama Desa</label>
                    <input type="text" class="form-control" id="update_desa" name="nama_desa" value="{{ old('nama_desa') }}">
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control " id="update_type" name="type" value="{{ old('type') }}">
                </div>
                <div class="mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <select class="form-select form-control" name="id_kecamatan" id="update_kecamatan">
                        <option selected>Open this select menu</option>
                        @foreach ($kecamatan as $item)
                            @if (old('id_kecamatan')== $item->id_kecamatan)
                                <option value="{{ $item->id_kecamatan }}" selected>{{ $item->nama_kecamatan }}</option>
                            @else
                                <option value="{{ $item->id_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dpt" class="form-label">DPT</label>
                    <input type="number" class="form-control" id="update_dpt" name="dpt" value="{{ old('dpt') }}">
                </div>
                <div class="mb-3">
                    <label for="tps" class="form-label">TPS</label>
                    <input type="number" class="form-control " id="update_tps" name="tps" value="{{ old('tps') }}">
                </div>
                <div class="mb-3">
                    <label for="suara" class="form-label">Suara</label>
                    <input type="number" class="form-control " id="update_suara" name="suara" value="{{ old('suara') }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
<script src="/js/value.js"></script>
@endsection
