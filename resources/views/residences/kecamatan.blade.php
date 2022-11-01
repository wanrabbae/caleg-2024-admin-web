@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Kecamatan
            </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
          <div class="d-flex justify-content-between">
            <div>
              <form action="" method="GET" class="d-block mb-2">
              @if (request()->has("search"))
              <input type="hidden" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@]+">
              @endif
              <span>Data Per Page</span>
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
              <form action="" method="GET" class="d-block mb-2" onsubmit="return !/[^\w\d@]/gi.test(this['search'].value)">
                @if (request()->has("paginate"))
                <input type="hidden" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                @endif
                <span>Search</span>
                <input type="text" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@]+">
              </div>
            </form>
          </div>
            {{ $dataArr->links() }}
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kecamatan</th>
                        <th>Nama Kabupaten</th>
                        <th>Dapil Kabupaten</th>
                        <th>Wilayah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_kecamatan }}</td>
                                <td>{{ $data->kabupaten->nama_kabupaten }}</td>
                                <td>{{ $data->dapil == 0 ? "Tidak Ada" : $data->dapil }}</td>
                                <td><a href="{{ $data->wilayah }}" target="_blank" class="btn btn-primary">Lokasi</a></td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3 getData" value={{ $data->id_kecamatan }} data-target="#editModal" data-toggle="modal">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                    <form action="{{ asset('kecamatan/' . $data->id_kecamatan) }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Kecamatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset('kecamatan') }}" method="POST">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="provinsi">Pilih Provinsi</label>
                  <select class="form-control" name="id_provinsi" id="provinsi">
                      <option value="">Pilih Provinsi</option>
                      @foreach ($provinsi as $item)
                      <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select class="form-control" name="id_kabupaten" id="kabupaten">
                  <option value="">Pilih Provinsi Dahulu</option>
                </select>
              </div>
              <div class="form-group">
                <label for="dapil">Pilih Dapil</label>
                <select class="form-control" name="dapil" id="dapil">
                  <option value="">Pilih Kabupaten Dahulu</option>
                </select>
              </div>
              <div class="form-group">
                <label for="kecamatan">Nama Kecamatan</label>
                <input type="text" class="form-control" id="kecamatan" placeholder="Nama Kecamatan" name="nama_kecamatan">
              </div>
                <div class="form-group">
                  <label for="wilayah">Link Wilayah</label>
                  <input type="text" class="form-control" id="wilayah" placeholder="Link Wilayah" name="wilayah">
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
          <h5 class="modal-title" id="editModalLabel">Edit Kecamatan</h5>
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
                      <option value="">Pilih Provinsi</option>
                      @foreach ($provinsi as $item)
                      <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="edit_kabupaten">Kabupaten</label>
                <select class="form-control" name="id_kabupaten" id="edit_kabupaten">
                  <option value="">Pilih Provinsi Dahulu</option>
                </select>
              </div>
              <div class="form-group">
                  <label for="edit_kecamatan">Nama Kecamatan</label>
                  <input type="text" class="form-control" id="edit_nama_kecamatan" placeholder="Nama Kecamatan" name="nama_kecamatan">
                </div>
                  <div class="form-group">
                    <label for="dapil">Pilih Dapil</label>
                    <select class="form-control" name="dapil" id="edit_dapil">
                        <option value="">Pilih Kabupaten Dahulu</option>
                    </select>
                </div>
                  <div class="form-group">
                  <label for="wilayah">Link Wilayah</label>
                  <input type="text" class="form-control" id="edit_wilayah" placeholder="Link Wilayah" name="wilayah">
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
        url: `{{ asset('kecamatan') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('kecamatan/${resp.id_kecamatan}') }}`);
            $("#edit_nama_kecamatan").val(resp.nama_kecamatan);
            $("#edit_wilayah").val(resp.wilayah);
        } 
      })
  }

  let getKab = e => {
    $.ajax({
        url: `{{ asset('desa') }}`,
        method: "POST",
        data: {
          getProvinsi: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
          if (!e.currentTarget.id.includes("edit")) {
            $("#kabupaten").empty().html(resp)
          } else {
            $("#edit_kabupaten").empty().html(resp)
          }
        },
      })
  }

  let getDapil = e => {
    $.ajax({
        url: `{{ asset('kecamatan') }}`,
        method: "POST",
        data: {
          getDapil: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
          if (!e.currentTarget.id.includes("edit")) {
            $("#dapil").html(resp ? resp : "<option value=''>Tidak Ada Dapil</option>");
          } else {
            $("#edit_dapil").html(resp ? resp : "<option value=''>Tidak Ada Dapil</option>");
          }
        } 
      })
  }

  $(".getData").on("click", getData);
  $("#provinsi").on("change", getKab);
  $("#edit_provinsi").on("change", getKab);
  $("#kabupaten").on("change", getDapil);
  $("#edit_kabupaten").on("change", getDapil);
  })
</script>
@endsection