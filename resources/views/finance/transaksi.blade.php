@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i>
            Transaksi
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal">
          <i class="fas fa-book"></i>
            Laporan
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive"><div class="d-flex justify-content-between flex-column flex-md-row">
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
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Media</th>
                        <th>Nama Media</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tgl_transaksi }}</td>
                            <td>{{ $data->kategori->jenis_transaksi }}</td>
                            <td>{{ $data->kategori->nama_kategori }}</td>
                            <td>{{ $data->id_bank ? "Bank" : "Wallet" }}</td>
                            <td>{{ $data->id_bank ? $data->bank->nama_bank : $data->wallet->nama_wallet }}</td>
                            @if ($data->kategori->jenis_transaksi == "Pemasukan")
                            <td>Rp.{{ number_format($data->jumlah,2,',','.') }}</td>
                            <td></td>
                            @else
                            <td></td>
                            <td>Rp.{{ number_format($data->jumlah,2,',','.') }}</td>
                            @endif
                            <td>{{ $data->deskripsi }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-warning mx-3 getData" value="{{ $data->id_transaksi }}" data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ asset("transaksi/$data->id_transaksi") }}" method="POST" class="d-inline">
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
          <h5 class="modal-title" id="createModalLabel">Tambah Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset("transaksi") }}" method="POST">
        <div class="modal-body">
                 @csrf
                <div class="form-group">
                  <label for="tgl_transaksi">Tanggal Transaksi</label>
                  <input  type="date" class="form-control" name="tgl_transaksi" id="tgl_transaksi">
                </div>
                <div class="form-group">
                  <label for="media">Media</label>
                  <select class="form-control" name="media" id="media">
                    <option value="">Pilih Media</option>
                    <option value="Bank">Bank</option>
                    <option value="Wallet">Wallet</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="nama_media">Nama Media</label>
                  <select class="form-control" name="nama_media" id="nama_media">
                    <option value="">Pilih Jenis Media</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jenis_transaksi">Jenis Transaksi</label>
                  <select class="form-control" name="jenis_transaksi" id="jenis_transaksi">
                    <option value="">Pilih Jenis Transaksi</option>
                    <option value="Pemasukan">Pemasukan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="id_kategori">Kategori Transaksi</label>
                  <select class="form-control" name="id_kategori" id="id_kategori">
                    <option value="">Pilih Jenis Kategori</option>
                </select>
              </div>
                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah">
                </div>
                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" placeholder="Masukan Deskripsi" style="resize: none;"></textarea>
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
          <h5 class="modal-title" id="editModalLabel">Edit Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="edit_form">
          <div class="modal-body">
            @method('put')
                   @csrf
                  <div class="form-group">
                    <label for="tgl_transaksi">Tanggal Transaksi</label>
                    <input  type="date" class="form-control" name="tgl_transaksi" id="edit_tgl_transaksi">
                  </div>
                  <div class="form-group">
                    <label for="media">Media</label>
                    <select class="form-control" name="media" id="edit_media">
                      <option value="">Pilih Media</option>
                      <option value="Bank">Bank</option>
                      <option value="Wallet">Wallet</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama_media">Nama Media</label>
                    <select class="form-control" name="nama_media" id="edit_nama_media">
                      <option value="">Pilih Jenis Media</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jenis_transaksi">Jenis Transaksi</label>
                    <select class="form-control" name="jenis_transaksi" id="edit_jenis_transaksi">
                      <option value="">Pilih Jenis Transaksi</option>
                      <option value="Pemasukan">Pemasukan</option>
                      <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_kategori">Kategori Transaksi</label>
                    <select class="form-control" name="id_kategori" id="edit_id_kategori">
                      <option value="">Pilih Jenis Kategori</option>
                  </select>
                </div>
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="edit_jumlah" placeholder="Jumlah" name="jumlah">
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" rows="5" class="form-control" placeholder="Masukan Deskripsi" style="resize: none;"></textarea>
                  </div>
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
  
  {{-- Report Modal --}}
  <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Laporan Finance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
          <button type="button" class="btn btn-primary col-md-5 mx-auto d-block p-2 mt-2" data-toggle="modal" data-target="#neracaModal">
            Neraca Saldo
          </button>
          <button type="button" class="btn btn-primary col-md-5 d-block mx-auto mt-2 p-2" data-toggle="modal" data-target="#jurnalModal">
            Jurnal Umum
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Neraca Modal --}}
  <div class="modal fade" id="neracaModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Pilih Tanggal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset("laporan") }}" method="POST" target="_blank">
        <div class="modal-body row">
            @csrf
            <input type="hidden" value="neraca" name="type">
            <div class="form-group col-md-5">
              <input type="date" class="form-control" name="start" id="start">
            </div>
            <div class="col-md-2">
              <h3 class="text-primary text-center">S/D</h3>
            </div>
            <div class="form-group col-md-5">
              <input type="date" class="form-control" name="end" id="end">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="">
              <button type="submit" class="btn btn-primary">Lapor</button>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Jurnal Modal --}}
  <div class="modal fade" id="jurnalModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Pilih Tanggal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset("laporan") }}" method="POST" target="_blank">
        <div class="modal-body row">
            @csrf
            <input type="hidden" value="jurnal" name="type">
            <div class="form-group col-md-5">
              <input type="date" class="form-control" name="start" id="start">
            </div>
            <div class="col-md-2">
              <h3 class="text-primary text-center">S/D</h3>
            </div>
            <div class="form-group col-md-5">
              <input type="date" class="form-control" name="end" id="end">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="">
              <button type="submit" class="btn btn-primary">Lapor</button>
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
        url: `{{ asset('transaksi') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
          $("#edit_form").attr("action", `{{ asset('transaksi/${resp.id_transaksi}') }}`);
          $("#edit_tgl_transaksi").val(resp.tgl_transaksi);
          $("#edit_jumlah").val(resp.jumlah);
          $("#edit_deskripsi").val(resp.deskripsi);
        } 
      })
  }

    let getMedia = e => {
        let data = $(`#${e.currentTarget.id}`).val();
        
      $.ajax({
        url: "{{ asset('transaksi') }}",
        method: "POST",
        data: {
          getMedia: true,
          media: data.toLowerCase(),
          id: '{{ auth()->user()->id_caleg }}'
        },
        dataType: "json",
        success: resp => {
          let text;
          resp.forEach((v, i) => {
            if (data == "Bank" || data == "Wallet") {
              text += data == "Bank" ? `<option value='${v.id_bank}' ${i == 0 ? "selected" : ""}>${v.nama_bank}</option>` : `<option value='${v.id_wallet}' ${i == 0 ? "selected" : ""}>${v.nama_wallet}</option>`
            } else {
              text += `<option value='${v.id_kategori}' ${i == 0 ? "selected" : ""}>${v.nama_kategori}</option>`
            }
          })
          
          if (!e.currentTarget.id.includes('edit')) {
            if (data == "Bank" || data == "Wallet") {
              $("#nama_media").empty().html(text)
            } else {
              $("#id_kategori").empty().html(text)
            }
          } else {
            if (data == "Bank" || data == "Wallet") {
              $("#edit_nama_media").empty().html(text)
            } else {
              $("#edit_id_kategori").empty().html(text)
            }
          }
        }
      })
    }
        
     $("#media").on("change", getMedia);
    $("#jenis_transaksi").on("change", getMedia);
    $("#edit_media").on("change", getMedia);
    $("#edit_jenis_transaksi").on("change", getMedia);
    $(".getData").on("click", getData);
    })
  </script>
@endsection
