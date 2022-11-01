@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Daerah Pemilihan
            </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dapil Legislatif</th>
                        <th>Nama Dapil</th>
                        {{-- <th>Detail</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->legislatif->nama_legislatif }}</td>
                                <td>{{ $data->nama_dapil }}</td>
                                {{-- <td>
                                  <form action="{{ asset("dapil/detail") }}" method="POST" target="_blank">
                                    @csrf
                                    <input type="hidden" value="{{ $data->id_dapil }}" name="id_dapil">
                                    <button type="submit" class="btn btn-primary">
                                      Detail
                                    </button>
                                  </form>
                                </td> --}}
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3 getData" value={{ $data->id_dapil }} data-target="#editModal" data-toggle="modal">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                    <form action="{{ asset('dapil/' . $data->id_dapil) }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Dapil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset('dapil') }}" method="POST">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="id_legislatif">Pilih Legislatif</label>
                  <select class="form-control" name="id_legislatif" id="id_legislatif">
                      @foreach ($legislatif as $item)
                      <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="nama_dapil">Nama Dapil</label>
                <input type="text" class="form-control" id="nama_dapil" placeholder="Nama Dapil" name="nama_dapil">
              </div>
              {{-- <div class="form-group">
                <label for="provinsi">Pilih Provinsi</label>
                <select class="form-control" name="id_provinsi" id="provinsi">
                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinsi as $item)
                    <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                    @endforeach
                </select>
            </div>
              <div class="form-group">
                <label for="kabupaten">Pilih Kabupaten</label>
                <select class="form-control" name="id_kabupaten" id="kabupaten">
                    <option value="">Pilih Provinsi Dahulu</option>
                </select>
            </div> --}}
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
          <h5 class="modal-title" id="editModalLabel">Edit Dapil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="edit_form" method="POST">
            <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="id_legislatif">Pilih Legislatif</label>
                  <select class="form-control" name="id_legislatif" id="edit_id_legislatif">
                      @foreach ($legislatif as $item)
                      <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                      @endforeach
                  </select>
              </div>
                <div class="form-group">
                    <label for="dapil">Nama Dapil</label>
                    <input type="text" class="form-control" id="edit_nama_dapil" placeholder="Nama Dapil" name="nama_dapil">
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
        url: `{{ asset('dapil') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('dapil/${resp.id_dapil}') }}`);
            $("#edit_id_legislatif").val(resp.id_legislatif);
            $("#edit_nama_dapil").val(resp.nama_dapil);
        } 
      })
  }

  $(".getData").on("click", getData);
  $(document).on("click", function() {
      $(".getData").on("click", getData);
  })
  })
</script>
@endsection