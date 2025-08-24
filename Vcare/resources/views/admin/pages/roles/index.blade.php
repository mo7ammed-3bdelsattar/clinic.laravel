
@extends('admin.master')
@section('title','Roles')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-info float-left">Place New Role</a>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Guard Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role )
                    
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->guard_name}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.roles.edit',$role->id)}}">Edit</a>
                                <div class="btn-group" role="group">
                                    <form class="d-inline" action="{{route('admin.roles.destroy',$role->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
  
    </div>
</div>
@endsection