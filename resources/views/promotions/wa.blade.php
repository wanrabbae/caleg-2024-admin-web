{{-- WA BLAS --}}
@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" id="sendBtn" class="btn btn-primary" data-toggle="modal" data-target="#createModal" disabled>
                <i class="fas fa-comments"></i>
                Kirim Pesan Ke Relawan
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pilih</th>
                            <th>Nama Relawan</th>
                            <th>No Hp</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Koordinator</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($relawan->count())
                            @foreach ($relawan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="checkbox" name="check" class="check" class="form-control w-50">
                                    </td>
                                    <td>{{ $data->nama_relawan }}</td>
                                    <td>{{ $data->no_hp }}</td>
                                    <td>{{ $data->desa->nama_desa ?? '' }}</td>
                                    <td>
                                        {{ $data->desa->kecamatan->nama_kecamatan ?? '' }}
                                    </td>
                                    <td></td>
                                    <td>
                                        @if (File::exists($data->foto_ktp))
                                            <img src="{{ asset($data->foto_ktp) }}" alt="" style="width: 200px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>

                                    <td id="sendColumn">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#createModal" onclick="getData({{ $data->id_relawan }})" id="send">
                                            <i class="fas fa-bell"></i>
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
                <form action="/whatsapp" method="POST" id="sendForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_hp">Pesan Japri</label>
                            <textarea name="pesan" id="pesan" cols="30" rows="4" placeholder="Pesan..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
    </div> --}}

    <script>
        function getData(data) {
            fetch(`/relawan/${data}`).then(resp => resp.json()).then(resp => {
                document.getElementById("nama_relawan").value = resp.nama_relawan
                document.getElementById("no_hp").value = resp.no_hp
            })
        }

        let checkBox = Array.from(document.getElementsByClassName("check"));

        let check = e => {
            let check = [...checkBox].filter(v => v.checked).length > 0;
            check ? document.getElementById("sendBtn").disabled = false : document.getElementById("sendBtn").disabled = true;
        }

        checkBox.forEach((v, i) => {
            v.addEventListener("change", check)
        })
    </script>
@endsection
