@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="col-md-3">
    </div>
    <div class="card-header py-3">
        {{-- <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Isu
        </button> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Dampak</th>
                        <th>Tanggal</th>
                        <th>Kecamatan</th>
                        <th>Pelapor</th>
                        <th>Keterangan</th>
                        <th>Di Tanggapi</th>
                        <th>Tanggapan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $data->jenis == "L" ? "Isu Lapangan" : "Isu Online" }}
                            <td>
                                {{ $data->dampak == "P" ? "Positif" : "Negatif" }}
                            </td>
                            <td>
                                {{ $data->tanggal }}
                            </td>
                            <td>
                                {{ $data->kecamatan->nama_kecamatan }}
                            </td>
                            <td>
                                {{ $data->relawan->nama_relawan }}
                            </td>
                            <td>
                                {{ $data->keterangan }}
                            </td>
                            <td>
                                @if ($data->tanggapi == "N")
                                {{-- <form action="/infoPolitik/daftarIsu/{{ $data->id_isu }}" method="POST">
                                    @method("put")
                                    @csrf
                                    <button class="btn btn-primary" type="submit" name="tanggapi">
                                        Tanggapi
                                    </button>
                                </form> --}}
                                    <button class="btn btn-primary" onclick="getTanggapan({{ $data->id_isu }})" data-toggle="modal" data-target="#tanggapiModal">
                                        Tanggapi
                                    </button>
                                @else
                                 <form action="/infoPolitik/daftarIsu/{{ $data->id_isu }}" method="POST">
                                    @method("put")
                                    @csrf
                                    <button class="btn btn-success" type="submit" name="unrespond">
                                        Ditanggapi
                                    </button>
                                </form>
                                @endif
                        </td>
                            <td>
                                {{ $data->tanggapan }}
                            </td>
                            <td class="d-flex justify-content-center">
                                    @if ($data->tanggapi != "N")
                                    <button class="btn btn-warning mx-3" onclick="getData({{ $data->id_isu }})" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @endif
                                    <form action="/infoPolitik/daftarIsu/{{ $data->id_isu }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Isu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/infoPolitik/daftarIsu/" method="POST">
        <div class="modal-body">
                @csrf
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
                    <label for="jenis" class="form-label" >Jenis</label>
                    <select class="form-select form-control" name="jenis" id="jenis">
                            <option value="L" selected>Lapangan</option>
                            <option value="O">Online</option>
                      </select>
                </div>
                <div class="form-group">
                    <label for="dampak" class="form-label" >Dampak</label>
                    <select class="form-select form-control" name="dampak" id="dampak">
                            <option value="P" selected>Positif</option>
                            <option value="N">Negatif</option>
                      </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
                <div class="form-group">
                    <label for="id_kecamatan">Kecamatan</label>
                    <select class="form-control" name="id_kecamatan" id="id_kecamatan">
                    @foreach ($kecamatan as $item)
                        <option value="{{ $item->id_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                    @endforeach
                    </select>
                </div>
                @auth("web")
                <div class="form-group">
                    <label for="id_relawan">Relawan</label>
                    <select class="form-control" name="id_relawan" id="id_relawan">
                        <option value="">Silahkan Pilih Caleg</option>
                    </select>
                </div>
                @else
                <div class="form-group">
                    <label for="id_relawan">Relawan</label>
                    <select class="form-control" name="id_relawan" id="id_relawan">
                    @if ($relawan->count())
                    @foreach ($relawan as $item)
                        <option value="{{ $item->id_relawan }}">{{ $item->nama_relawan }}</option>
                    @endforeach
                    @else
                        <option value="">Tidak Ada Relawan</option>
                    @endif
                    </select>
                </div>
                @endif
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea type="text" class="form-control" id="keterangan" placeholder="Keterangan..." name="keterangan" rows="5"></textarea>
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

{{-- Tangapi Modal --}}
  <div class="modal fade" id="tanggapiModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Tanggapi Berita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
        <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="tanggapan">Tanggapan</label>
                  <textarea type="text" class="form-control" id="tanggapan" placeholder="Tanggapan" name="btn_tanggapan" rows="5"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Tanggapi</button>
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
          <h5 class="modal-title" id="editModalLabel">Edit Berita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form_2">
        <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="jenis" class="form-label" >Jenis</label>
                    <select class="form-select form-control" name="jenis" id="edit_jenis">
                            <option value="L" selected>Lapangan</option>
                            <option value="O">Online</option>
                      </select>
                </div>
                <div class="form-group">
                    <label for="dampak" class="form-label" >Dampak</label>
                    <select class="form-select form-control" name="dampak" id="edit_dampak">
                            <option value="P" selected>Positif</option>
                            <option value="N">Negatif</option>
                      </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="edit_tanggal" class="form-control">
                </div>
                <div class="form-group">
                    <label for="id_kecamatan">Kecamatan</label>
                    <select class="form-control" name="id_kecamatan" id="edit_id_kecamatan">
                    @foreach ($kecamatan as $item)
                        <option value="{{ $item->id_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea type="text" class="form-control" id="edit_keterangan" placeholder="Keterangan..." name="keterangan" rows="5"></textarea>
                </div>
                <div class="form-group">
                  <label for="tanggapan">Tanggapan</label>
                  <textarea type="text" class="form-control" id="edit_tanggapan" placeholder="Tanggapan..." name="tanggapan" rows="5"></textarea>
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

    <script>
    function getTanggapan(data) {
            document.getElementById("edit_form").action = `/infoPolitik/daftarIsu/${data}`
        }

    function getData(id) {
        fetch(`/infoPolitik/daftarIsu/${id}`).then(resp => resp.json()).then(resp => {
            document.getElementById("edit_form_2").action = `/infoPolitik/daftarIsu/${id}`
            document.getElementById("edit_id_kecamatan").value = resp.id_kecamatan
            document.getElementById("edit_jenis").value = resp.jenis
            document.getElementById("edit_keterangan").value = resp.keterangan
            document.getElementById("edit_tanggal").value = resp.tanggal
            document.getElementById("edit_tanggapan").value = resp.tanggapan
        })
    }

    @auth("web")
    document.getElementById("id_caleg").addEventListener("change", function(e) {
        fetch(`/infoPolitik/daftarIsu/relawan/${e.target.value}`).then(resp => resp.json()).then(resp => {
            let text = "";
            if (resp.length == 0) {
                text += "<option value=''>Tidak Ada Relawan</option>"
            } else {
                resp.forEach(v => {
                    text += `
                        <option value="${v.id_relawan}">${v.nama_relawan}</option>
                    `
                })
            }
            document.getElementById("id_relawan").innerHTML = text;
    })
})
@endauth
    </script>

@endsection
