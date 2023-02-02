@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Create
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive"><div class="d-flex justify-content-between flex-column flex-md-row">
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
                {{ $data->links() }}
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>Judul News</th>
                        <th>Isi Berita</th>
                        <th>Tanggal Publish</th>
                        <th>Publish</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @auth("web")
                                <td>{{ $item->caleg->nama_caleg }}</td>
                                @endauth
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->isi_berita }}</td>
                                <td>{{ $item->tgl_publish }}</td>
                                <td>
                                    <form action="{{ asset('infoPolitik/berita/' . $item->id_news) }}" method="POST">
                                        @method('put')
                                        @csrf
                                    @if ($item->aktif == 'N')
                                        <button class="btn btn-primary" type="submit" value="Y" name="publish">
                                            Publish
                                        </button>
                                        @else
                                        <button class="btn btn-danger" type="submit" value="N" name="publish">
                                            Unpublish
                                        </button>
                                    @endif
                                    </form>
                                </td>
                                <td>
                                     @if (Storage::disk("public_path")->exists($item->gambar))
                                        <img src="{{ asset('public/'.$item->gambar) }}" alt="" class="mx-auto d-block" style="width: 75px">
                                    @else
                                        <i class="fas fa-image"></i>
                                        <span>Image Not Found</span>
                                    @endif
                                    </td>
                                <td class="d-flex justify-content-center">
                                   <button type="button" class="btn btn-warning mx-3 getData" value="{{ $item->id_news }}" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                       <i class="fas fa-edit"></i>
                                   </button>
                                   <form action="{{ asset('infoPolitik/berita/' . $item->id_news) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus {{ $item->judul }}')">
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

{{-- Modal Create Berita --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Berita</h5>
            <span aria-hidden="true">&times;</span>
        </div>
        <form action="{{ asset("infoPolitik/berita") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul" class="form-label">Judul Berita</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Berita">
                </div>
                <div class="form-group">
                    <label for="isi_berita" class="form-label">Isi Berita</label>
                    <textarea name="isi_berita" id="isi_berita" rows="5" class="form-control" placeholder="Masukan Isi Berita" style="resize: none;"></textarea>
                </div>
                <div class="form-group">
                    <label for="tgl_publish" class="form-label">Tanggal Publish</label>
                    <input type="date" name="tgl_publish" id="tgl_publish" class="form-control">
                </div>
                @auth("web")
                <div class="form-group">
                    <label for="id_caleg" class="form-label" >Caleg</label>
                    <select class="form-select form-control" name="id_caleg" id="id_caleg">
                        @foreach ($caleg as $item)
                        @if (old('id_caleg')==$item->id_caleg)
                            <option value="{{ $item->id_caleg }}" selected>{{ $item->nama_caleg }}</option>
                        @else
                            <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                        @endif
                        @endforeach
                      </select>
                </div>
                @endauth
                <div class="form-group">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data Berita</h5>
            <span aria-hidden="true">&times;</span>
        </div>
        <form action="" method="post" enctype="multipart/form-data" id="edit_form">
            @method('put')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul_news" class="form-label">Judul News</label>
                    <input type="text" name="judul" id="update_judul" class="form-control" placeholder="Judul news">
                </div>
                <div class="form-group">
                    <label for="isi_berita" class="form-label">Isi Berita</label>
                    <textarea name="isi_berita" id="update_isi_berita" rows="2" class="form-control" placeholder="Masukan Isi Berita"></textarea>
                </div>
                <div class="form-group">
                    <label for="tgl_publish" class="form-label">Tanggal Publish</label>
                    <input type="date" name="tgl_publish" id="update_tgl_publish" class="form-control">
                </div>
                @if (auth("web")->check())
                <div class="form-group">
                    <label for="id_caleg" class="form-label">Caleg</label>
                    <select class="form-select form-control" name="id_caleg" id="update_id_caleg">
                        @foreach ($caleg as $item)
                        @if (old('id_caleg')==$item->id_caleg)
                            <option value="{{ $item->id_caleg }}" selected>{{ $item->nama_caleg }}</option>
                        @else
                            <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                        @endif
                        @endforeach
                      </select>
                </div>
                @endif
                <div class="form-group">
                    <label for="gambar" class="form-label">gambar</label>
                    <input type="file" name="gambar" id="update_gambar" class="form-control-file">
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
      url: `{{ asset('infoPolitik/berita') }}`,
      method: "POST",
      data: {
        getData: true,
        data: e.currentTarget.value
      },
      dataType: "json",
      success: resp => {
          $("#edit_form").attr("action", `{{ asset('infoPolitik/berita/${resp.id_news}') }}`)
          @auth("web")
          $("#edit_id_caleg").val(resp.id_caleg)
          @endauth
          $("#update_judul").val(resp.judul)
          $("#update_isi_berita").val(resp.isi_berita)
          $("#update_tgl_publish").val(resp.tgl_publish)
      } 
    })
}

$(".getData").on("click", getData);
})
</script>
@endsection