@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="col-md-3">
    </div>
    <div class="card-header py-3">
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Isu
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Dampak</th>
                        <th>Tanggal</th>
                        <th>Kecamatan</th>
                        <th>Pelapor</th>
                        <th>Keterangan</th>
                        <th>Di Tanggapi</th>
                        <th>Tanggapan</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $data->jenis == "L" ? "Isu Lapangan" : "Isu Online" }}
                            <td>
                                {{ $data->dampak == "P" ? "Positif" : "Negatif" }}
                            </td>
                            <td>
                                {{ $data->tanggal }}
                            </td>
                            <td>
                                {{ $data->kecamatan->nama_kecamatan }}
                            </td>
                            <td>
                                {{ $data->relawan->nama_relawan }}
                            </td>
                            <td>
                                {{ $data->keterangan }}
                            </td>
                            <td>
                                {{ $data->tanggapi }}
                            </td>
                            <td>
                                {{ $data->tanggapan }}
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
