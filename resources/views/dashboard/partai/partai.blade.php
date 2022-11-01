@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Partai
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
                            <th>Nama Partai</th>
                            <th>Nama Pendek</th>
                            <th>No Urut</th>
                            <th>Warna</th>
                            <th>Warna Kedua</th>
                            <th>Warna Teks</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dataArr->count())
                            @foreach ($dataArr as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_partai }}</td>
                                    <td>{{ $data->nama_pendek }}</td>
                                    <td>{{ $data->no_urut }}</td>
                                    <td style="background: {{ $data->warna }}">
                                    <td style="background: {{ $data->secondary_color }}"></td>
                                    <td style="background: {{ $data->text_color }}"></td>
                                    </td>
                                    <td>
                                        @if (File::exists($data->logo))
                                            <img src="{{ asset($data->logo) }}" alt="" class="mx-auto d-block" style="width: 75px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-warning mx-3 getData" value={{ $data->id_partai }} data-target="#editModal" data-toggle="modal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ asset('dashboard/partai/' . $data->id_partai) }}" method="POST" class="d-inline">
                                            @method('delete')
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
                <form action="{{ asset('dashboard/partai') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="nama_partai">Nama Partai</label>
                            <input type="text" class="form-control" id="nama_partai" placeholder="Nama Partai" name="nama_partai">
                        </div>
                        <div class="form-group">
                            <label for="nama_pendek">Nama Pendek</label>
                            <input type="text" class="form-control" id="nama_pendek" placeholder="Nama Pendek" name="nama_pendek">
                        </div>
                        <div class="form-group">
                            <label for="warna">Warna</label>
                            <input type="color" class="form-control" id="warna" name="warna">
                        </div>
                        <div class="form-group">
                            <label for="secondary_color">Warna Kedua</label>
                            <input type="color" class="form-control" id="secondary_color" name="secondary_color">
                        </div>
                        <div class="form-group">
                            <label for="text_color">Warna Teks</label>
                            <input type="color" class="form-control" id="text_color" name="text_color">
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
          <h5 class="modal-title" id="editModalLabel">Edit Partai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="edit_form" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="nama_partai">Nama Partai</label>
                    <input type="text" class="form-control edit" id="edit_nama_partai" placeholder="Nama Partai" name="nama_partai">
                </div>
                <div class="form-group">
                    <label for="nama_pendek">Nama Pendek</label>
                    <input type="text" class="form-control edit" id="edit_nama_pendek" placeholder="Nama Pendek" name="nama_pendek">
                </div>
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="color" class="form-control edit" id="edit_warna" name="warna">
                </div>
                <div class="form-group">
                    <label for="secondary_color">Warna Kedua</label>
                    <input type="color" class="form-control" id="edit_secondary_color" name="secondary_color">
                </div>
                <div class="form-group">
                    <label for="text_color">Warna Teks</label>
                    <input type="color" class="form-control" id="edit_text_color" name="text_color">
                </div>
                <div class="form-group">
                    <label for="no_urut">No Urut</label>
                    <input type="number" class="form-control edit" id="edit_no_urut" placeholder="No Urut" name="no_urut">
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control-file" id="logo" name="logo" value="">
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
        url: `{{ asset('dashboard/partai') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('dashboard/partai/${resp.id_partai}') }}`);
            $("#edit_nama_partai").val(resp.nama_partai);
            $("#edit_nama_pendek").val(resp.nama_pendek);
            $("#edit_warna").val(resp.warna);
            $("#edit_secondary_color").val(resp.secondary_color);
            $("#edit_text_color").val(resp.text_color);
            $("#edit_no_urut").val(resp.no_urut);
        } 
      })
  }

  $(".getData").on("click", getData);
  })
</script>
@endsection