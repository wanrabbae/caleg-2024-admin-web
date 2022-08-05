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
                                    <a href="/infoPolitik/berita/publish_news/{{ $item->id_news }}/{{ $item->aktif }}" class="btn btn-primary" onclick="return confirm('Apa Anda Yakin Ingin Menampilkan Berita Ini')">Publish</a>
                                </td>
                                <td>{{ $item->gambar }}</td>
                                <td>
                                    <a href="{{ asset('editBerita') }}/{{ $item->id_kecamatan }}" class="badge bg-warning"><i class="fas fa-edit"></i></a>
                                    <a href="{{ asset('deleteBerita') }}/{{ $item->id_kecamatan }}" class="badge bg-danger"><i class="fas fa-trash"></i></a>
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
        </div>
        <div class="modal-body">
            <form action="{{ asset('postBerita') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul_news" class="form-label">Judul News</label>
                    <input type="text" class="form-control @error('judul_news') is-invalid @enderror" id="judul_news" name="judul_news" value="{{ old('judul_news') }}">
                    @error('judul_news')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="isi_berita" class="form-label">isi Berita</label>
                    <textarea name="isi_berita" id="isi_berita"  rows="2" class="form-control @error('judul_news') is-invalid @enderror" value="{{ old('') }}"></textarea>
                    @error('isi_berita')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tgl_publish" class="form-label">Judul News</label>
                    <input type="date" class="form-control @error('tgl_publish') is-invalid @enderror" id="tgl_publish" name="tgl_publish" value="{{ old('tgl_publish') }}">
                    @error('tgl_publish')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar</label>
                    <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="formFile" name="gambar" value="{{ old('gambar') }}">
                    @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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
