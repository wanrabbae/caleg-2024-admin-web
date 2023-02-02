{{-- @extends('layouts.auth')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-4 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN ADMINISTRATOR</h1>
                                    </div>
                                    @if (session()->has('error'))
                                        <div class="text-danger text-center mb-2 p-1" role="alert">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                    @if (session()->has('success'))
                                        <div class="text-success text-center mb-2 p-1" role="alert">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    <form class="user" method="POST" action="{{ asset('administrator') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control"
                                                style="font-size: 17px" id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control"
                                                style="font-size: 17px" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset("reset") }}">
                                            I forgot my password</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset("login") }}">Login as caleg</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
--}}
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
    <link href="{{ asset('public/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="overflow-hidden">
    <div class="w-full">
        <div class="row">
            <div class="col-md-8 d-none bg-gradient-primary p-md-4 d-md-flex justify-content-center align-items-center text-white flex-column">
                <h1>Caleg 2024</h1>
                <span>Cara Jitu Memenangkan Caleg 2024 Dengan Mudah Dan Tepat</span>
                <img src="{{ asset('public/images/logomd.png') }}" alt="" class="w-75">
            </div>
            <div class="col-md-4 d-flex justify-content-center min-vh-100 flex-column p-4">
                    <img src="{{ asset("public/images/jagat.png") }}" alt="" class="w-25 mx-auto">
                    <h1 class="font-weight-lighter font-bold text-dark text-center">Administrator</h1>
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
                    <form method="POST" action="{{ asset("administrator") }}">
                        @csrf
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="username" class="form-control" id="username" aria-describedby="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <i class="fas fa-eye btn btn-primary mt-2" id="btn"></i>
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" name="remember" class="form-check-input" id="remember">
                      <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto w-75 d-block">Login</button>
                </form>
                <a href="{{ asset("reset") }}" class="text-decoration-none mt-4">
                    <button type="button" class="btn btn-danger mx-auto w-75 d-block">Lupa Password</button>
                </a>
                <a href="{{ asset("register") }}" class="text-decoration-none text-center mt-4">
                    Register
                </a>
                <a href="{{ asset("login") }}" class="text-decoration-none text-center mt-2">
                    Caleg
                </a>
            </div>
        </div>
    </div>
    <script>
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
