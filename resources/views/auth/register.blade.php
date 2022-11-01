<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="" style="overflow-x: hidden">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
    <div class="w-full">
        <div class="row">
            <div class="col-md-8 d-none bg-gradient-primary p-md-4 d-md-flex justify-content-center align-items-center text-white flex-column">
                <h1>Caleg 2024</h1>
                <span>Cara Jitu Memenangkan Caleg 2024 Dengan Mudah Dan Tepat</span>
                <img src="{{ asset('images/logomd.png') }}" alt="" class="w-75">
            </div>
            <div class="col-md-4 d-flex justify-content-center min-vh-100 flex-column p-4">
                    <img src="{{ asset("images/jagat.png") }}" alt="" class="w-25 mx-auto">
                    <h1 class="font-weight-lighter font-bold text-center">Register Membership</h1>
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <ul>
                                <li class="text-danger">{{ $error }}</li>
                            </ul>
                        @endforeach
                    @endif
                    @if (session()->has("success"))
                            <p class="text-success text-center">{{ session()->get("success") }}</p>
                    @endif
                    @if (session()->has("error"))
                            <p class="text-danger text-center">{{ session()->get("error") }}</p>
                    @endif
                    <form method="POST" action="{{ asset("register-action") }}" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                      <label for="nama_caleg">Nama Caleg</label>
                      <input type="text" name="nama_caleg" class="form-control" id="nama_caleg" value="{{ old('nama_caleg') }}" aria-describedby="nama_caleg" autofocus placeholder="Nama Caleg">
                    </div>
                    <div class="form-group">
                      <label for="nama_lengkap">Nama Lengkap</label>
                      <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="{{ old('nama_lengkap') }}" aria-describedby="nama_lengkap" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                      <label for="level">Langganan</label>
                      <select name="level" class="form-control" id="level" value="{{ old('level') }}" aria-describedby="level">
                        <option value="Basic" selected>Basic</option>
                        <option value="Gold">Gold</option>
                        <option value="Platinum">Platinum</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" aria-describedby="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="legislatif">Legislatif</label>
                      <select name="legislatif" class="form-control getData" id="legislatif" value="{{ old('legislatif') }}" aria-describedby="legislatif">
                        <option value="" selected>Pilih Legislatif</option>
                        @foreach ($legislatif as $item)
                            <option value="{{ $item->id_legislatif }}">{{ $item->nama_legislatif }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" value="{{ old('alamat') }}" rows="3" class="form-control" required placeholder="Alamat lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nohp">Nomor Handphone</label>
                        <input type="number" name="no_hp" value="{{ old('no_hp') }}" class="form-control" required id="nohp" placeholder="No Hp">
                    </div>
                    <div class="form-group">
                        <label for="partai">Pilih Partai</label>
                        <select name="partai" value="{{ old('partai') }}" id="partai" class="form-control" required style="font-size: 17px">
                            <option value="" selected>Pilih partai</option>
                            @foreach ($partai as $item)
                                <option value="{{ $item->id_partai }}">{{ $item->nama_partai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Foto Diri</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="foto" aria-describedby="inputGroupFileAddon01" name="foto" required>
                          <label class="custom-file-label" for="foto">Choose file</label>
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required id="password" placeholder="Password">
                        <i class="fas fa-eye btn btn-primary mt-2" id="btn"></i>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" onchange="checkAgree()" name="check" id="checkAgrees">
                        Saya setuju dengan persyaratannya
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto w-75 d-block" id="registerBtn" disabled>Send</button>
                </form>
                <a href="{{ asset("login") }}" class="text-decoration-none text-center mt-4">
                    Caleg
                </a>
                <a href="{{ asset("register") }}" class="text-decoration-none text-center mt-2">
                    Register
                </a>
                <a href="{{ asset("administrator") }}" class="text-decoration-none text-center mt-2">
                    Administrator
                </a>
                
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
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

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
                    $("#dapil").html(resp)
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
                    $("#kabupaten").html(resp)
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
                        <select name="provinsi" class="form-control" id="provinsi" value="{{ old('provinsi') }}" aria-describedby="provinsi">
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
                        <select name="kabupaten" class="form-control" id="kabupaten" value="{{ old('kabupaten') }}" aria-describedby="kabupaten">
                            <option value="" selected>Pilih Provinsi Dahulu</option>
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
                    $("#legislatif").parent().after(text)
                    
                    if (resp[0] == "Provinsi") {
                        $("#provinsi").off().on("change", getDapil);
                    }

                    if (resp[0] == "Kabupaten") {
                        $("#provinsi").off().on("change", getKab);
                        $("#kabupaten").off().on("change", getDapil);
                    }
                },
            })
        }
      
        $(".getData").on("change", getProv);
        })
        
        let pass = document.getElementById("password");
        let btn = document.getElementById("btn");
        btn.addEventListener("click", e => {
            e.target.classList.toggle("fa-eye")
            e.target.classList.toggle("fa-eye-slash")
            if (pass.type == "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        })
      </script>
</body>

</html>