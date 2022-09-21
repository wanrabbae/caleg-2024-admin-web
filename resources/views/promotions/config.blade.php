@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
  <div class="card-header py-3">
        <h3 class="text-primary">Setting Blast</h3>
    </div>
    <div class="card-body">
    <form action="/setting/{{ auth()->user()->id_caleg }}" method="POST" enctype="multipart/form-data">
    @method("put")
    @csrf
    <h5 class="text-primary">Setting WA Blas</h5>
    <div class="row">
        <div class="col-md-12 mb-2">
            <p>API Key</p>
            <input type="text" class="form-control" value="{{ auth()->user()->config->API_KEY }}" name="nama_caleg">
        </div>
        <div class="col-md-12 mb-2">
            <p>ID Device</p>
            <input type="text" class="form-control" value="{{ auth()->user()->config->device_id }}" name="nama_caleg">
        </div>
    </div>
    </form>
    </div>
    <div class="card-body">
    <form action="/setting/{{ auth()->user()->id_caleg }}" method="POST" enctype="multipart/form-data">
    @method("put")
    @csrf
    <h5 class="text-primary">Setting Email Blas</h5>
    <div class="row">
        <div class="col-md-12 mb-2">
            <p>API Key</p>
            <input type="text" class="form-control" value="{{ auth()->user()->config->API_KEY }}" name="nama_caleg">
        </div>
        <div class="col-md-12 mb-2">
            <p>ID Device</p>
            <input type="text" class="form-control" value="{{ auth()->user()->config->device_id }}" name="nama_caleg">
        </div>
        <div class="col-md-3 mt-4">
            <button class="btn btn-primary w-100">Save</button>
        </div>
    </div>
    </form>
    </div>
</div>
@endsection
