@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="text-primary font-weight-bold">My Profile</h4>
    </div>
    <div class="card-body">
        <div class="">
            <h2>Nama Caleg</h2>
            <h5>{{ auth()->user()->nama_caleg }}</h5>
        </div>  
        <div class="mt-4">
            <h2>Nama Lengkap</h2>
            <h5>{{ auth()->user()->nama_lengkap }}</h5>
        </div>  
        <div class="mt-4">
            <h2>Legislatif</h2>
            <h5>{{ auth()->user()->legislatif->nama_legislatif }}</h5>
        </div>  
        <div class="mt-4">
            <h2>Alamat</h2>
            <h5>{{ auth()->user()->alamat }}</h5>
            
        </div>  
        <div class="mt-4">
            <h2>Nomor HP</h2>
            <h5>{{ auth()->user()->no_hp }}</h5>
        </div>  
        <div class="mt-4">
            <h2>Email</h2>
            <h5>{{ auth()->user()->email }}</h5>
        </div>  
        <div class="mt-4">
            <h2>Partai</h2>
            <div class="d-flex justify-content-between">
                <h5>{{ auth()->user()->partai->nama_partai }}</h5>
                <img src="{{ auth()->user()->partai->logo }}" alt="" class="img-fluid rounded w-25 h-25">
            </div>
        </div>  
        <div class="mt-4">
            <h2>Foto</h2>
            <div class="d-flex justify-content-between">
                <img src="{{ auth()->user()->foto }}" alt="" class="img-fluid rounded w-25 h-25">
            </div>
        </div>  
    </div>
</div>
@endsection
