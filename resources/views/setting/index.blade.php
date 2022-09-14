@extends('layouts.admin')

@section("content")
@auth("web")
@else
<div class="card shadow mb-4">
  <div class="card-header py-3">
        <h3 class="text-primary">Setting Profile</h3>
    </div>
    <div class="card-body">
    <form action="/setting/{{ auth()->user()->id_caleg }}" method="POST" enctype="multipart/form-data">
    @method("put")
        @csrf
    <div class="row">
        <div class="col-md-6">
            <p>Nama Caleg</p>
            <input type="text" class="form-control" value="{{ auth()->user()->nama_caleg }}" name="nama_caleg">
        </div>
        <div class="col-md-6">
            <p>Nama Lengkap</p>
            <input type="text" class="form-control" value="{{ auth()->user()->nama_lengkap }}" name="nama_lengkap">
        </div>
        <div class="col-md-6 mt-3">
            <label for="id_legislatif">Legislatif</label>
            <select class="form-control" name="id_legislatif" id="id_legislatif">
                @foreach ($legislatif as $item)
                <option value="{{ $item->id_legislatif }}" @if (auth()->user()->legislatif->id_legislatif == $item->id_legislatif) selected @endif>{{ $item->nama_legislatif }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="id_partai">Partai</label>
            <select class="form-control" name="id_partai" id="id_partai">
                @foreach ($partai as $item)
                <option value="{{ $item->id_partai }}" @if (auth()->user()->partai->id_partai == $item->id_partai) selected @endif>{{ $item->nama_partai }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <p>Alamat</p>
            <input type="text" class="form-control" value="{{ auth()->user()->alamat }}" name="alamat">
        </div>
        <div class="col-md-6 mt-3">
            <p>Nomor HP</p>
            <input type="text" class="form-control" value="{{ auth()->user()->no_hp }}" name="no_hp">
        </div>
        <div class="col-md-6 mt-3">
            <p>Email</p>
            <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="email">
        </div>
        <div class="col-md-6 mt-3">
            <p>Username</p>
            <input type="text" class="form-control" value="{{ auth()->user()->username }}" name="username">
        </div>
        <div class="col-md-12 mt-3">
            <p>Password</p>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="col-md-12 mt-3">
            <p>Foto</p>
            <img src="{{ auth()->user()->foto }}" alt="" class="img-fluid" style="height: 200px">
            <p class="mt-2">Update Foto</p>
            <input type="file" class="form-control-file" id="foto" name="foto">
        </div>
        <div class="col-md-3 mt-4">
            <button class="btn btn-primary w-100">Save</button>
        </div>
    </div>
    </form>
    </div>
</div>
@endauth
<div class="card shadow mb-4">
  <div class="card-header py-3">
        <h3 class="text-primary">Setting Profile</h3>
    </div>
    <div class="card-body">
    <form action="/setting/{{ auth()->user()->id_users }}" method="POST" enctype="multipart/form-data">
    @method("put")
        @csrf
    <div class="row">
        <div class="col-md-6">
            <p>Nama Lengkap</p>
            <input type="text" class="form-control" value="{{ auth()->user()->nama_lengkap }}" name="nama_lengkap">
        </div>
        <div class="col-md-6">
            <p>Email</p>
            <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="email">
        </div>
        <div class="col-md-6 mt-3">
            <p>Nomor HP</p>
            <input type="text" class="form-control" value="{{ auth()->user()->no_telp }}" name="no_telp">
        </div>
        <div class="col-md-6 mt-3">
            <p>Level</p>
            <span>{{ auth()->user()->level }}</span>
        </div>
        <div class="col-md-6 mt-3">
            <p>Username</p>
            <input type="text" class="form-control" value="{{ auth()->user()->username }}" name="username">
        </div>
        <div class="col-md-6 mt-3">
            <p>Warna</p>
            <input type="color" class="form-control" name="warna" value="{{ auth()->user()->warna }}">
        </div>
        <div class="col-md-12 mt-3">
            <p>Password</p>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="col-md-12 mt-3">
            <p>Foto</p>
            <img src="{{ auth()->user()->foto_user }}" alt="" class="img-fluid" style="height: 200px">
            <p class="mt-2">Update Foto</p>
            <input type="file" class="form-control-file" id="foto" name="foto_user">
        </div>
        <div class="col-md-3 mt-4">
            <button class="btn btn-primary w-100">Save</button>
        </div>
    </div>
    </form>
    </div>
</div>
@endsection
