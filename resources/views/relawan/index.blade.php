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
                            <th>Desa</th>
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
                        @if ($relawan->count())
                            @foreach ($relawan as $data)
                                <tr>
                                    <td>{{ $data->id_relawan }}</td>
                                    <td>{{ $data->nik }}</td>
                                    <td>{{ $data->nama_relawan }}</td>
                                    <td>{{ $data->desa->nama_desa }}</td>
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
                                        <button class="btn btn-primary" onclick="getData({{ $data->id_relawan }})" data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="/dashboard/legislatif/{{ $data->id_relawan }}" method="POST">
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Relawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/relawan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="nik">Nik</label>
                            <input required value="{{ old('nik') }}" type="number" class="form-control" id="nik" placeholder="Nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="nama_relawan">Nama Relawan</label>
                            <input required value="{{ old('nama_relawan') }}" type="text" class="form-control" id="nama_relawan" placeholder="Nama Legislatif" name="nama_relawan">
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
                                <option value="1">1</option>
                                <option value="2">2</option>
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
                <div class="modal-body">
                    <form action="" method="POST" id="edit_form">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nama_legislatif">Nama Legislatif</label>
                            <input required value="{{ old('') }}" type="text" class="form-control" id="edit_legislatif" placeholder="Nama Legislatif" name="nama_legislatif">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getData(data) {
            fetch(`/dashboard/legislatif/${data}`).then(resp => resp.json()).then(resp => {
                document.getElementById("edit_form").action = `/dashboard/legislatif/${data}`
                document.getElementById("edit_legislatif").value = resp.nama_legislatif
            })
        }
    </script>
@endsection
