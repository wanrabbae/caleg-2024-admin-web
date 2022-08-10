@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
  <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Agenda
            </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Agenda</th>
                        <th>Lokasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $data->id_agenda }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->jam }}</td>
                                <td>{{ $data->nama_agenda }}</td>
                                <td>{{ $data->lokasi }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3" onclick="getData({{ $data->id_agenda }})" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/agenda/{{ $data->id_agenda }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Agenda</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/agenda/" method="POST">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="nama_agenda">Nama Agenda</label>
                  <input type="text" class="form-control" id="nama_agenda" placeholder="Nama Agenda" name="nama_agenda">
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" placeholder="tanggal" name="tanggal">
                </div>
                <div class="form-group">
                  <label for="jam">Jam Pelaksanaan</label>
                  <input type="time" class="form-control" id="jam" placeholder="Jam Pelaksanaan" name="jam">
                </div>
                <div class="form-group">
                  <label for="lokasi">Lokasi Pelaksanaan</label>
                  <input type="text" class="form-control" id="lokasi" placeholder="lokasi" name="lokasi">
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

  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Agenda</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
        <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="nama_agenda">Nama Agenda</label>
                    <input type="text" class="form-control" id="edit_nama_agenda" placeholder="Nama Agenda" name="nama_agenda">
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="edit_tanggal" placeholder="tanggal" name="tanggal">
                  </div>
                  <div class="form-group">
                    <label for="jam">Jam Pelaksanaan</label>
                    <input type="time" class="form-control" id="edit_jam" placeholder="Jam Pelaksanaan" name="jam">
                  </div>
                  <div class="form-group">
                    <label for="lokasi">Lokasi Pelaksanaan</label>
                    <input type="text" class="form-control" id="edit_lokasi" placeholder="lokasi" name="lokasi">
                  </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Edit</button>
                </a>
              </div>
            </form>
      </div>
    </div>
  </div>

  <script>
    function getData(data) {
        fetch(`/agenda/${data}`).then(resp => resp.json()).then(resp => {
            document.getElementById("edit_form").action = `/agenda/${data}`
            for (let x in resp) {
                document.getElementById(`edit_${x}`).value = resp[x]
            }
    })
    }
  </script>
@endsection
