@extends('layouts.auth')

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
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
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
                                    <form class="user" method="POST" action="{{ asset('resetpassword') }}" id="form">
                                        @csrf
                                        <div class="form-group">
                                            <input name="email" type="hidden" class="form-control"
                                                style="font-size: 17px" aria-describedby="emailHelp"
                                                placeholder="Password" id="email" value="{{ $data->email }}">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control"
                                                style="font-size: 17px" aria-describedby="emailHelp"
                                                placeholder="Password" id="password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"
                                                placeholder="Confirm Password" id="confirm">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset("register") }}">Register a new membership</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset("administrator") }}">Login as admin</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset("login") }}">Login as Caleg</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        document.getElementById("form").addEventListener("submit", e => {
            e.preventDefault();
            if (document.getElementById("password").value != document.getElementById("confirm").value) {
                alert("Confirm Password Tidak Sama!");
            } else {
                document.getElementById("form").submit();
            }
        })    
    </script>
@endsection
