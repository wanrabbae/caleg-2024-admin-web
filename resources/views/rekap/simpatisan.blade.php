@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Program
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
                    {{ $program->links() }}
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            @auth("web")
                            <th>Caleg</th>
                            @endauth
                            <th>Judul Program</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($program->count())
                            @foreach ($program as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @auth("web")
                                    <td>{{ $data->caleg->nama_caleg }}</td>
                                    @endauth
                                    <td>{{ $data->judul_program }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>
                                        @if (Storage::disk("public_path")->exists($data->foto))
                                            <img src="{{ asset('public/'.$data->foto) }}" alt="" style="width: 75px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-warning mx-3 getData" value="{{ $data->id_program }}" data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ asset("program/" . $data->id_program) }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger">
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ asset('program') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="judul_program">Judul Program</label>
                            <input type="text" class="form-control" id="judul_program" placeholder="Nama Program" name="judul_program">
                        </div>
                        @auth("web")
                        <div class="form-group">
                        <label for="id_caleg">Pilih Caleg</label>
                            <select class="form-control" name="id_caleg" id="id_caleg">
                            @foreach ($caleg as $item)
                                <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                            @endforeach
                        </select>
                        </div>
                        @endauth
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Program</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="5" style="resize: none"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Program</label>
                            <input type="file" class="form-control" id="foto1" name="foto">
                            <img src="" alt="" class="img d-block mx-auto mt-4" style="width: 150px;">
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
                    <h5 class="modal-title" id="editModalLabel">Edit Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="edit_form" enctype="multipart/form-data">
                    @method('put')
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="edit_judul_program">Judul Program</label>
                            <input type="text" class="form-control" id="edit_judul_program" placeholder="Nama Program" name="judul_program">
                        </div>
                        @auth("web")
                        <div class="form-group">
                        <label for="id_caleg">Pilih Caleg</label>
                            <select class="form-control" name="id_caleg" id="edit_id_caleg">
                            @foreach ($caleg as $item)
                                <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                            @endforeach
                        </select>
                        </div>
                        @endauth
                        <div class="form-group">
                            <label for="edt_deskripsi">Deskripsi Program</label>
                            <textarea name="deskripsi" id="edit_deskripsi" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Program</label>
                            <input type="file" class="form-control" id="foto2" name="foto">
                            <img src="" alt="" class="img d-block mx-auto mt-4" style="width: 150px;">
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
      let imgPreview = e => {
          if (e.currentTarget.files[0].type.includes("image")) {
              let fileReader = new FileReader();
              let images = e.currentTarget.files[0];
              fileReader.addEventListener("load", () => {
                e.currentTarget.nextElementSibling.src = fileReader.result;
            });
                fileReader.readAsDataURL(images);
            }
        }

        $("#foto1").on("change", imgPreview);
        $("#foto2").on("change", imgPreview);

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

  let getData = e => {
    $.ajax({
        url: `{{ asset('program') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{  asset('program/${resp.id_program}')  }}`)
            $("#edit_judul_program").val(resp.judul_program)
            @auth("web")
            $("#edit_id_caleg").val(resp.id_caleg)
            @endauth
            $("#edit_deskripsi").val(resp.deskripsi)
        } 
      })
  }

  $(".getData").on("click", getData);
  })
</script>
@endsection