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
                                    <button type="button" class="btn btn-warning mx-3" onclick="getBerita({{ $item->id_news }})" data-bs-toggle="modal" data-bs-target="#exampleModal1">
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
          <h5 class="modal-title" id="exampleModalLabel">Create News Data</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">
          <form action="{{ asset('/infoPolitik/news') }}" method="post" enctype="multipart/form-data">

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
