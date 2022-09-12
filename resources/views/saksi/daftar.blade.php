@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
  <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Daftar Saksi
            </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Relawan</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>HP</th>
                        <th>Email</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Koordinator</th>
                        <th>Blokir</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->relawan->nama_relawan }}</td>
                                @auth("web")
                                <td>{{ $data->caleg->nama_caleg }}</td>
                                @endauth
                                <td>{{ $data->relawan->no_hp }}</td>
                                <td>{{ $data->relawan->email }}</td>
                                <td>{{ $data->relawan->desa->nama_desa }}</td>
                                <td>{{ $data->relawan->desa->kecamatan->nama_kecamatan }}</td>
                                <td>{{ $data->relawan->status }}</td>
                                <td>{{ $data->relawan->blokir }}</td>
                                <td>
                                  @if (Storage::exists($data->relawan->foto_ktp))
                                      <img src="{{ asset('storage/' . $data->relawan->foto_ktp) }}" alt="" style="width: 200px">
                                  @else
                                      <i class="fas fa-image"></i>
                                      <span>Image Not Found</span>
                                  @endif
                              </td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3" onclick="getData({{ $data->nik }})" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/saksi/daftar/{{ $data->nik }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Saksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/saksi/daftar/" method="POST">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="nik">NIK Saksi</label>
                  <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik">
                </div>
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
          <h5 class="modal-title" id="editModalLabel">Edit NIK saksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
        <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="nama_legislatif">NIK</label>
                  <input type="text" class="form-control" id="edit_nik" placeholder="NIK" name="nik">
                </div>
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

  <script>
    function getData(data) {
        fetch(`/saksi/daftar/${data}`).then(resp => resp.json()).then(resp => {
            document.getElementById("edit_form").action = `/saksi/daftar/${data}`
            document.getElementById("edit_nik").value = resp.nik
    })
    }
  </script>
@endsection
