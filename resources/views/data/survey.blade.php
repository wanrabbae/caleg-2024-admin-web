@extends('layouts.admin')
@section('content')
{{-- @dd($data) --}}
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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>Nama Survey</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                        <th>Indikator</th>
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
                                <td>{{ $item->variable->nama_variabel }}</td>
                                <td class="d-flex justify-content-center">
                                   <button type="button" class="btn btn-warning mx-3" onclick="DataSurvey({{ $item->id_survey }})" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                   <form action="/survey/inputSurvey/{{ $item->id_survey }}" method="post" class="d-inline">
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
                <div class="mb-3">
                    <label for="indikator" class="form-label">Indikator</label>
                    <select class="form-select form-control" name="id_variabel" id="indikator">
                        @foreach ($variabel as $item)
                        @if (old('id_variabel')==$item->id_variabel)
                            <option value="{{ $item->id_variabel }}" selected>{{ $item->nama_variabel}}</option>
                        @else
                            <option value="{{ $item->id_variabel }}">{{ $item->nama_variabel }}</option>
                        @endif
                        @endforeach
                      </select>
                </div>
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
                <div class="mb-3">
                    <label for="id_variabel" class="form-label">Indikator</label>
                    <select name="id_variabel" id="edit_variabel" class="form-select form-control">
                        @foreach ($variabel as $item)
                        @if (old('id_variabel')==$item->id_variabel)
                            <option value="{{ $item->id_variabel }}" selected >{{ $item->nama_variabel }}</option>
                        @else
                            <option value="{{ $item->id_variabel }}">{{ $item->nama_variabel }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="/js/value.js"></script>
@endsection
