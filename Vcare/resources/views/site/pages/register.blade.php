@extends('site.app')
@section('title','Register')

@section('content')
@include('site.layouts.header')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('home.index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">login</li>
        </ol>
    </nav>
    <div class="card card-primary">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
                        value="{{old('name')}}">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email"
                        value="{{old(key: 'email')}}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone"
                        value="{{old(key: 'phone')}}">
                    @error('phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter Password">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-select form-control" aria-label="Default select example" name="type">
                        <option value="4" selected>{{ \App\Enums\UserTypesEnum::PATIENT->label() }}</option>
                    </select>
                    @error('type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-select form-control" aria-label="Default select example" name="gender">
                        <option value="" disabled selected>Select Gender</option>
                        @foreach ($genders as $gender)
                        <option value="{{ $gender }}" {{ old('gender')==$gender ? 'selected' : '' }}>
                            {{ \App\Enums\UserGendersEnum::from($gender)->label() }}
                        </option>
                        @endforeach
                    </select>
                    @error('gender')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create account</button>
            </div>
        </form>
        <div class="card-footer">
            <a href="{{ url('/auth/google') }}" class="btn btn-danger">
                <i class="fab fa-google"></i> Login with Google
            </a>
            <a href="{{ url('/auth/facebook') }}" class="btn btn-primary">
                <i class="fab fa-facebook"></i> Login with Facebook
            </a>
            <div class="d-flex justify-content-center gap-2">
                <span>already have an account?</span><a class="link" href="{{route('login.index')}}"> login</a>
            </div>
        </div>
    </div>

</div>
@endsection