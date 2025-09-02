@extends('admin.master')
@section('title','EditDoctor')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Doctor Data</h3>
        <a href="{{ route('admin.appointments.index',$doctor->id) }}" class="btn btn-sm btn-info float-right">Appointments</a>
        <a href="{{route('admin.users.addRole', $doctor->user->id)}}" class="btn btn-sm btn-info float-right">Add Role</a>
    </div>

    <form action="{{route('admin.doctors.update',$doctor->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{$doctor->user->name}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{$doctor->user->email}}">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone" value="{{$doctor->user->phone}}">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control">{{$doctor->address}}</textarea>
                @error('address')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">price</label>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price" value="{{$doctor->price}}">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-select form-control" aria-label="Default select example" name="type">
                    <option value="{{ $doctor->user->type }}" selected>{{ $doctor->user->type->label() }}</option>
                    @foreach ($types as $type) 
                    <option value="{{ $type}}">{{
                        App\Enums\UserTypesEnum::from($type)->label() }}</option>
                    @endforeach
                </select> 
                @error('type')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-select form-control" aria-label="Default select example" name="gender">
                    <option value="{{ $doctor->user->gender }}" selected>{{ $doctor->user->gender->label() }}
                    </option>
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
            <label for="major_id">Major</label>
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
                <label for="password">Password</label>
                <input type="password" value="{{$doctor->user->password}}"  name="password" class="form-control" id="password" placeholder="Enter Password">
                @error('password')
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