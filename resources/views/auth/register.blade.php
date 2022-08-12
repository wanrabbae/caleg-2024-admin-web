@extends('layouts.auth')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Form Register Caleg 2024 Promotion</h1>
                            </div>
                            <form class="user" method="POST" autocomplete="off" action="/register-action" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="nama_caleg" class="form-control" required style="font-size: 17px" id="exampleFirstName" placeholder="Nama caleg">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="nama_lengkap" class="form-control" required style="font-size: 17px" id="exampleLastName" placeholder="Nama lengkap">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" required style="font-size: 17px" id="exampleInputEmail" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <select name="legislatif" id="legislatif" class="form-control" required style="font-size: 17px">
                                        <option value="" selected>Pilih Legislatif</option>
                                        @foreach ($legislatif as $item)
                                            <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required placeholder="Alamat lengkap"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="nohp" class="form-control" required style="font-size: 17px" id="exampleInputEmail" placeholder="No Hp">
                                </div>
                                <div class="form-group">
                                    <select name="partai" id="partai" class="form-control" required style="font-size: 17px">
                                        <option value="" selected>Pilih partai</option>
                                        @foreach ($partai as $item)
                                            <option value="{{ $item->id_partai }}">{{ $item->nama_partai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file_up" class="form-control" style="font-size: 17px" id="exampleInputEmail">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" required style="font-size: 17px" id="exampleInputEmail" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" required style="font-size: 17px" id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" onchange="checkAgree()" name="check" id="checkAgrees">
                                    Saya setuju dengan persyaratannya
                                </div>
                                <button type="submit" disabled id="registerBtn" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const checkAgrees = document.getElementById('checkAgrees');
            const registerBtn = document.getElementById('registerBtn');

            function checkAgree() {
                if (checkAgrees.checked) {
                    registerBtn.disabled = false;
                } else {
                    registerBtn.disabled = true;
                }
            }
        </script>
    </div>
@endsection
