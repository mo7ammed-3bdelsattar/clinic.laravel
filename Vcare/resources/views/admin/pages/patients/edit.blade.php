@extends('admin.master')
@section('title','Edit Patient')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Patient Data</h3>
    </div>
    <form action="{{route('admin.patients.update',$patient->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{$patient->user->name}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{$patient->user->email}}">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone" value="{{$patient->user->phone}}">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" value="{{$patient->user->password}}">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="type">Type</label>
            <select class="form-select form-control" aria-label="Default select example" name="type" >
                <option value="{{$patient->user->type}}" selected>{{$patient->user->type->label()}}</option>
            </select>
            @error('type')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-select form-control" aria-label="Default select example" name="gender" >
                <option value="{{$patient->user->gender}}" selected>{{$patient->user->gender->label()}}</option>
                @foreach ($genders as $gender )
                <option value="{{$gender}}">{{App\Enums\UserGendersEnum::from($gender)->label()}}</option>
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