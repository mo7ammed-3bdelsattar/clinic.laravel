@extends('admin.master')
@section('title','EditDoctor')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Doctor Data</h3>
    </div>
    <form action="{{route('admin.doctors.update',$doctor->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{$doctor->name}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{$doctor->email}}">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone" value="{{$doctor->phone}}">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="adress">Adress</label>
                <textarea name="adress" id="adress" cols="30" rows="10" class="form-control">{{$doctor->adress}}</textarea>
                @error('adress')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dates">Dates</label>
                <input type="text" name="dates" class="form-control" id="dates" placeholder="Enter Dates" value="{{$doctor->dates}}">
                @error('dates')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="user_id">UserID</label>
            <select class="form-select form-control" aria-label="Default select example" name="user_id">
                <option value="{{$doctor->user_id}}" selected>{{$doctor->user->name}}</option>
                @foreach ($users as $user )
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="major_id">MajorID</label>
            <select class="form-select form-control" aria-label="Default select example" name="major_id">
                <option value="{{$doctor->major_id}}" selected>{{$doctor->major->title}}</option>
                @foreach ($majors as $major )
                <option value="{{$major->id}}">{{$major->title}}</option>
                @endforeach
            </select>
            @error('major_id')
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