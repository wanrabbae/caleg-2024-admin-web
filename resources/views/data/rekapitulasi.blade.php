@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="fas fa-plus"></i>Create</a>
    </div>
    <a href=""></a>
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
                                    <button type="button"></button>
                                    <button type="button"></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Rekapitulasi --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Data Rekapitulasi</h5>
        </div>
        <div class="modal-body">
            <form action="{{ asset('postRekapitulasi') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name_desa" class="form-label">Nama Desa</label>
                    <input type="text" class="form-control @error('nama_desa') is-invalid @enderror" id="name_desa" name="nama_desa" value="{{ old('nama_desa') }}">
                    @error('nama_desa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}">
                    @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dpt" class="form-label">DPT</label>
                    <input type="number" class="form-control @error('dpt') is-invalid @enderror" id="dpt" name="dpt" value="{{ old('dpt') }}">
                    @error('dpt')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tps" class="form-label">TPS</label>
                    <input type="number" class="form-control @error('tps') is-invalid @enderror" id="tps" name="tps" value="{{ old('tps') }}">
                    @error('tps')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="suara" class="form-label">Suara</label>
                    <input type="number" class="form-control @error('suara') is-invalid @enderror" id="suara" name="suara" value="{{ old('suara') }}">
                    @error('suara')
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
