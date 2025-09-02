@extends('admin.master')
@section('title','Create Permission')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Fill New Permission Data</h3>
    </div>
    <form action="{{route('admin.permissions.store')}}" method="POST" >
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
                <label for="guard_name">Guard Name</label>
                <select name="guard_name" id="guard_name" class="form-control">
                    <option value="" selected>Select Guard Name</option>
                    <option value="web">Web</option>
                    <option value="admin">Admin</option>
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

@endsection