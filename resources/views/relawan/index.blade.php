{{-- DATA RELAWAN --}}
@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Relawan
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>Nama Relawan</th>
                            <th>Jabatan</th>
                            <th>Upline</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>KTP</th>
                            <th>Caleg</th>
                            <th>Status</th>
                            <th>No Hp</th>
                            <th>E-mail</th>
                            <th>Username</th>
                            <th>Blokir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count())
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $data->id_relawan }}</td>
                                    <td>{{ $data->nik }}</td>
                                    <td>
                                        <button class="text-nowrap btn @if ($data->loyalis == 1) btn-success @elseif ($data->loyalis == 2) btn-warning @else btn-danger @endif" data-toggle="modal" data-target="#editLoyalModal"
                                            onclick="getLoyalis({{ $data->id_relawan }})"
                                            >
                                            {{ $data->nama_relawan }}
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#editJabatanModal" onclick="getJabatan({{ $data->id_relawan }})">
                                            @if ($data->jabatan == 1)
                                            KoorDes
                                            @elseif ($data->jabatan == 2)
                                            KoorCam
                                            @else
                                            Simpatisan
                                            @endif
                                        </button>
                                    </td>
                                    <td>
                                        {{ $data->upline }}
                                    </td>
                                    <td>{{ $data->desa->nama_desa }}</td>
                                    <td>{{ $data->desa->kecamatan->nama_kecamatan }}</td>
                                    <td>
                                        @if (Storage::exists($data->foto_ktp))
                                            <img src="{{ asset('storage/' . $data->foto_ktp) }}" alt="" style="width: 200px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->caleg->nama_lengkap ?? ' ' }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->no_hp }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->blokir }}</td>
                                    <td>
                                        <a href="{{ asset("team/upline/$data->id_relawan") }}">
                                            <button class="btn btn-warning">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-primary" onclick="getData({{ $data->id_relawan }})" data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="/team/{{ $data->id_relawan }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini ?')" class="btn btn-danger">
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Relawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/team" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="nik">Nik</label>
                            <input required value="{{ old('nik') }}" type="number" class="form-control" id="nik" placeholder="Nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="nama_relawan">Nama Relawan</label>
                            <input required value="{{ old('nama_relawan') }}" type="text" class="form-control" id="nama_relawan" placeholder="Nama Relawan" name="nama_relawan">
                        </div>
                        <div class="form-group">
                            <label for="id_desa">Pilih Desa</label>
                            <select class="form-control" name="id_desa" id="id_desa">
                                @foreach ($desa as $item)
                                    <option value="{{ $item->id_desa }}">{{ $item->nama_desa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto_ktp">Upload Foto KTP</label>
                            <input required value="{{ old('foto_ktp') }}" type="file" class="form-control" id="foto_ktp" name="foto_ktp">
                        </div>
                        <div class="form-group">
                            <label for="id_caleg">Pilih Caleg</label>
                            <select class="form-control" name="id_caleg" id="id_caleg">
                                @foreach ($caleg as $item)
                                    <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="loyalis">Loyalis</label>
                            <select class="form-control" name="loyalis" id="loyalis">
                                <option value="1">Simpatisan</option>
                                <option value="2">Relawan</option>
                                <option value="3">Moderat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input required value="{{ old('no_hp') }}" type="number" class="form-control" id="no_hp" placeholder="No Hp" name="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input required value="{{ old('email') }}" type="text" class="form-control" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required value="{{ old('username') }}" type="text" class="form-control" id="username" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required value="{{ old('password') }}" type="password" class="form-control" id="password" placeholder="Password" name="password">
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
                    <h5 class="modal-title" id="editModalLabel">Edit Relawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="edit_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nik">Nik</label>
                            <input value="{{ old('nik') }}" type="number" class="form-control" id="nik_edit" placeholder="Nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="nama_relawan">Nama Relawan</label>
                            <input value="{{ old('nama_relawan') }}" type="text" class="form-control" id="edit_nama_relawan" placeholder="Nama Relawan" name="nama_relawan">
                        </div>
                        <div class="form-group">
                            <label for="id_desa">Pilih Desa</label>
                            <select class="form-control" name="id_desa" id="edit_id_desa">
                                @foreach ($desa as $item)
                                    <option value="{{ $item->id_desa }}">{{ $item->nama_desa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto_ktp">Upload Foto KTP</label>
                            <input value="{{ old('foto_ktp') }}" type="file" class="form-control" id="foto_ktp" name="foto_ktp">
                        </div>
                        <div class="form-group">
                            <label for="id_caleg">Pilih Caleg</label>
                            <select class="form-control" name="id_caleg" id="edit_id_caleg">
                                @foreach ($caleg as $item)
                                    <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="edit_status">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input value="{{ old('no_hp') }}" type="number" class="form-control" id="edit_no_hp" placeholder="No Hp" name="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input value="{{ old('email') }}" type="text" class="form-control" id="edit_email" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value="{{ old('username') }}" type="text" class="form-control" id="edit_username" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input value="{{ old('password') }}" type="password" class="form-control" id="edit_password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Loyalist --}}
    <div class="modal fade" id="editLoyalModal" tabindex="-1" role="dialog" aria-labelledby="createLoyalisLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Edit Loyalis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="edit_form_loyal">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_desa">Ganti Loyalis</label>
                            <select class="form-control" name="loyalis" id="edit_loyalis">
                                <option value="1">Simpatisan</option>
                                <option value="2">Relawan</option>
                                <option value="3">Moderat</option>
                            </select>
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
</div>

    <div class="modal fade" id="editJabatanModal" tabindex="-1" role="dialog" aria-labelledby="createJabatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Edit Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="edit_form_jabatan">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="desa" id="edit_desa">
                            <label for="id_desa">Ganti Jabatan</label>
                            <select class="form-control" name="jabatan" id="edit_jabatan">
                                <option value="0">Simpatisan</option>
                                <option value="1">Koordinator Desa</option>
                                <option value="2">Koordinator Kecamatan</option>
                            </select>
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
            fetch(`/team/${data}`).then(resp => resp.json()).then(resp => {
                document.getElementById("edit_form").action = `/team/${data}`
                document.getElementById("edit_nama_relawan").value = resp.nama_relawan
                document.getElementById("nik_edit").value = resp.nik
                document.getElementById("edit_email").value = resp.email
                document.getElementById("edit_id_desa").value = resp.id_desa
                document.getElementById("edit_username").value = resp.username
                document.getElementById("edit_no_hp").value = resp.no_hp
            })
        }

        function getLoyalis(data) {
            fetch(`/team/${data}`).then(resp => resp.json()).then(resp => {
                document.getElementById("edit_form_loyal").action = `/team/${data}`
                document.getElementById("edit_loyalis").value = resp.loyalis
            })
        }

        function getJabatan(data) {
            fetch(`/team/${data}`).then(resp => resp.json()).then(resp => {
                document.getElementById("edit_form_jabatan").action = `/team/${data}`
                document.getElementById("edit_jabatan").value = resp.jabatan
                document.getElementById("edit_desa").value = resp.id_desa
            })
        }
    </script>    
@endsection