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
                        <th>Nama Variable</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_variabel }}</td>
                                <td class="d-flex justify-content-center">
                                   <button type="button" class="btn btn-warning mx-3" onclick="getVariable({{ $item->id_variabel }})" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                       <i class="fas fa-edit"></i>
                                   </button>
                                   <form action="/survey/HasilSurvey/{{ $item->id_variabel }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Variabel {{ $item->nama_variabel }}')">
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

{{-- Modal Create Variable --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Data Hasil Survey</h5>
          <span aria-hidden="true">&times;</span>
        </div>
            <form action="{{ asset('survey/HasilSurvey') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_variabel" class="form-label">Nama Variable</label>
                        <input type="text" class="form-control" id="nama_variabel" name="nama_variabel" id="nama_variabel" placeholder="Nama Variabel">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- Modal Update Hasil Survey --}}
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Update Data Hasil Survey</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <form action="" method="POST" id="update_variabel">
            <div class="modal-body">
            @method('put')
            @csrf
                <div class="mb-3">
                    <label for="nama_variabel" class="form-label">Nama Variable</label>
                    <input type="text" class="form-control" name="nama_variabel" id="edit_variabel" placeholder="Nama Variable">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<script src="/js/value.js"></script>
@endsection
