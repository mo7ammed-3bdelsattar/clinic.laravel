@extends('admin.master')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Role Data</h3>
    </div>
    <form action="{{route('admin.users.assignRole',$id ?? '')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Select Role</label>
            <select name="name" id="name" class="form-control">
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif
                    >{{ ucfirst($role->name)}}</option>
                @endforeach
            </select>
            @error('role')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="guard_name">Guard Name</label>
            <select name="guard_name" id="guard_name" class="form-control">
                <option value="">-- Select Guard --</option>
                <option value="web" @if($user->getRoleNames()->first()=='patient'||$user->getRoleNames()->first()=='doctor') selected @endif>Web</option>
                <option value="admin" @if($user->getRoleNames()->first()=='admin'||$user->getRoleNames()->first()=='manager') selected @endif>Admin</option>
            </select>
            @error('guard_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Assign Role</button>
    </form>
</div>
@endsection