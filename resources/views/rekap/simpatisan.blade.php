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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Program</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($program->count())
                            <?php $i = 1; ?>
                            @foreach ($program as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->judul_program }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>
                                        @if (Storage::exists($data->foto))
                                            <img src="{{ asset('storage/' . $data->foto) }}" alt="" style="width: 200px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-warning mx-3" onclick="getData2({{ $data->id_program }})" data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="/program/{{ $data->id_program }}" method="POST" class="d-inline">
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
                <form action="/program" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="judul_program">Judul Program</label>
                            <input type="text" class="form-control" id="judul_program" placeholder="Nama Program" name="judul_program">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Program</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Program</label>
                            <input type="file" class="form-control" id="foto" name="foto">
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
                        <div class="form-group">
                            <label for="edt_deskripsi">Deskripsi Program</label>
                            <textarea name="deskripsi" id="edt_deskripsi" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <img width="100" alt="NotFound.png" id="preview_image">
                            <label for="foto">Foto Program</label>
                            <input type="file" class="form-control" id="foto" name="foto">
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
        function getData2(data) {
            console.log(data);
            fetch(`/program/${data}`).then(resp => resp.json()).then(resp => {
                document.getElementById("edit_form").action = `/program/${data}`
                document.getElementById("edit_judul_program").value = resp.nama_judul_program
                document.getElementById("edit_deskripsi").value = resp.nama_deskripsi
                document.getElementById("preview_image").src = {{ asset('storage/') }} + resp.foto
            })
        }
    </script>
@endsection
