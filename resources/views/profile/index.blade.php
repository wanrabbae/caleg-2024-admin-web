@extends('layouts.admin')
@section('content')
@auth("caleg")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="text-primary font-weight-bold">My Profile</h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div style="overflow: hidden; width: 75%">
                <div class="card text-center" style="width: 50%; ">
                    <img src="{{ asset('public/' . auth()->user()->foto) }}" alt="" class="img rounded" width="100%">
                    <div class="card-body">
                        <div class="">
                            <p class="h4 font-weight-bold">Nama Caleg</p>
                            <h5 class="mt-3">{{ auth()->user()->nama_caleg }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Nama Lengkap</p>
                            <h5 class="mt-3">{{ auth()->user()->nama_lengkap }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Legislatif</p>
                            <h5 class="mt-3">{{ auth()->user()->legislatif->nama_legislatif }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Alamat</p>
                            <h5 class="mt-3">{{ auth()->user()->alamat }}</h5>

                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Nomor HP</p>
                            <h5 class="mt-3">{{ auth()->user()->no_hp }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Email</p>
                            <h5 class="mt-3">{{ auth()->user()->email }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="text-primary font-weight-bold">My Profile</h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div style="overflow: hidden; width: 75%">
                <div class="card text-center" style="width: 50%; ">
                    <img src="{{ asset("public/".auth()->user()->foto_user) }}" alt="" class="img rounded" width="100%">
                    <div class="card-body">
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Nama Lengkap</p>
                            <h5 class="mt-3">{{ auth()->user()->nama_lengkap }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Nomor HP</p>
                            <h5 class="mt-3">{{ auth()->user()->no_telp }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Email</p>
                            <h5 class="mt-3">{{ auth()->user()->email }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Username</p>
                            <h5 class="mt-3">{{ auth()->user()->email }}</h5>
                        </div>
                        <div class="mt-4">
                            <p class="h4 font-weight-bold">Level</p>
                            <h5 class="mt-3">{{ auth()->user()->level }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection
