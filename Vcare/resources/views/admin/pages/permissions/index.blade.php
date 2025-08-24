
@extends('admin.master')
@section('title','Permissions')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.permissions.create')}}" class="btn btn-sm btn-info float-left">Place New Permission</a>
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
                            <th>Permission</th>
                            <th>Guard</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission )
                    
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->guard_name}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.permissions.edit',$permission->id)}}">Edit</a>
                                <div class="btn-group" permission="group">
                                    <form class="d-inline" action="{{route('admin.permissions.destroy',$permission->id)}}" method="post">
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
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{$permissions->links()}}
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@endsection