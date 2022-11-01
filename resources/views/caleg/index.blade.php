@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Caleg
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
                    {{ $dataArr->links() }}
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Demo</th>
                            <th>Nama Caleg</th>
                            <th>Nama Lengkap</th>
                            <th>Legislatif</th>
                            <th>Wilayah</th>
                            <th>Dapil</th>
                            <th>Downline</th>
                            <th>Level</th>
                            <th>Alamat</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Partai</th>
                            <th>Aktif</th>
                            <th>Username</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dataArr->count())
                            @foreach ($dataArr as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <form action="{{ asset("caleg/" . $data->id_caleg) }}" method="POST">
                                            @method("put")
                                            @csrf
                                            <button class="btn @if ($data->demo == 'Y') btn-success @else btn-danger @endif" type="submit" value="{{ $data->demo }}" name="demo">
                                                {{ $data->demo }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>{{ $data->nama_caleg }}</td>
                                    <td>{{ $data->nama_lengkap }}</td>
                                    <td>{{ $data->legislatif->nama_legislatif }}</td>
                                    <td>{{ $data->legislatif->type == "Provinsi" ? $data->provinsi->nama_provinsi : $data->kabupaten->nama_kabupaten }}</td>
                                    <td>{{ $data->dapil }}</td>
                                    <td>{{ $data->downline }}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#editLevelModal" class="getLevel btn @if ($data->level == 'Basic') btn-primary @endif @if ($data->level == "Gold") btn-warning @endif @if ($data->level == "Platinum") btn-secondary @endif @if ($data->level == "Custom") btn-success @endif" type="button" value="{{ $data->id_caleg }}">
                                            {{ $data->level }}
                                        </button>
                                    </td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->no_hp }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->partai->nama_partai }}</td>
                                    <td>
                                        <form action="{{ asset("caleg/" . $data->id_caleg) }}" method="POST">
                                            @method("put")
                                            @csrf
                                            <button class="btn @if ($data->aktif == 'Y') btn-success @else btn-danger @endif" type="submit" value="{{ $data->aktif }}" name="aktif">
                                                {{ $data->aktif }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>{{ $data->username }}</td>
                                    <td>
                                        @if (File::exists($data->foto))
                                            <img src="{{ asset($data->foto) }}" alt="" class="mx-auto d-block" style="width: 75px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-warning mx-3 getData" value="{{ $data->id_caleg }}" data-target="#editModal" data-toggle="modal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ asset("caleg/" . $data->id_caleg) }}" method="POST" class="d-inline">
                                            @method('delete')
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Caleg</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ asset("caleg") }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="demo">Demo Status</label>
                            <select class="form-control" name="demo" value="{{ old('demo') }}" id="demo">
                                <option value="Y" selected>Y</option>
                                <option value="N">N</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_caleg">Nama Caleg</label>
                            <input type="text" class="form-control" name="nama_caleg" value="{{ old('nama_caleg') }}" id="nama_caleg" placeholder="Nama Caleg">
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" id="nama_lengkap" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="id_legislatif">Pilih Legislatif</label>
                            <select class="form-control" name="id_legislatif" value="{{ old('id_legislatif') }}" id="id_legislatif">
                                <option value="">Pilih Legislatif</option>
                                @foreach ($legislatif as $item)
                                <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" name="level" id="level">
                                <option value="Basic">Basic</option>
                                <option value="Gold">Gold</option>
                                <option value="Platinum">Platinum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" id="alamat" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Phone</label>
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" id="no_hp" placeholder="Nomor HP">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="id_partai">Pilih Partai</label>
                            <select class="form-control" name="id_partai" value="{{ old('id_partai') }}" id="id_partai">
                                @foreach ($partai as $item)
                                <option value="{{ $item->id_partai }}">{{ $item->nama_partai }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="aktif">Aktif</label>
                            <select class="form-control" name="aktif" id="aktif" value="{{ old('aktif') }}">
                                <option value="Y">Aktif</option>
                                <option value="N">Nonaktif</option>
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Diri</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
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
          <h5 class="modal-title" id="editModalLabel">Edit Caleg</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" id="edit_form">
            <div class="modal-body">
                @method("put")
                @csrf
                <div class="form-group">
                    <label for="nama_caleg">Nama Caleg</label>
                    <input type="text" class="form-control" name="nama_caleg" id="edit_nama_caleg" placeholder="Nama Caleg">
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="edit_nama_lengkap" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="id_legislatif">Pilih Legislatif</label>
                    <select class="form-control" name="id_legislatif" id="edit_id_legislatif">
                        <option value="">Pilih Legislatif</option>
                        @foreach ($legislatif as $item)
                        <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="edit_alamat" placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="no_hp">Phone</label>
                    <input type="text" class="form-control" name="no_hp" id="edit_no_hp" placeholder="Nomor HP">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="edit_email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="id_partai">Pilih Partai</label>
                    <select class="form-control" name="id_partai" id="edit_id_partai">
                        @foreach ($partai as $item)
                        <option value="{{ $item->id_partai }}">{{ $item->nama_partai }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="aktif">Aktif</label>
                    <select class="form-control" name="aktif" id="edit_aktif">
                        <option value="Y">Aktif</option>
                        <option value="N">Nonaktif</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="edit_username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="edit_password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="foto">Foto Diri</label>
                    <input type="file" class="form-control-file" id="edit_foto" name="foto">
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

  {{-- Level Modal --}}
<div class="modal fade" id="editLevelModal" tabindex="-1" role="dialog" aria-labelledby="createLevelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Edit Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="form_edit_level">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="level">Edit Level</label>
                        <select class="form-control" name="level" id="edit_level">
                            <option value="Basic">Basic</option>
                            <option value="Gold">Gold</option>
                            <option value="Platinum">Platinum</option>
                        </select>
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
        url: `{{ asset('caleg') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('caleg/${resp.id_caleg}') }}`)
            $("#edit_nama_caleg").val(resp.nama_caleg)
            $("#edit_nama_lengkap").val(resp.nama_lengkap)
            $("#edit_id_legislatif").val(resp.id_legislatif)
            $("#edit_alamat").val(resp.alamat)
            $("#edit_no_hp").val(resp.no_hp)
            $("#edit_email").val(resp.email)
            $("#edit_id_partai").val(resp.id_partai)
            $("#edit_username").val(resp.username)
            
        } 
      })
  }

  let getDapil = e => {
            $.ajax({
                url: `{{ asset('dashboard/dapil') }}`,
                method: "POST",
                data : {
                    getData: true,
                    data: e.currentTarget.value,
                    id: e.currentTarget.id
                },
                dataType: "json",
                success: resp => {
                    if (!e.currentTarget.id.includes("edit")) {
                        $("#dapil").html(resp)
                    } else {
                        $("#edit_dapil").html(resp)
                    }
                },
            })
        }

  let getKab = e => {
            $.ajax({
                url: `{{ asset('dashboard/kabupaten') }}`,
                method: "POST",
                data : {
                    getData: true,
                    data: e.currentTarget.value
                },
                dataType: "json",
                success: resp => {
                    if (!e.currentTarget.id.includes("edit")) {
                        $("#kabupaten").html(resp)
                    } else {
                        $("#edit_kabupaten").html(resp)
                    }
                }
            })
        }

        let getProv = e => {
            $.ajax({
                url: `{{ asset('dashboard/provinsi') }}`,
                method: "POST",
                data : {
                    getData: true,
                    data: e.currentTarget.value
                },
                dataType: "json",
                success: resp => {
                    let text = "";
                    if (!e.currentTarget.id.includes("edit")) {
                        if ($("#provinsi")) {
                            $("#provinsi").parent().remove();
                        }
                        if ($("#kabupaten")) {
                            $("#kabupaten").parent().remove();
                        }
                        if ($("#dapil")) {
                            $("#dapil").parent().remove();
                        }
                        text = `
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <select name="id_provinsi" class="form-control" id="provinsi" value="{{ old('provinsi') }}" aria-describedby="provinsi">
                                <option value="" selected>Pilih Provinsi</option>
                                ${resp[1]}
                            </select>
                        </div>
                        `

                        if (resp[0] == "Provinsi") {
                            text += `
                            <div class="form-group">
                                <label for="dapil">Dapil</label>
                                <select name="dapil" class="form-control" id="dapil" value="{{ old('dapil') }}" aria-describedby="dapil">
                                    <option value="" selected>Pilih Provinsi Dahulu</option>
                                </select>
                            </div>`
                        }
                    
                        if (resp[0] == "Kabupaten") {
                            text += `
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select name="id_kabupaten" class="form-control" id="kabupaten" value="{{ old('kabupaten') }}" aria-describedby="kabupaten">
                                    <option value="" selected>Pilih Kabupaten</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="dapil">Dapil</label>
                                <select name="dapil" class="form-control" id="dapil" value="{{ old('dapil') }}" aria-describedby="dapil">
                                    <option value="" selected>Pilih Kecamatan Dahulu</option>
                                </select>
                            </div>
                            `
                        }
                        $("#id_legislatif").parent().after(text)
                    } else {
                        if ($("#edit_provinsi")) {
                            $("#edit_provinsi").parent().remove();
                        }
                        if ($("#edit_kabupaten")) {
                            $("#edit_kabupaten").parent().remove();
                        }
                        if ($("#edit_dapil")) {
                            $("#edit_dapil").parent().remove();
                        }
                        text = `
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select name="id_provinsi" class="form-control" id="edit_provinsi" value="{{ old('provinsi') }}" aria-describedby="provinsi">
                                    <option value="" selected>Pilih Provinsi</option>
                                    ${resp[1]}
                                </select>
                            </div>
                        `

                        if (resp[0] == "Provinsi") {
                        text += `
                            <div class="form-group">
                                <label for="dapil">Dapil</label>
                                <select name="dapil" class="form-control" id="edit_dapil" value="{{ old('dapil') }}" aria-describedby="dapil">
                                    <option value="" selected>Pilih Provinsi Dahulu</option>
                                </select>
                            </div>`
                        }

                        if (resp[0] == "Kabupaten") {
                            text += `
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten</label>
                                    <select name="id_kabupaten" class="form-control" id="edit_kabupaten" value="{{ old('kabupaten') }}" aria-describedby="kabupaten">
                                        <option value="" selected>Pilih Kabupaten</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="dapil">Dapil</label>
                                    <select name="dapil" class="form-control" id="edit_dapil" value="{{ old('dapil') }}" aria-describedby="dapil">
                                        <option value="" selected>Pilih Kecamatan Dahulu</option>
                                    </select>
                                </div>
                            `
                        }
                        $("#edit_id_legislatif").parent().after(text)
                    }
                    if (resp[0] == "Provinsi") {
                        $("#provinsi").off().on("change", getDapil)
                        $("#edit_provinsi").off().on("change", getDapil)
                    }

                    if (resp[0] == "Kabupaten") {
                        $("#provinsi").off().on("change", getKab)
                        $("#edit_provinsi").off().on("change", getKab)
                        $("#kabupaten").off().on("change", getDapil);
                        $("#edit_kabupaten").off().on("change", getDapil);
                    }
                },
            })
        }

        let getLevel = e => {
            $.ajax({
            url: `{{ asset('caleg') }}`,
            method: "POST",
            data: {
                getLevel: true,
                data: e.currentTarget.value
            },
            dataType: "json",
            success: resp => {
                $("#form_edit_level").attr("action", `{{ asset('caleg/${resp.id_caleg}') }}`)
                $("#edit_level").val(resp.level)
            } 
        })
        }

  $(".getData").on("click", getData);
  $("#id_legislatif").on("change", getProv);
  $("#edit_id_legislatif").on("change", getProv);
  $(".getLevel").on("click", getLevel);
  })
</script>
@endsection