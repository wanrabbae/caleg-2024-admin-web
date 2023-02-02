@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
  <div class="card-header py-3">
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
                        <th>Nama Relawan</th>
                        <th>Jenis Kelamin</th>
                        <th>TPS</th>
                        @auth("web")
                        <th>Caleg</th>
                        @endauth
                        <th>Desa</th>
                        <th>Kecamatan</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->relawan->nama_relawan }}</td>
                                <td>{{ $data->relawan->jk }}</td>
                                <td>{{ $data->relawan->tps }}</td>
                                @auth("web")
                                <td>{{ $data->caleg->nama_caleg }}</td>
                                @endauth
                                <td>{{ $data->relawan->desa->nama_desa }}</td>
                                <td>{{ $data->relawan->desa->kecamatan->nama_kecamatan }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
