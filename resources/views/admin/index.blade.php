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
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN ADMINISTRATOR</h1>
                                    </div>
                                    @if (session()->has('error'))
                                        <div class="text-danger text-center mb-2 p-1" role="alert">
                                            {{ session()->get('error') }}
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
                                        <a class="small" href="forgot-password.html">
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
