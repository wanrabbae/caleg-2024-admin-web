{{-- WA BLAS --}}
@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" id="sendBtn" class="btn btn-primary" data-toggle="modal" data-target="#createModal" disabled>
                <i class="fas fa-comments"></i>
                Kirim Pesan Ke Relawan
            </button>
            <button type="button" id="selectAllBtn" class="btn btn-primary" value="false">
                <i class="fas fa-list"></i>
                Pilih Semua
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
                    {{ $relawan->links() }}
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pilih</th>
                            <th>Nama Relawan</th>
                            <th>No Hp</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Koordinator</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($relawan->count())
                            @foreach ($relawan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="checkbox" name="check" class="check" class="form-control w-50" value="{{ $data->no_hp }}">
                                    </td>
                                    <td>{{ $data->nama_relawan }}</td>
                                    <td>{{ $data->no_hp }}</td>
                                    <td>{{ $data->desa->nama_desa ?? '' }}</td>
                                    <td>
                                        {{ $data->desa->kecamatan->nama_kecamatan ?? '' }}
                                    </td>
                                    <td></td>
                                    <td>
                                        @if (Storage::disk("public_path")->exists($data->profile))
                                            <img src="{{ asset("public/" . $data->profile) }}" alt="" style="width: 200px">
                                        @else
                                            <i class="fas fa-image"></i>
                                            <span>Image Not Found</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success setForm" data-toggle="modal" data-target="#createModal" value="{{ $data->no_hp }}">
                                            <i class="fas fa-bell"></i>
                                        </button>
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
                    <h5 class="modal-title" id="createModalLabel">Kirim Pesan Ke Relawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/whatsapp/send" method="POST" id="sendForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="no_hp[]" value="" id="no_hp">
                        <div class="form-group">
                            <label for="no_hp">Pesan Japri</label>
                            <textarea name="pesan" id="pesan" cols="30" rows="4" placeholder="Pesan..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script>
        let checkBox = Array.from(document.getElementsByClassName("check"));
        let form = document.getElementById("sendForm");

        let arr = [];

        document.getElementById("selectAllBtn").addEventListener("click", e => {
            if (arr.length !== checkBox.length) {
                e.target.value = true;
            } else {
                e.target.value = false;
            }

            checkBox.forEach(v => {
                if (e.target.value == "true") {
                    v.checked = true;
                    if (!arr.includes(v.value)) arr.push(v.value)
                } else {
                    v.checked = false;
                    arr = [];
                }
            })
            check();
        })

        let selecting = e => {
            if (!arr.includes(e.target.value)) {
                arr.push(e.target.value);
            } else {
                arr.splice(arr.indexOf(e.target.value), 1);
            }
            check();
        }
        
        let check = () => {
            if (arr.length) {
                document.getElementById("sendBtn").disabled = false;
            } else {
                document.getElementById("sendBtn").disabled = true;
            }
        }

        checkBox.forEach((v, i) => {
            v.addEventListener("change", selecting)
        })

        form.addEventListener("submit", e => {
            e.preventDefault();
            form["no_hp"].value = arr.length ? arr : form["no_hp"].value;
            form.submit();
        })
        
        let addHp = e => {
            $("#no_hp").val(e.currentTarget.value)
        }
        
        $(".setForm").on("click", addHp)
    </script>
@endsection