@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="fas fa-plus"></i>Create</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Berita</th>
                        <th>Isi Berita</th>
                        <th>Tgl Publish</th>
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
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->isi_berita }}</td>
                                <td>{{ $item->tgl_publish }}</td>
                                <td>
                                    <a href="/infoPolitik/news/publish_news/{{ $item->id_news }}/{{ $item->aktif }}" class="btn btn-primary" onclick="return confirm('Apa Anda Yakin Ingin Menampilkan Berita Ini')">Publish</a>
                                </td>
                                <td>{{ $item->gambar }}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-warning mx-3" onclick="getValue({{ $item->id_news }})" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/infoPolitik/news/{{ $item->id_news }}" method="post" class="d-inline">
                                     @method('delete')
                                     @csrf
                                     <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus desa {{ $item->judul}}')">
                                         <i class="fas fa-trash-alt"></i>
                                     </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Berita --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create News</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">
            <form action="infoPolitik/news" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul_berita" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Masukan Judul Berita" value="{{ old('judul_berita') }}">
                  </div>
                  <div class="mb-3">
                    <label for="isi_berita" class="form-label">Isi Berita</label>
                    <textarea class="form-control" id="isi_berita" rows="2" placeholder="Masukan Isi berita" name="isi_berita"></textarea>
                </div>
                <div class="mb-3">
                    <label for="tgl_publish" class="form-label">Tanggal Publish</label>
                    <input type="date" class="form-control" id="tgl_publish" name="tgl_publish" value="{{ old('tgl_berita') }}">
                  </div>
                <div class="mb-3">
                    <label for="Caleg" class="form-label">Calon Legislatif</label>
                    <select class="form-select form-control" name="id_caleg" id="id_caleg">
                        <option selected>Open this select menu</option>
                        @foreach ($caleg as $item)
                        @if (old('id_caleg')==$item->id_caleg)
                            <option value="{{ $item->id_caleg}}">{{ $item->nama_caleg }}</option>
                        @else
                            <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="chechkBox" class="form-label">Publish</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="yes" name="yes">
                        <label class="form-check-label" for="yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="No" name="no">
                        <label class="form-check-label" for="flexCheckDefault">
                            No
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection
