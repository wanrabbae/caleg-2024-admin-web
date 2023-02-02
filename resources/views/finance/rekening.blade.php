@extends('layouts.admin')

@section("content")

<div class="card shadow mb-4">
    <div class="card-header py-3">
       @if ($dataArr->count() === 0)
        @if (!request()->has("paginate") && !request()->has("search"))
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i>
            Bank
          </button>
        @endif
        @endif
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
                        <th>Nama Bank</th>
                        <th>Nomor Bank</th>
                        <th>Pemilik Bank</th>
                        <th>Saldo Bank</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_bank }}</td>
                            <td>{{ $data->nomor_bank }}</td>
                            <td>{{ $data->pemilik_bank }}</td>
                            <td>Rp. {{ $data->saldo_bank }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-warning mx-3 getData" value="{{ $data->id_bank }}"  data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ asset("rekening/$data->id_bank") }}" method="POST" class="d-inline">
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

{{-- Modal Create --}}
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Tambah Bank</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset("rekening") }}" method="POST">
        <div class="modal-body">
                 @csrf
                <div class="form-group">
                  <label for="nama_bank">Nama Bank</label>
                  <input type="text" class="form-control" id="nama_bank" placeholder="Nama Bank" name="nama_bank">
                </div>
                <div class="form-group">
                  <label for="nomor_bank">Nomor Bank</label>
                  <input type="number" class="form-control" id="nomor_bank" placeholder="Nomor Bank" name="nomor_bank">
                </div>
                <div class="form-group">
                  <label for="pemilik_bank">Pemilik Bank</label>
                  <input type="text" class="form-control" id="pemilik_bank" placeholder="Pemilik Bank" name="pemilik_bank">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Tambah</button>
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
          <h5 class="modal-title" id="editModalLabel">Edit Bank</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
            @method('put')
            @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nama_bank">Nama Bank</label>
                <input type="text" class="form-control" id="edit_nama_bank" placeholder="Nama Bank" name="nama_bank">
              </div>
              <div class="form-group">
                <label for="nomor_bank">Nomor Bank</label>
                <input type="number" class="form-control" id="edit_nomor_bank" placeholder="Nomor Bank" name="nomor_bank">
              </div>
              <div class="form-group">
                <label for="pemilik_bank">Pemilik Bank</label>
                <input type="text" class="form-control" id="edit_pemilik_bank" placeholder="Pemilik Bank" name="pemilik_bank">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Update</button>
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

  let getData = e => {
    $.ajax({
        url: `{{ asset('rekening') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('rekening/${resp.id_caleg}') }}`)
            $("#edit_nama_bank").val(resp.nama_bank);
            $("#edit_nomor_bank").val(resp.nomor_bank);
            $("#edit_pemilik_bank").val(resp.pemilik_bank);
        } 
      })
  }

  $(".getData").on("click", getData);
  })
</script>
@endsection