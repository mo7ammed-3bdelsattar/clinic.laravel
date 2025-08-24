@extends('admin.master')
@section('title','Edit Role')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Role Data</h3>
    </div>
    <form action="{{route('admin.roles.update',$role->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="guard_name">Guard Name</label>
                <select name="guard_name" id="guard_name" class="form-control">
                    <option value="web" {{ $role->guard_name == 'web' ? 'selected' : '' }}>Web</option>
                    <option value="admin" {{ $role->guard_name == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('guard_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                @foreach($permissions as $permission)
                <div class="col-md-3">
                    <label>
                        <input type="checkbox" name="permissions[]"  value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        {{ $permission->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</div>

@endsection