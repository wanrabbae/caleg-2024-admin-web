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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
