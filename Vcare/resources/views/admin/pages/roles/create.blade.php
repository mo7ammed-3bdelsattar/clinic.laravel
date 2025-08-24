@extends('admin.master')
@section('title','Create Role')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Fill New Role Data</h3>
    </div>
    <form action="{{route('admin.roles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="row">
                @foreach($permissions as $permission)
                <div class="col-md-3">
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
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