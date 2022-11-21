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
                        <th>Nama Survey</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                        <th>Aktif</th>
                        <th>Hasil</th>
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
                                <td>{{ $item->nama_survey }}</td>
                                <td>{{ $item->mulai_tanggal }}</td>
                                <td>{{ $item->sampai_tanggal }}</td>
                                <td>
                                    @if ($item->aktif == "N")
                                        <form action="{{ asset('survey/inputSurvey/' . $item->id_survey) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <button type="submit" class="btn btn-danger d-flex justify-content-center" value="{{ $item->aktif }}" name="aktif">
                                                {{ $item->aktif }}
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ asset('survey/inputSurvey/' . $item->id_survey) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <button type="submit" class="btn btn-success" name="aktif" value="{{ $item->aktif }}">
                                                {{ $item->aktif }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ asset('survey/HasilSurvey') }}" target="_blank" method="POST">
                                        @csrf
                                        <button class="btn btn-primary" value="{{ $item->id_survey }}" name="survey">
                                            Hasil
                                        </button>
                                    </form>
                                </td>
                                <td class="d-flex justify-content-center">
                                   <button type="button" class="btn btn-warning mx-3 getData" value="{{ $item->id_survey }}" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                   <form action="{{ asset('survey/inputSurvey/' . $item->id_survey) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Survey {{ $item->nama_survey }}')">
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

{{-- Modal Create Variable --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Data Hasil Survey</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <form action="{{ asset('survey/inputSurvey') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama_survey" class="form-label">Nama Survey</label>
                    <input type="text" class="form-control" id="nama_survey" name="nama_survey"  placeholder="Nama Survey">
                </div>
                <div class="mb-3">
                    <label for="mulai_tgl" class="form-label">Mulai Tanggal</label>
                    <input type="date" class="form-control" id="mulai_tgl" name="mulai_tanggal"  placeholder="Mulai Tanggal">
                </div>
                <div class="mb-3">
                    <label for="sampai_tgl" class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control" id="sampai_tgl" name="sampai_tanggal"  placeholder="Sampai Tanggal">
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
          <h5 class="modal-title" id="exampleModalLabel">Update Data Survey</h5>
          <span aria-hidden="true">&times;</span>
        </div>
        <form action="" method="post" id="edit_form">
            @method('put')
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama_survey" class="form-label">Nama Survey</label>
                    <input type="text" name="nama_survey" id="edit_survey" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="mulai_tanggal" class="form-label">Mulai Tanggal</label>
                    <input type="date" name="mulai_tanggal" id="edit_mulai" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sampai_tangal" class="form-label">Sampai Tanggal</label>
                    <input type="date" name="sampai_tanggal" id="edit_sampai" class="form-control">
                </div>
                @auth("web")
                <div class="mb-3">
                    <label for="id_caleg" class="form-label">Calon Legislatif</label>
                    <select name="id_caleg" id="edit_caleg" class="form-select form-control">
                        @foreach ($caleg as $item)
                        @if (old('id_caleg')==$item->id_caleg)
                            <option value="{{ $item->id_caleg }}" selected >{{ $item->nama_caleg }}</option>
                        @else
                            <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                @endauth
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
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
        url: `{{ asset('survey/inputSurvey') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('survey/inputSurvey/${resp.id_survey}') }}`)
            $("#edit_survey").val(resp.nama_survey)
            $("#edit_mulai").val(resp.mulai_tanggal)
            $("#edit_sampai").val(resp.sampai_tanggal)
            @auth("web")
            $("#edit_caleg").val(resp.id_caleg)
            @endauth
        } 
      })
  }

  $(".getData").on("click", getData);
  })
</script>
@endsection