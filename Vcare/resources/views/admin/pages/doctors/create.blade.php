@extends('admin.master')
@section('title','CreateDoctor')
@section('doctorsActivity','active')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Fill New Doctor Data</h3>
    </div>
    <form action="{{route('admin.doctors.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="adress">Adress</label>
                <textarea name="adress" id="adress" cols="30" rows="10" class="form-control"></textarea>
                @error('adress')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dates">Dates</label>
                <input type="text" name="dates" class="form-control" id="dates" placeholder="Enter Dates">
                @error('dates')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="admin_id">AdminID</label>
            <select class="form-select form-control" aria-label="Default select example" name="admin_id">
                <option value="{{$adminSelected->id}}" selected>{{$adminSelected->name}}</option>
                @foreach ($admins as $admin )
                <option value="{{$admin->id}}">{{$admin->name}}</option>
                @endforeach
            </select>
            @error('admin_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="major_id">MajorID</label>
            <select class="form-select form-control" aria-label="Default select example" name="major_id">
                <option value="{{$majorSelected->id}}" selected>{{$majorSelected->title}}</option>
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