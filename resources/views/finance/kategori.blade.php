@extends('layouts.admin')

@section("content")

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i>
            Kategori
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
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Jenis Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $data->kode_kategori }}</td>
                          <td>{{ $data->nama_kategori }}</td>
                          <td>{{ $data->jenis_transaksi }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-warning mx-3 getData" value="{{ $data->id_kategori }}" data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ asset("kategori/" . $data->id_kategori) }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset("kategori") }}" method="POST">
        <div class="modal-body">
                 @csrf
                <div class="form-group">
                  <label for="kode_kategori">Kode Kategori</label>
                  <input type="number" class="form-control" id="kode_kategori" placeholder="Kode Kategori" name="kode_kategori">
                </div>
                <div class="form-group">
                  <label for="nama_kategori">Nama Kategori</label>
                  <input type="text" class="form-control" id="nama_kategori" placeholder="Nama Kategori" name="nama_kategori">
                </div>
                <div class="form-group">
                  <label for="jenis_transaksi">Jenis Transaksi</label>
                  <select class="form-control" name="jenis_transaksi" id="jenis_transaksi">
                    <option value="Pemasukan">Pemasukan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
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
          <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
            @method('put')
            @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="kode_kategori">Kode Kategori</label>
                <input type="number" class="form-control" id="edit_kode_kategori" placeholder="Kode Kategori" name="kode_kategori">
              </div>
              <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" class="form-control" id="edit_nama_kategori" placeholder="Nama Kategori" name="nama_kategori">
              </div>
              <div class="form-group">
                <label for="jenis_transaksi">Jenis Transaksi</label>
                <select class="form-control" name="jenis_transaksi" id="edit_jenis_transaksi">
                  <option value="Pemasukan">Pemasukan</option>
                  <option value="Pengeluaran">Pengeluaran</option>
              </select>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Update</button>
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
        url: `{{ asset('kategori') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('kategori/${resp.id_kategori}') }}`)
            $("#edit_kode_kategori").val(resp.kode_kategori);
            $("#edit_nama_kategori").val(resp.nama_kategori);
            $("#edit_jenis_transaksi").val(resp.jenis_transaksi);
        } 
      })
  }

  $(".getData").on("click", getData);
  })
  </script>
@endsection