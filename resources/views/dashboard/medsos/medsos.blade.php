@extends('layouts.admin')

@section("content")

<div class="card shadow mb-4">
    <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Medsos
            </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Medsos</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $data->id_medsos }}</td>
                                <td>{{ $data->nama_medsos }}</td>
                                <td>
                                    @if (Storage::exists($data->logo))
                                    <img src="{{ asset('storage/' . $data->logo) }}" alt="" style="width: 200px">
                                    @else
                                    <i class="fas fa-image"></i>
                                    <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-warning mx-3" href="/dashboard/medsos/{{ $data->id_medsos }}/edit">
                                        <i class="fas fa-edit"></i>
                                </a>
                                    <form action="/dashboard/medsos/{{ $data->id_medsos }}" method="POST" class="d-inline">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
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

{{-- Modal Create --}}
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Tambah Medsos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/dashboard/medsos/" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="medsos">Nama Medsos</label>
                  <input type="text" class="form-control" id="medsos" placeholder="Nama Medsos" name="nama_medsos">
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control-file" id="logo" name="logo">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </a>
              </div>
            </form>
      </div>
    </div>
  </div>
@endsection
