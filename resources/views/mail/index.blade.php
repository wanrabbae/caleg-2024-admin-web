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
                                        <h1 class="h4 text-gray-900 mb-4">Masukkan Email</h1>
                                    </div>
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error) 
                                        <div class="text-danger text-center mb-2 p-1" role="alert">
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                    @endif
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
                                    <form class="user" method="POST" action="{{ asset('reset') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control"
                                                style="font-size: 17px" id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Email">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Send
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                        <a class="small" href="{{ asset("register") }}">Register a new membership</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset("administrator") }}">Login as admin</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset("login") }}">Login as Caleg</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection --}}
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

<body class="overflow-hidden">
    <div class="w-full">
        <div class="row">
            <div class="col-md-8 d-none bg-gradient-primary p-md-4 d-md-flex justify-content-center align-items-center text-white flex-column">
                <h1>Caleg 2024</h1>
                <span>Cara Jitu Memenangkan Caleg 2024 Dengan Mudah Dan Tepat</span>
                <img src="{{ asset('images/logomd.png') }}" alt="" class="w-75">
            </div>
            <div class="col-md-4 d-flex justify-content-center min-vh-100 flex-column p-4">
                    <img src="{{ asset("images/jagat.png") }}" alt="" class="w-25 mx-auto">
                    <h1 class="font-weight-lighter font-bold text-danger text-center">Reset Password</h1>
                    <form method="POST" action="{{ asset("reset") }}">
                        @csrf
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" name="email" class="form-control" id="email" aria-describedby="email">
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto w-75 d-block">Send</button>
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
</body>

</html>