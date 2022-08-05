@extends("layouts.admin")

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Partai</h6>
    </div>
    <div class="card-body">
        <form action="/dashboard/partai/{{ $dataArr->id_partai }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="nama_partai">Nama Partai</label>
                <input type="text" class="form-control" id="nama_partai" value="{{ $dataArr->nama_partai }}" placeholder="Nama Partai" name="nama_partai">
              </div>
              <div class="form-group">
                <label for="warna">Warna</label>
                <input type="color" class="form-control" id="warna" name="warna" value="{{ $dataArr->warna }}">
              </div>
              <div class="form-group">
                <label for="no_urut">No Urut</label>
                <input type="number" class="form-control" id="no_urut" value="{{ $dataArr->no_urut }}" placeholder="No Urut" name="no_urut">
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