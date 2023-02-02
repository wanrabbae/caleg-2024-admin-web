@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="col-md-3">
        </div>
        <div class="card-header py-3">
            {{-- <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Create
            </button> --}}
            <a href="{{ asset("dpt/export") }}" class="btn btn-primary">
            <i class="fas fa-download"></i>
                Export
            </a>
            <form action="{{ asset("dpt/import") }}" method="POST" class="d-inline" enctype="multipart/form-data">
            @csrf
                <input type="file" id="dpt" name="dpt" style="opacity: 0; display: none;">
                <label for="dpt" class="btn-primary btn mt-2">
                    <i class="fas fa-file-import"></i>
                        Import
                    </label>
            </form>
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
                    {{ $datas->links() }}
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Pemilih</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>JK</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($datas->count())
                            @foreach ($datas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ $item->tgl_lahir }}</td>
                                    <td>{{ $item->jk }}</td>
                                    <td>{{ $item->desa->nama_desa }}</td>
                                    <td>{{ $item->desa->kecamatan->nama_kecamatan }}</td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-warning mx-3 getData" value="{{ $item->id_pemilih }}" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="/dpt/{{ $item->id_pemilih }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus DPT Pemilih {{ $item->nama }}')">
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

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Update Data DPT</h5>
                    <span aria-hidden="true">&times;</span>
                </div>
                <form action="" method="POST" id="edit_form">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="edit_nik" name="nik" placeholder=" Masukan NIK">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Pemilih</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" placeholder="Masukan Nama Pemilih">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="edit_tempat_lahir" name="tempat_lahir" placeholder="Masukan Tempat Lahir">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="edit_tgl_lahir" name="tgl_lahir" placeholder="Masukan Tanggal Lahir">
                        </div>
                        <div class="form-group">
                            <label for="tgl_data" class="form-label">Tanggal Data Ditambahkan</label>
                            <input type="datetime-local" class="form-control" id="edit_tgl_data" name="tgl_data" placeholder="Masukan Tanggal Lahir">
                        </div>
                        <div class="form-group">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select name="jk" id="edit_jk" class="form-control form-select">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="desa" class="form-label">Desa</label>
                            <select class=" form-control form-select" name="id_desa" id="edit_id_desa">
                                @foreach ($desas as $item)
                                    @if (old('id_desa') == $item->id_desa)
                                        <option value="{{ $item->id_desa }}" selected>{{ $item->nama_desa }}</option>
                                    @else
                                        <option value="{{ $item->id_desa }}">{{ $item->nama_desa }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
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
          url: `{{ asset('dpt') }}`,
          method: "POST",
          data: {
            getData: true,
            data: e.currentTarget.value
          },
          dataType: "json",
          success: resp => {
              $("#edit_form").attr("action", `{{ asset('dpt/${resp.id_pemilih}') }}`);
              $("#edit_nik").val(resp.nik)
              $("#edit_nama").val(resp.nama)
              $("#edit_tempat_lahir").val(resp.tempat_lahir)
              $("#edit_tgl_lahir").val(resp.tgl_lahir)
              $("#edit_jk").val(resp.jk)
              $("#edit_id_desa").val(resp.id_desa)
              $("#edit_tgl_data").val(resp.tgl_data)
          } 
        })
    }
  
    $(".getData").on("click", getData);

    $("#dpt").on("change", e => {
        e.target.form.submit();
    })
    })
  </script>
@endsection