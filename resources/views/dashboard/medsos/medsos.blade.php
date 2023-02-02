@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Medsos
            </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
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
                        <th>Tipe</th>
                        <th>Nama Medsos</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->type }}</td>
                                <td>
                                <a href="https://{{ $data->link_medsos }}" target="_blank" class="btn btn-primary">
                                  {{ $data->nama_medsos }}
                                </a>
                                </td>
                                @auth("web")
                                <td>{{ $data->caleg->nama_caleg }}</td>
                                @endauth
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3 getData" value={{ $data->id_medsos }} data-target="#editModal" data-toggle="modal">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                    <form action="{{ asset('dashboard/medsos/' . $data->id_medsos) }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Medsos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset('dashboard/medsos') }}" method="POST">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="type">Tipe Medsos</label>
                    <select class="form-control" name="type" id="type">
                      <option value="Facebook">Facebook</option>
                      <option value="Instagram">Instagram</option>
                      <option value="Twitter">Twitter</option>
                      <option value="Website">Website</option>
                      <option value="Snapchat">Snapchat</option>
                      <option value="Tiktok">Tiktok</option>
                      <option value="Youtube">Youtube</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="medsos">Nama Medsos</label>
                  <input type="text" class="form-control" id="medsos" placeholder="Nama Medsos" name="nama_medsos">
                </div>
                <div class="form-group">
                  <label for="link">Link Medsos</label>
                  <input type="text" class="form-control" id="link" placeholder="Link Medsos" name="link_medsos">
                </div>
                @auth("web")
                <div class="form-group">
                  <label for="id_caleg">Pilih Caleg</label>
                    <select class="form-control" name="id_caleg" id="id_caleg">
                      @foreach ($caleg as $item)
                          <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                      @endforeach
                  </select>
                </div>
                @endauth
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
          <h5 class="modal-title" id="editModalLabel">Edit Medsos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="edit_form" method="POST">
            <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="edit_type">Tipe Medsos</label>
                    <select class="form-control" name="type" id="edit_type">
                      <option value="Facebook">Facebook</option>
                      <option value="Instagram">Instagram</option>
                      <option value="Twitter">Twitter</option>
                      <option value="Website">Website</option>
                      <option value="Snapchat">Snapchat</option>
                      <option value="Tiktok">Tiktok</option>
                      <option value="Youtube">Youtube</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_nama_partai">Nama Medsos</label>
                    <input type="text" class="form-control edit" id="edit_nama_medsos" placeholder="Nama Partai" name="nama_medsos">
                </div>
                <div class="form-group">
                  <label for="edit_link_medsos">Link Medsos</label>
                  <input type="text" class="form-control" id="edit_link_medsos" placeholder="Link Medsos" name="link_medsos">
                </div>
                @auth("web")
                <div class="form-group">
                  <label for="id_caleg">Pilih Caleg</label>
                  <select class="form-control" name="id_caleg" id="edit_id_caleg">
                    @foreach ($caleg as $item)
                    <option value="{{ $item->id_caleg }}">{{ $item->nama_caleg }}</option>
                    @endforeach
                  </select>
                </div>
                @endauth
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

  let getData = e => {
    $.ajax({
        url: `{{ asset('dashboard/medsos') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('dashboard/medsos/${resp.id_medsos}') }}`);
            $("#edit_nama_medsos").val(resp.nama_medsos);
            $("#edit_type").val(resp.type);
            $("#edit_link_medsos").val(resp.link_medsos);
            @auth("web")
            $("#edit_id_caleg").val(resp.id_caleg);
            @endauth
        } 
      })
  }

  $(".getData").on("click", getData);
})
</script>
@endsection