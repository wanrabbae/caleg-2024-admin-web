@extends('layouts.admin')

@section("content")

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i>
            Invoice
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
                        <th>Code</th>
                        <th>Caleg</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach($data as $data)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $data->no_invoice }}</td>
                          <td>{{ $data->caleg->nama_caleg }}</td>
                          <td>
                            <form action="{{ asset("invoices/$data->id_invoice") }}" method="POST" class="d-inline">
                                @method('put')
                                @csrf
                                <button type="submit" class="btn @if ($data->tanggal_bayar != null) btn-success @else btn-danger @endif" name="tanggal_bayar" value="{{ $data->tanggal_bayar != null ? "Y" : "N" }}">
                                    {{ $data->tanggal_bayar != null ? "Y" : "N" }}
                                </button>
                            </form>
                          </td>
                          <td>{{ $data->created_at }}</td>
                          <td class="d-flex justify-content-center">
                            @if ($data->tanggal_bayar != null)
                                <form action="{{ asset("invoices/show?type=receipt") }}" method="POST" class="d-inline" target="_blank">
                                    @csrf
                                    <button type="submit" class="btn btn-success mx-3" name="id_caleg" value="{{ $data->id_caleg }}">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ asset("invoices/show?type=invoice") }}" method="POST" class="d-inline" target="_blank">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" name="id_caleg" value="{{ $data->id_caleg }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </form>
                                <button class="btn btn-warning mx-3 getData" value="{{ $data->id_invoice }}" data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ asset("invoices/" . $data->id_invoice) }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah E-Wallet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset("invoices") }}" method="POST">
        <div class="modal-body">
                 @csrf
                 <div class="mb-3">
                    <label for="id_caleg" class="form-label">Caleg</label>
                    <select name="id_caleg" id="id_caleg" class="form-select form-control">
                        @foreach ($caleg as $item)
                            <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                        @endforeach
                    </select>
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
          <h5 class="modal-title" id="editModalLabel">Edit wallet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
            @method('put')
            @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit_id_caleg" class="form-label">Caleg</label>
                <select name="id_caleg" id="edit_id_caleg" class="form-select form-control">
                    @foreach ($caleg as $item)
                        <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                    @endforeach
                </select>
            </div>
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
        url: `{{ asset('invoices') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        success: resp => {
          console.log(resp)
            $("#edit_form").attr("action", `{{ asset('invoices/${resp.id_invoice}') }}`)
            $("#edit_id_caleg").val(resp.id_caleg)
        },
      })
  }

  $(".getData").on("click", getData);
  })
  </script>
  @endsection