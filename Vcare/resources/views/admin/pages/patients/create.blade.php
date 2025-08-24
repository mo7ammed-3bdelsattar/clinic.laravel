@extends('admin.master')
@section('title','Create Patient')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Fill New Patient Data</h3>
    </div>
    <form action="{{route('admin.patients.store')}}" method="POST" enctype="multipart/form-data">
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
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
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
            <div class="form-group">
                <label for="exampleInputFile">Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="Image">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</div>

@endsection