@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="col-md-3">
    </div>
    <div class="card-header py-3">
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Create
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex justify-content-between flex-column flex-md-row">
                <div>
                  <form action="" method="GET" class="d-block mb-2">
                  @if (request()->has("search"))
                  <input type="hidden" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
                  @endif
                  <span class="d-block">Data Per Page</span>
                    <input type="number" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                    <datalist id="paginates">
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="75">75</option>
                      <option value="100">100</option>
                    </datalist>
                  </form>
                </div>
                <div>
                  <form action="" method="GET" class="d-block mb-2" onsubmit="return !/[^\w\d@\s]/gi.test(this['search'].value)">
                    @if (request()->has("paginate"))
                    <input type="hidden" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                    @endif
                    <span class="d-block">Search</span>
                    <input type="text" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
                  </div>
                </form>
              </div>
                {{ $data->links() }}
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>Pertanyaan</th>
                        <th>Survey</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @auth("web")
                                <td>{{ $item->caleg->nama_caleg }}</td>
                                @endauth
                                <td>{{ $item->pertanyaan }}</td>
                                <td>{{ $item->survey->nama_survey}}</td>
                                <td class="d-flex justify-content-center">
                                   <button type="button" class="btn btn-warning mx-3 getData" value="{{ $item->id_variabel }}" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                       <i class="fas fa-edit"></i>
                                   </button>
                                   <form action="{{ asset("survey/VariableSurvey/" . $item->id_variabel) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Variabel {{ $item->nama_variabel }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Create Hasil Survey --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Data Variable Survey</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <form action="{{ asset('survey/VariableSurvey') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="pertanyaan" class="form-label">Nama Variable</label>
                    <input type="text" class="form-control" name="pertanyaan" id="pertanyaan" placeholder="Masukan Pertanyaan">
                </div>
                <div class="form-group">
                    <label for="data">Data Survey</label>
                    <select class="form-select form-control" name="id_survey" id="id_survey">
                        @foreach ($survey as $item)
                            @if (old('id_survey') == $item->id_survey)
                                <option value="{{ $item->id_survey }}" selected>{{ $item->nama_survey }}</option>
                            @endif
                            <option value="{{ $item->id_survey }}">{{ $item->nama_survey }}</option>
                        @endforeach
                    </select>
                </div>
            @auth("web")
                <div class="mb-3">
                    <label for="legislatif" class="form-label">Calon Legislatif</label>
                    <select class="form-select form-control" name="id_caleg" id="id_caleg">
                        @foreach ($caleg as $item)
                        @if (old('id_caleg')==$item->id_caleg)
                            <option value="{{ $item->id_caleg }}" selected>{{ $item->nama_caleg }}</option>
                        @else
                            <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                        @endif
                        @endforeach
                      </select>
                </div>
                @endauth
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
</div>

{{-- Modal Update Hasil Survey --}}
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Update Data Variable Survey</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <form action="" method="POST" id="edit_form">
            <div class="modal-body">
            @method('put')
            @csrf
                <div class="mb-3">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control" name="pertanyaan" id="edit_pertanyaan" placeholder="Masukan Pertanyaan Yang Ingin diubah">
                </div>
                <div class="form-group">
                    <label for="edit_data">Data Survey</label>
                    <select class="form-select form-control" name="id_survey" id="edit_survey">
                        @foreach ($survey as $item)
                            @if (old('id_survey') == $item->id_survey)
                                <option value="{{ $item->id_survey }}" selected>{{ $item->nama_survey }}</option>
                            @endif
                            <option value="{{ $item->id_survey }}">{{ $item->nama_survey }}</option>
                        @endforeach
                    </select>
                </div>
            @auth("web")
                <div class="mb-3">
                    <label for="legislatif" class="form-label">Calon Legislatif</label>
                    <select class="form-select form-control" name="id_caleg" id="edit_id_caleg">
                        @foreach ($caleg as $item)
                        @if (old('id_caleg')==$item->id_caleg)
                            <option value="{{ $item->id_caleg }}" selected>{{ $item->nama_caleg }}</option>
                        @else
                            <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                        @endif
                        @endforeach
                      </select>
                </div>
                @endauth
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section("script")
  <script>
  $(document).ready(function() {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

  let getData = e => {
    $.ajax({
        url: `{{ asset('survey/VariableSurvey') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('survey/VariableSurvey/${resp.id_variabel}') }}`)
            $("#edit_pertanyaan").val(resp.pertanyaan);
            @auth("web")
            $("#edit_id_caleg").val(resp.id_caleg)
            @endauth
            $("#edit_survey").val(resp.id_survey);
        }
      })
  }

  $(".getData").on("click", getData);
  })
  </script>
@endsection
