@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Caleg
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Caleg</th>
                            <th>Nama</th>
                            <th>Legislatif</th>
                            <th>Alamat</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Partai</th>
                            <th>Aktif</th>
                            <th>Username</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dataArr->count())
                            @foreach ($dataArr as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_caleg }}</td>
                                    <td>{{ $data->nama_lengkap }}</td>
                                    <td>{{ $data->legislatif->nama_legislatif }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->no_hp }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->partai->nama_partai }}</td>
                                    <td>
                                        <form action="/caleg/{{ $data->id_caleg }}" method="POST">
                                            @method("put")
                                            @csrf
                                            <button class="btn @if ($data->aktif == 'Y') btn-success @else btn-danger @endif" type="submit" value="{{ $data->aktif }}" name="aktif">
                                                {{ $data->aktif }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>{{ $data->username }}</td>
                                    <td>
                                        @if (Storage::exists($data->foto))
                                            <img src="{{ asset('storage/' . $data->foto) }}" alt="" class="mx-auto d-block" style="width: 75px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-warning mx-3" data-target="#editModal" data-toggle="modal" onclick="getData({{ $data->id_caleg }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="/caleg/{{ $data->id_caleg }}" method="POST" class="d-inline">
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Caleg</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/caleg" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="nama_caleg">Nama Caleg</label>
                            <input type="text" class="form-control" name="nama_caleg" value="{{ old('nama_caleg') }}" id="nama_caleg" placeholder="Nama Caleg">
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" id="nama_lengkap" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="id_legislatif">Pilih Legislatif</label>
                            <select class="form-control" name="id_legislatif" value="{{ old('id_legislatif') }}" id="id_legislatif">
                                @foreach ($legislatif as $item)
                                <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" id="alamat" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Phone</label>
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" id="no_hp" placeholder="Nomor HP">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="id_partai">Pilih Partai</label>
                            <select class="form-control" name="id_partai" value="{{ old('id_partai') }}" id="id_partai">
                                @foreach ($partai as $item)
                                <option value="{{ $item->id_partai }}">{{ $item->nama_partai }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="aktif">Aktif</label>
                            <select class="form-control" name="aktif" id="aktif" value="{{ old('aktif') }}">
                                <option value="Y">Aktif</option>
                                <option value="N">Nonaktif</option>
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Diri</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
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
          <h5 class="modal-title" id="editModalLabel">Edit Caleg</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" id="edit_form">
            <div class="modal-body">
                @method("put")
                @csrf
                <div class="form-group">
                    <label for="nama_caleg">Nama Caleg</label>
                    <input type="text" class="form-control" name="nama_caleg" id="edit_nama_caleg" placeholder="Nama Caleg">
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="edit_nama_lengkap" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="id_legislatif">Pilih Legislatif</label>
                    <select class="form-control" name="id_legislatif" id="edit_id_legislatif">
                        @foreach ($legislatif as $item)
                        <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="edit_alamat" placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="no_hp">Phone</label>
                    <input type="text" class="form-control" name="no_hp" id="edit_no_hp" placeholder="Nomor HP">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="edit_email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="id_partai">Pilih Partai</label>
                    <select class="form-control" name="id_partai" id="edit_id_partai">
                        @foreach ($partai as $item)
                        <option value="{{ $item->id_partai }}">{{ $item->nama_partai }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="aktif">Aktif</label>
                    <select class="form-control" name="aktif" id="edit_aktif">
                        <option value="Y">Aktif</option>
                        <option value="N">Nonaktif</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="edit_username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="edit_password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="foto">Foto Diri</label>
                    <input type="file" class="form-control-file" id="edit_foto" name="foto">
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

  <script>
    let getData = id => {
        fetch(`/caleg/${id}`).then(resp => resp.json()).then(resp => {
            document.getElementById("edit_form").action = `/caleg/${id}`
            document.getElementById("edit_nama_caleg").value = resp.nama_caleg;
            document.getElementById("edit_nama_lengkap").value = resp.nama_lengkap;
            document.getElementById("edit_id_legislatif").value = resp.id_legislatif;
            document.getElementById("edit_alamat").value = resp.alamat;
            document.getElementById("edit_no_hp").value = resp.no_hp;
            document.getElementById("edit_email").value = resp.email;
            document.getElementById("edit_id_partai").value = resp.id_partai;
            document.getElementById("edit_aktif").value = resp.aktif;
            document.getElementById("edit_username").value = resp.username;
        })
    }    
  </script>
@endsection
