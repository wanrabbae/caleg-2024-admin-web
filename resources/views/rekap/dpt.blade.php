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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @auth("web")
                            <th>Caleg</th>
                            @endauth
                            <th>Nama Pemilih</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>JK</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>TPS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($datas->count())
                            @foreach ($datas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nik }}</td>
                                    @auth("web")
                                    <td>{{ $item->caleg->nama_caleg }}</td>
                                    @endauth
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ $item->tgl_lahir }}</td>
                                    <td>{{ $item->jk }}</td>
                                    <td>{{ $item->desa->nama_desa }}</td>
                                    <td>{{ $item->desa->kecamatan->nama_kecamatan }}</td>
                                    <td>{{ $item->tps }}</td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-warning mx-3" onclick="getData({{ $item->id_pemilih }})" data-bs-toggle="modal" data-bs-target="#exampleModal1">
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

    {{-- Modal Create data DPT --}}
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Data DPT</h5>
                    <span aria-hidden="true">&times;</span>
                </div>
                <form action="{{ asset('/dpt') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder=" Masukan NIK">
                        </div>
                        @if (auth("web")->check())
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
                        @endif
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Pemilih</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Pemilih">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan Tempat Lahir">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Masukan Tanggal Lahir">
                        </div>
                        <div class="form-group">
                            <label for="tgl_data" class="form-label">Tanggal Data Ditambahkan</label>
                            <input type="datetime-local" class="form-control" id="tgl_data" name="tgl_data" placeholder="Masukan Tanggal Lahir">
                        </div>
                        <div class="form-group">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control form-select">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tps" class="form-label">TPS</label>
                            <input type="number" class="form-control" id="tps" name="tps" placeholder=" Masukan TPS">
                        </div>
                        <div class="form-group">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-control form-select" name="id_desa" id="id_desa">
                                @foreach ($desas as $item)
                                    @if (old('id_desa') == $item->id_desa)
                                        <option value="{{ $item->id_desa }}" selected>{{ $item->nama_desa }}</option>
                                    @else
                                        <option value="{{ $item->id_desa }}">{{ $item->nama_desa }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="relawan" class="form-label">Relawan</label>
                            <select name="relawan" id="relawan" class="form-control form-select">
                                <option value="Y">Ya</option>
                                <option value="T">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="saksi" class="form-label">Saksi</label>
                            <select name="saksi" id="saksi" class="form-control form-select">
                                <option value="Y">Ya</option>
                                <option value="T">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user" class="form-label">User</label>
                            <select class=" form-control form-select" name="id_users" id="id_users">
                                @foreach ($users as $item)
                                    @if (old('id_users') == $item->id_users)
                                        <option value="{{ $item->id_users }}">{{ $item->username }}</option>
                                    @else
                                        <option value="{{ $item->id_users }}">{{ $item->username }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
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
                        @if (auth("web")->check())
                        <div class="form-group">
                            <label for="id_caleg" class="form-label" >Caleg</label>
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
                        @endif
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
                            <label for="tps" class="form-label">TPS</label>
                            <input type="number" class="form-control" id="edit_tps" name="tps" placeholder=" Masukan TPS">
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
                        <div class="form-group">
                            <label for="relawan" class="form-label">Relawan</label>
                            <select name="relawan" id="edit_relawan" class="form-control form-select">
                                <option value="Y">Ya</option>
                                <option value="T">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="saksi" class="form-label">Saksi</label>
                            <select name="saksi" id="edit_saksi" class="form-control form-select">
                                <option value="Y">Ya</option>
                                <option value="T">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user" class="form-label">User</label>
                            <select class=" form-control form-select" name="id_users" id="edit_id_users">
                                @foreach ($users as $item)
                                    @if (old('id_users') == $item->id_users)
                                        <option value="{{ $item->id_users }}">{{ $item->username }}</option>
                                    @else
                                        <option value="{{ $item->id_users }}">{{ $item->username }}</option>
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
    <script>
    function getData(params) {
    fetch(`/dpt/${params}`).then(response => response.json()).then(response => {
        document.getElementById("edit_form").action = `/dpt/${params}`
        document.getElementById("edit_nik").value = response.nik
        @auth("web")
        document.getElementById("edit_id_caleg").value = response.id_caleg
        @endauth
        document.getElementById("edit_nama").value = response.nama
        document.getElementById("edit_tempat_lahir").value = response.tempat_lahir
        document.getElementById("edit_tgl_lahir").value = response.tgl_lahir
        document.getElementById("edit_jk").value = response.jk
        document.getElementById("edit_tps").value = response.tps
        document.getElementById("edit_id_desa").value = response.id_desa
        document.getElementById("edit_relawan").value = response.relawan
        document.getElementById("edit_saksi").value = response.saksi
        document.getElementById("edit_id_users").value = response.id_users
    })
}

        document.getElementById("dpt").addEventListener("change", function(e) {
            e.target.form.submit();
        })
    </script>

@endsection