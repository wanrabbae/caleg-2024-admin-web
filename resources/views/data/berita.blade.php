@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    {{-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data </h6>
    </div> --}}
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
                                    <a href="" class="badge bg-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class=" badge bg-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
