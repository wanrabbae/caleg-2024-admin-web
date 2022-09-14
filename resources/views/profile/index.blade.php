@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="text-primary font-weight-bold">My Profile</h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div style="overflow: hidden; width: 75%">
                <div class="card text-center" style="width: 50%; ">
                    <img src="{{ auth()->user()->foto }}" alt="" class="img rounded" width="100%">
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
        {{-- <div class="">
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
        <div class="mt-4">
            <p class="h4 font-weight-bold">Partai</p>
            <div class="d-flex justify-content-between">
                <h5>{{ auth()->user()->partai->nama_partai }}</h5>
                <img src="{{ auth()->user()->partai->logo }}" alt="" class="img-fluid rounded w-25 h-25">
            </div>
        </div>
        <div class="mt-4">
            <p class="h4 font-weight-bold">Foto</p>
            <div class="d-flex justify-content-between">
                <img src="{{ auth()->user()->foto }}" alt="" class="img-fluid rounded w-25 h-25">
            </div>
        </div> --}}

    </div>
</div>
@endsection
