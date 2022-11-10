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
          <div class="d-flex justify-content-between flex-column flex-md-row">
            <div>
              <form action="" method="GET" class="d-block mb-2">
              @if (request()->has("search"))
              <input type="hidden" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
              @endif
              <span class="d-block">Data Per Page</span>
                <input type="number" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                <datalist id="paginates">
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </datalist>
              </form>
            </div>
            <div>
              <form action="" method="GET" class="d-block mb-2" onsubmit="return !/[^\w\d@\s]/gi.test(this['search'].value)">
                @if (request()->has("paginate"))
                <input type="hidden" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                @endif
                <span class="d-block">Search</span>
                <input type="text" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
              </div>
            </form>
          </div>
            {{ $dataArr->links() }}
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Nama Agenda</th>
                        <th>Lokasi</th>
                        <th>Jenis Agenda</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @auth("web")
                                <td>{{ $data->caleg->nama_caleg }}</td>
                                @endauth
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->jam }}</td>
                                <td>{{ $data->nama_agenda }}</td>
                                <td>{{ $data->lokasi }}</td>
                                <td>
<<<<<<< HEAD
                                    <form action="{{ asset('agenda/' . $data->id_agenda) }}" method="post">
=======
                                    <form action="/agenda/{{ $data->id_agenda }}" method="post">
>>>>>>> ca71d608ae3bc759255ca2f8d6a423981dcbc151
                                        @method('put')
                                        @csrf
                                        @if ($data->jenis == "O")
                                            <button type="submit" class="btn btn-warning" name="jenis" value="L">
                                                Online
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-info" name="jenis" value="O">
                                                Lapangan
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td>
<<<<<<< HEAD
                                    <form action="{{ asset('agenda/' . $data->id_agenda) }}" method="post">
=======
                                    <form action="/agenda/{{ $data->id_agenda }}" method="post">
>>>>>>> ca71d608ae3bc759255ca2f8d6a423981dcbc151
                                        @method('put')
                                        @csrf
                                        @if ($data->status == "N")
                                            <button type="submit" value="Y" name="status" class="btn btn-primary">
                                                {{ $data->status }}
                                            </button>
                                        @else
                                        <button type="submit" value="N" name="status" class="btn btn-danger">
                                            {{ $data->status }}
                                        </button>
                                        @endif
                                    </form>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3 getData" value="{{ $data->id_agenda }}" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ asset('agenda/' . $data->id_agenda) }}" method="POST" class="d-inline">
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
        <form action="{{ asset('agenda') }}" method="POST">
        <div class="modal-body">
                @csrf
                @auth("web")
                <div class="form-group">
                  <label for="id_caleg">Pilih Caleg</label>
<<<<<<< HEAD
                   <select class="form-control" name="id_caleg" id="id_caleg">
=======
                   <select class="form-control form-select" name="id_caleg" id="id_caleg">
>>>>>>> ca71d608ae3bc759255ca2f8d6a423981dcbc151
                      @foreach ($caleg as $item)
                        <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                      @endforeach
                   </select>
                </div>
                @endauth
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
                    <label for="jenis">Jenis Agenda</label>
                     <select class="form-control form-select" name="jenis" id="jenis">
                        <option value="L">Lapangan</option>
                        <option value="O">Online</option>
                     </select>
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
                @auth("web")
                <div class="form-group">
                  <label for="id_caleg">Pilih Caleg</label>
<<<<<<< HEAD
                   <select class="form-control" name="id_caleg" id="edit_id_caleg">
=======
                   <select class="form-control" name="id_caleg" id="id_caleg">
>>>>>>> ca71d608ae3bc759255ca2f8d6a423981dcbc151
                      @foreach ($caleg as $item)
                        <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                      @endforeach
                   </select>
                </div>
                @endauth
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
@endsection
@section("script")
  <script>
  $(document).ready(function() {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

  let getData = e => {
    $.ajax({
        url: `{{ asset('agenda') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('agenda/${resp.id_agenda}') }}`)
            $("#edit_nama_agenda").val(resp.nama_agenda)
            @auth("web")
            $("#edit_id_caleg").val(resp.id_caleg)
            @endauth
            $("#edit_tanggal").val(resp.tanggal)
            $("#edit_jam").val(resp.jam)
            $("#edit_lokasi").val(resp.lokasi)
        } 
      })
  }

  $(".getData").on("click", getData);
  $(document).on("click", function() {
      $(".getData").off().on("click", getData);
  })
  })
</script>
@endsection