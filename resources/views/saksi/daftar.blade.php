@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
  <div class="card-header py-3">
<<<<<<< HEAD
=======
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Daftar Saksi
            </button> --}}
>>>>>>> ca71d608ae3bc759255ca2f8d6a423981dcbc151
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
                        <th>Nama Relawan</th>
                        <th>Jenis Kelamin</th>
<<<<<<< HEAD
                        <th>TPS</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
=======
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>TPS</th>
                        <th>HP</th>
                        <th>Email</th>
>>>>>>> ca71d608ae3bc759255ca2f8d6a423981dcbc151
                        <th>Desa</th>
                        <th>Kecamatan</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->relawan->nama_relawan }}</td>
                                <td>{{ $data->relawan->jk }}</td>
                                <td>{{ $data->relawan->tps }}</td>
                                @auth("web")
                                <td>{{ $data->caleg->nama_caleg }}</td>
                                @endauth
                                <td>{{ $data->relawan->desa->nama_desa }}</td>
                                <td>{{ $data->relawan->desa->kecamatan->nama_kecamatan }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<<<<<<< HEAD
@endsection
=======

{{-- Modal Create --}}
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Tambah Nama Saksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/saksi/daftar/" method="POST">
        <div class="modal-body">
                @csrf
                @auth("web")
                <div class="mb-3">
                    <label for="legislatif" class="form-label">Calon Legislatif</label>
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
                  <label for="id_relawan" class="form-label">Nama Saksi</label>
                  <select class="form-select form-control" name="id_relawan" id="id_relawan">
                      @foreach ($relawan as $item)
                      @if (old('id_relawan')==$item->id_relawan)
                          <option value="{{ $item->id_relawan }}" selected>{{ $item->nama_relawan }}</option>
                      @else
                          <option value="{{ $item->id_relawan }}">{{ $item->nama_relawan }}</option>
                      @endif
                      @endforeach
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
          <h5 class="modal-title" id="editModalLabel">Edit Nama saksi</h5>
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
                    <label for="legislatif" class="form-label">Calon Legislatif</label>
                    <select class="form-select form-control" name="id_caleg" id="edit_id_caleg">
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
                    <label for="nama_saksi" class="form-label">Nama Saksi</label>
                    <select class="form-select form-control" name="id_relawan" id="id_relawan">
                        @foreach ($relawan as $item)
                        @if (old('id_relawan')==$item->id_relawan)
                            <option value="{{ $item->id_relawan }}" selected>{{ $item->nama_relawan }}</option>
                        @else
                            <option value="{{ $item->id_relawan }}">{{ $item->nama_relawan }}</option>
                        @endif
                        @endforeach
                      </select>
                  </div>
              </div>
              <div class="modal-footer">
                  <a href="">
                    <button type="submit" class="btn btn-primary">Edit</button>
                  </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </form>
      </div>
    </div>
  </div>

  <script>
    function getData(data) {
        fetch(`/saksi/daftar/${data}`).then(resp => resp.json()).then(resp => {
            document.getElementById("edit_form").action = `/saksi/daftar/${data}`
            document.getElementById("edit_nama_relawan").value = resp.nama_relawan
            document.getElementById("edit_id_caleg").value = resp.id_caleg
    })
    }
  </script>
@endsection
>>>>>>> ca71d608ae3bc759255ca2f8d6a423981dcbc151
