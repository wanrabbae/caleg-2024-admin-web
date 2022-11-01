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
                        <th>Nama Dapil</th>
                        <th>Provinsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->dapil->nama_dapil }}</td>
                                <td>{{ $data->provinsi->nama_provinsi }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3 getData" value={{ $data->id_detail }} data-target="#editModal" data-toggle="modal">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                    <form action="{{ asset('dapil-detail/' . $data->id_detail) }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Daerah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset('dapil-detail') }}" method="POST">
        <div class="modal-body">
                @csrf
              <div class="form-group">
                <label for="dapil">Pilih Dapil</label>
                <select class="form-control" name="id_dapil" id="dapil">
                  @foreach ($dapil as $item)
                  <option value="{{ $item->id_dapil }}">{{ $item->nama_dapil }}</option>
                  @endforeach
                </select>
            </div>
              <div class="form-group">
                <label for="provinsi">Pilih Provinsi</label>
                <select class="form-control" name="id_provinsi" id="provinsi">
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
          <h5 class="modal-title" id="editModalLabel">Edit Daerah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="edit_form" method="POST">
            <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="provinsi">Pilih Provinsi</label>
                  <select class="form-control" name="id_provinsi" id="edit_provinsi">
                    @foreach ($provinsi as $item)
                    <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kabupaten">Pilih Kabupaten</label>
                  <select class="form-control" name="id_kabupaten" id="edit_kabupaten">
                    <option value="">Pilih Provinsi Dahulu</option>
                  </select>
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
        url: `{{ asset('dapil-detail') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('detail-dapil/${resp.id_detail}') }}`);
            $("#edit_kabupaten").val(resp.nama_kabupaten);
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