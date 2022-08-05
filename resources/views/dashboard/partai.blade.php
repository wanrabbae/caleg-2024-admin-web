@extends("layouts.admin")

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Legislatif</th>
                        <th>No Urut</th>
                        <th>Warna</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $data->id_partai }}</td>
                                <td>{{ $data->nama_partai }}</td>
                                <td>{{ $data->no_urut }}</td>
                                <td>{{ $data->warna }}</td>
                                <td>
                                    @if (Storage::exists("/img/" . $data->logo))
                                    <img src="{{ asset('/img/' . $data->logo) }}" alt="">
                                    @else
                                    <i class="fas fa-image"></i>
                                    <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="badge bg-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="bg-danger">
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection
