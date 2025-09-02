@extends('admin.master')
@section('title','Edit Permission')
@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Permission Data</h3>
        </div>
        <form action="{{route('admin.permissions.update',$permission->id)}}" method="POST" >
            @csrf
            @method('PATCH')
            <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$permission->name}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="guard_name">Guard Name</label>
                <select name="guard_name" id="guard_name" class="form-control">
                    <option value="web" {{ $permission->guard_name == 'web' ? 'selected' : '' }}>Web</option>
                    <option value="admin" {{ $permission->guard_name == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('guard_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@endsection