@extends('layouts.admin')
@section('content')
{{-- @dd($data) --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Daftar Isu</h6>
        <div class="card-body">
            <div class="col-lg-5">
                <form action="{{ asset('updateDaftarIsu') }}/{{ $data->id_kecamatan }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" id="nama_kecamatan" name="nama_kecamatan" value="{{ old('nama_kecamatan')}} {{ $data->nama_kecamatan }}">
                        @error('nama_kecamatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="wilayah" class="form-label">Wilayah</label>
                        <input type="text" class="form-control @error('wilayah') is-invalid @enderror" id="wilayah" name="wilayah" value="{{ old('wilayah') }}{{ $data->wilayah }}">
                        @error('wilayah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten" id="kabupaten" class="form-label">Kabupaten</label>
                        <select class=" form-control form-select @error('id_kabupaten') is-invalid @enderror" name="id_kabupaten">
                            <option selected>Open this select menu</option>
                            @foreach ($kabupaten as $item)
                                @if (old('id_kabupaten', $data->id_kabupaten) == $item->id_kabupaten)
                                    <option value="{{ $item->id_kabupaten }}" selected>{{ $item->nama_kabupaten }}</option>
                                @else
                                    <option value="{{ $item->id_kabupaten }}">{{ $item->nama_kabupaten }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('id_kabupaten')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
