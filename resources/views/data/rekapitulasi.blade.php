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
                        <th>Nama Desa</th>
                        <th>Type</th>
                        <th>DPT</th>
                        <th>Jumlah TPS</th>
                        <th>Suara</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_desa }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->dpt }}</td>
                                <td>{{ $item->tps }}</td>
                                <td>{{ $item->suara }}</td>
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
