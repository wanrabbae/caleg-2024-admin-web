{{-- DATA RELAWAN --}}
@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Relawan
            </button> --}}
            @auth("caleg")
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal">
                <i class="fas fa-book"></i>
                  Laporan Relawan
              </button>
            @endauth
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
                            <th>Nik</th>
                            <th>Nama Relawan</th>
                            <th>Downline</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Upline</th>
                            <th>Desa</th>
                            <th>Saksi</th>
                            <th>Kecamatan</th>
                            <th>TPS</th>
                            <th>Referral</th>
                            @auth("web")
                            <th>Caleg</th>
                            @endauth
                            <th>Status</th>
                            <th>No Hp</th>
                            <th>E-mail</th>
                            <th>Username</th>
                            <th>Blokir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count())
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nik }}</td>
                                    <td>
                                        <button class="text-nowrap getLoyalis btn @if ($data->loyalis == 1) btn-success @elseif ($data->loyalis == 2) btn-warning @else btn-danger @endif" value="{{ $data->id_relawan }}" data-toggle="modal" data-target="#editLoyalModal">
                                            {{ $data->nama_relawan }}
                                        </button>
                                    </td>
                                    <td>{{ $data->downlineRel->count() / $data->caleg->downline * 100 }}%</td>
                                    <td>{{ $data->jk }}</td>
                                    <td>
                                        <button class="btn btn-primary getJabatan" value="{{ $data->id_relawan }}" data-toggle="modal" data-target="#editJabatanModal">
                                            @if ($data->jabatan == 1)
                                            KoorDes
                                            @elseif ($data->jabatan == 2)
                                            KoorCam
                                            @else
                                            Simpatisan
                                            @endif
                                        </button>
                                    </td>
                                    <td>
                                        {{ $data->upline ?? "Tidak Ada"}}
                                    </td>
                                    <td>{{ $data->desa->nama_desa }}</td>
                                    <td>
                                        @if ($data->saksi == "N")
                                           <button type="button" class="btn btn-danger getTps" data-toggle="modal" data-target="#createTpsModal" value="{{ $data->id_relawan }}">
                                               {{ $data->saksi }}
                                           </button>
                                       @else
                                       <form action="{{ asset('team/' . $data->id_relawan) }}" method="POST">
                                           @method("put")
                                           @csrf
                                           <button class="btn btn-success" type="submit" value="{{ $data->saksi }}" name="saksi">
                                               {{ $data->saksi }}
                                           </button>
                                       </form>
                                       @endif
                                   </td>
                                    <td>{{ $data->desa->kecamatan->nama_kecamatan }}</td>
                                    <td>{{ $data->tps ?? "Tidak Ada" }}</td>
                                    <td>{{ $data->referal }}</td>
                                    @auth("web")
                                    <td>{{ $data->caleg->nama_lengkap ?? '' }}</td>
                                    @endauth
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->no_hp }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>
                                        <form action="{{ asset("team/" . $data->id_relawan) }}" method="POST">
                                        @method("put")
                                        @csrf
                                            <button type="submit" value="{{ $data->blokir }}" class="btn @if ($data->blokir == 'Y') btn-danger @else btn-success @endif" name="blokir">
                                                {{ $data->blokir }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <form action="{{ asset("team/upline") }}" method="POST">
                                            @csrf
                                            <button class="btn btn-info " type="submit" name="id" value="{{ $data->id_relawan }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-primary getData mx-3" value="{{ $data->id_relawan }}" data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ asset("team/" . $data->id_relawan) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini ?')" class="btn btn-danger ">
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

    <!--Modal Create Tps -->
    <div class="modal fade" id="createTpsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukkan TPS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="tps_form">
                            @method('put')
                            @csrf
                            <input type="hidden" name="saksi" value="N">
                            <h5 id="desatitle" class="text-center"></h5>
                            <div class="form-group"></div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    {{-- <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Relawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ asset("team") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="nik">Nik</label>
                            <input required value="{{ old('nik') }}" type="number" class="form-control" id="nik" placeholder="Nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="nama_relawan">Nama Relawan</label>
                            <input required value="{{ old('nama_relawan') }}" type="text" class="form-control" id="nama_relawan" placeholder="Nama Relawan" name="nama_relawan">
                        </div>
                        <div class="form-group">
                            <label for="id_desa">Pilih Desa</label>
                            <select class="form-control" name="id_desa" id="id_desa">
                                @foreach ($desa as $item)
                                    <option value="{{ $item->id_desa }}">{{ $item->nama_desa }}</option>
                                @endforeach
                            </select>
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
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="loyalis">Loyalis</label>
                            <select class="form-control" name="loyalis" id="loyalis">
                                <option value="1">Simpatisan</option>
                                <option value="2">Relawan</option>
                                <option value="3">Moderat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input required value="{{ old('no_hp') }}" type="number" class="form-control" id="no_hp" placeholder="No Hp" name="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input required value="{{ old('email') }}" type="text" class="form-control" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required value="{{ old('username') }}" type="text" class="form-control" id="username" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required value="{{ old('password') }}" type="password" class="form-control" id="password" placeholder="Password" name="password">
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
    </div> --}}
    
    {{-- Report Modal --}}
  <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Laporan Relawan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('team/laporan') }}" method="POST">
            @csrf
            <div class='form-check'>
                <input class='form-check-input check' type='checkbox' name='jabatan[]' value="2" id="koorcam">
                <label class='form-check-label' for='koorcam'>
                    Koordinator Kecamatan
                </label>
            </div>
            <div class="form-check">
                <input class='form-check-input check' type='checkbox' name='jabatan[]' value="1" id="koordes">
                <label class='form-check-label' for='koordes'>
                    Koordinator Desa
                </label>
            </div>
            <div class="form-check">
                <input class='form-check-input check' type='checkbox' name='jabatan[]' value="0" id="simpatisan">
                <label class='form-check-label' for='simpatisan'>
                    Simpatisan
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="">
                <button type="submit" class="btn btn-primary" id="report" disabled>Lapor</button>
            </a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
</div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Relawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="edit_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nik">Nik</label>
                            <input value="{{ old('nik') }}" type="number" class="form-control" id="nik_edit" placeholder="Nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="nama_relawan">Nama Relawan</label>
                            <input value="{{ old('nama_relawan') }}" type="text" class="form-control" id="edit_nama_relawan" placeholder="Nama Relawan" name="nama_relawan">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" name="jk" id="edit_jk">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_desa">Pilih Desa</label>
                            <select class="form-control" name="id_desa" id="edit_id_desa">
                                @foreach ($desa as $item)
                                    <option value="{{ $item->id_desa }}">{{ $item->nama_desa }}</option>
                                @endforeach
                            </select>
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
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="edit_status">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input value="{{ old('no_hp') }}" type="number" class="form-control" id="edit_no_hp" placeholder="No Hp" name="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input value="{{ old('email') }}" type="text" class="form-control" id="edit_email" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value="{{ old('username') }}" type="text" class="form-control" id="edit_username" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input value="{{ old('password') }}" type="password" class="form-control" id="edit_password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Loyalist --}}
    <div class="modal fade" id="editLoyalModal" tabindex="-1" role="dialog" aria-labelledby="createLoyalisLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Edit Loyalis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="edit_form_loyal">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_desa">Ganti Loyalis</label>
                            <select class="form-control" name="loyalis" id="edit_loyalis">
                                <option value="1">Simpatisan</option>
                                <option value="2">Relawan</option>
                                <option value="3">Moderat</option>
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
</div>

{{-- Jabatan Modal --}}
<div class="modal fade" id="editJabatanModal" tabindex="-1" role="dialog" aria-labelledby="createJabatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Edit Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="edit_form_jabatan">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="desa" id="edit_desa">
                            <label for="id_desa">Ganti Jabatan</label>
                            <select class="form-control" name="jabatan" id="edit_jabatan">
                                <option value="0">Simpatisan</option>
                                <option value="1">Koordinator Desa</option>
                                <option value="2">Koordinator Kecamatan</option>
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
        url: `{{ asset('team') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value,
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('team/${resp.id_relawan}') }}`)
            $("#edit_nama_relawan").val(resp.nama_relawan);
            $("#edit_jk").val(resp.jk);
            @auth("web")
            $("#edit_id_caleg").val(resp.id_caleg);
            @endauth
            $("#nik_edit").val(resp.nik);
            $("#edit_email").val(resp.email);
            $("#edit_id_desa").val(resp.id_desa);
            $("#edit_username").val(resp.username);
            $("#edit_no_hp").val(resp.no_hp);
        }
      })
  }

  let getLoyalis = e => {
    $.ajax({
        url: `{{ asset('team') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value,
        },
        dataType: "json",
        success: resp => {
            $("#edit_form_loyal").attr("action", `{{ asset('team/${resp.id_relawan}') }}`)
            $("#edit_loyalis").val(resp.loyalis);
        } 
      })
  }

  let getJabatan = e => {
    $.ajax({
        url: `{{ asset('team') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value,
        },
        dataType: "json",
        success: resp => {
            $("#edit_form_jabatan").attr("action", `{{ asset('team/${resp.id_relawan}') }}`)
            $("#edit_jabatan").val(resp.jabatan);
            $("#edit_desa").val(resp.id_desa);
        } 
      })
  }

  let getTps = e => {
    $.ajax({
        url: `{{ asset('team') }}`,
        method: "POST",
        data: {
          getTps: true,
          data: e.currentTarget.value,
        },
        dataType: "json",
        success: resp => {
            $("#tps_form").attr("action", `{{ asset('team/${e.currentTarget.value}') }}`)
            $("#desatitle").text(`TPS Untuk Desa ${resp[0]}`)
            $("#tps_form .form-group").html(resp[1])
        } 
      })
  }

  $(".getTps").on("click", getTps);
  $(".getData").on("click", getData);
  $(".getLoyalis").on("click", getLoyalis);
  $(".getJabatan").on("click", getJabatan);
  
  $("input[type='checkbox'].check").on("click", e => {
    $("input[type='checkbox'].check").each((i, v) => {
        if (v.checked) {
            $("#report").prop("disabled", false);
            return false;
        } else {
            $("#report").prop("disabled", true);
        }
    })
  })
  })
</script>
@endsection