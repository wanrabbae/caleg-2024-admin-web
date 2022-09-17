@extends("layouts.admin")

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Medsos</h6>
    </div>
    <div class="card-body">
        <form action="/dashboard/medsos/{{ $dataArr->id_medsos }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="nama_medsos">Nama Medsos</label>
                <input type="text" class="form-control" id="nama_medsos" value="{{ $dataArr->nama_medsos }}" placeholder="Nama medsos" name="nama_medsos">
              </div>
              <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control-file" id="logo" name="logo">
                <img src="{{ asset('storage/' . $dataArr->logo) }}" alt="" class="my-2" id="preview">
              </div>
            </div>
            <button class="btn btn-primary col-md-2 ml-4 my-4" type="submit">
                Update
            </button>
          </form>
    </div>
    <script>
        logo.addEventListener("change", e => {
            let fileReader = new FileReader();
            let preview = document.getElementById("preview");
            let logo = document.getElementById("logo");
            fileReader.onload = e => {
                preview.src = e.target.result
            }
            
            fileReader.readAsDataURL(document.getElementById("logo").files[0])
        })
    </script>
@endsection