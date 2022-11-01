@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="col-md-3">
    </div>
    <div class="card-header py-3">
        {{-- <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Isu
        </button> --}}
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
            {{ $dataArr->links() }}
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>Jenis</th>
                        <th>Dampak</th>
                        <th>Tanggal</th>
                        <th>Kecamatan</th>
                        <th>Pelapor</th>
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Di Tanggapi</th>
                        <th>Tanggapan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $i => $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            @auth("web")
                            <td>
                                {{ $data->caleg->nama_caleg }}
                            </td>
                            @endauth
                            <td>
                                {{ $data->jenis == "L" ? "Isu Lapangan" : "Isu Online" }}
                            <td>
                                {{ $data->dampak == "P" ? "Positif" : "Negatif" }}
                            </td>
                            <td>
                                {{ $data->tanggal }}
                            </td>
                            <td>
                                {{ $data->kecamatan->nama_kecamatan }}
                            </td>
                            <td>
                                {{ $data->relawan->nama_relawan }}
                            </td>
                            <td>
                                {{ $data->keterangan }}
                            </td>
                            <td>
                              <a href="{{ asset("infoPolitik/daftarIsu?download=$data->id_isu") }}">
                                <button type="submit" class="btn btn-primary mr-4">
                                    <i class="fas fa-download"></i>
                                </button>
                            </a>
                            </td>
                            <td>
                                @if ($data->tanggapi == "N")
                                    <button class="btn btn-primary getTanggapan" value="{{ $data->id_isu }}" data-toggle="modal" data-target="#tanggapiModal">
                                        Tanggapi
                                    </button>
                                @else
                                 <form action="{{ asset("infoPolitik/daftarIsu/" . $data->id_isu) }}" method="POST">
                                    @method("put")
                                    @csrf
                                    <button class="btn btn-success" type="submit" name="unrespond">
                                        Ditanggapi
                                    </button>
                                </form>
                                @endif
                        </td>
                            <td>
                                {{ $data->tanggapan }}
                            </td>
                            <td class="d-flex justify-content-center">
                                    @if ($data->tanggapi != "N")
                                    <button class="btn btn-warning mx-3 getData" value="{{ $data->id_isu }}" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @endif
                                    <form action="/infoPolitik/daftarIsu/{{ $data->id_isu }}" method="POST" class="d-inline">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
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

{{-- Tanggapi Modal --}}
  <div class="modal fade" id="tanggapiModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Tanggapi Berita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
        <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="tanggapan">Tanggapan</label>
                  <textarea type="text" class="form-control" id="tanggapan" placeholder="Tanggapan" name="btn_tanggapan" rows="5"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Tanggapi</button>
                </a>
              </div>
            </form>
      </div>
    </div>
  </div>
  
  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Tanggapan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form_2">
        <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="tanggapan">Tanggapan</label>
                  <textarea type="text" class="form-control" id="edit_tanggapan" placeholder="Tanggapan" name="btn_tanggapan" rows="5"></textarea>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Edit</button>
                </a>
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

  let getTanggapan = e => {
    $("#edit_form").attr("action", `{{ asset('infoPolitik/daftarIsu/${e.currentTarget.value}') }}`)
  }

  let getData = e => {
    $.ajax({
        url: `{{ asset('infoPolitik/daftarIsu') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form_2").attr("action", `{{ asset('infoPolitik/daftarIsu/${resp.id_isu}') }}`);
            $("#edit_tanggapan").val(resp.tanggapan)
        } 
      })
  }

  $(".getTanggapan").on("click", getTanggapan);
  $(".getData").on("click", getData);
  })
</script>
@endsection