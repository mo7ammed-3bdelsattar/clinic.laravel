@extends('site.app')
@section('title','Login')
@section('content')
@include('site.layouts.header')
<div class="container">
    <br>
    <div class="d-flex justify-content-center align-items-center p-5 md-4">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{route('home.index')}}" class="h1"><b>{{env('APP_NAME')}}</b>Login</a>
                </div>
                <div class="card-body">
                    <form class="form" action="{{route('auth.login')}}" method="POST">
                        @csrf

                        <div class="input mb-3">
                            <div class="input-group-append">
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{old('email')}}">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input mb-3">
                            <div class="input-group-append">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/auth/google') }}" class="btn btn-danger">
                        <i class="fab fa-google"></i> Login with Google
                    </a>
                    <a href="{{ url('/auth/facebook') }}" class="btn btn-primary">
                        <i class="fab fa-facebook"></i> Login with Facebook
                    </a>
                    <div class="d-flex justify-content-center gap-2 flex-column flex-lg-row flex-md-row flex-sm-column">
                        <span>don't have an account?</span><a class="link" href="{{route('register.index')}}">create
                            account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection