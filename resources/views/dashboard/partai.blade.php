@extends("layouts.admin")

@section("content")
@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                    </ul>
                </div>
                @endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i>
            Partai
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Partai</th>
                        <th>No Urut</th>
                        <th>Warna</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $data->id_partai }}</td>
                                <td>{{ $data->nama_partai }}</td>
                                <td>{{ $data->no_urut }}</td>
                                <td>{{ $data->warna }}</td>
                                <td>
                                    @if (Storage::exists("/img/" . $data->logo))
                                    <img src="{{ asset('/img/' . $data->logo) }}" alt="">
                                    @else
                                    <i class="fas fa-image"></i>
                                    <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary" onclick="getData({{ $data->id_legislatif }})" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/dashboard/partai/{{ $data->id_partai }}" method="POST">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Partai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/dashboard/partai/" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
                <div class="form-group">
                  <label for="nama_partai">Nama Partai</label>
                  <input type="text" class="form-control" id="nama_partai" placeholder="Nama Partai" name="nama_partai">
                </div>
                <div class="form-group">
                  <label for="warna">Warna</label>
                  <input type="color" class="form-control" id="warna" name="warna">
                </div>
                <div class="form-group">
                  <label for="no_urut">No Urut</label>
                  <input type="number" class="form-control" id="no_urut" placeholder="No Urut" name="no_urut">
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
              </form>
        </div>
      </div>
    </div>
  </div>

<<<<<<< HEAD
  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Partai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="edit_form">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="nama_partai">Nama Partai</label>
                  <input type="text" class="form-control" id="edit_partai" placeholder="Nama partai" name="nama_partai">
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <a href="">
              <button type="submit" class="btn btn-primary">Edit</button>
            </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function getData(data) {
        fetch(`/dashboard/partai/${data}`).then(resp => resp.json()).then(resp => {
            document.getElementById("edit_form").action = `/dashboard/partai/${data}`
            document.getElementById("edit_partai").value = resp.nama_legislatif
    })
    }
  </script>
@endsection