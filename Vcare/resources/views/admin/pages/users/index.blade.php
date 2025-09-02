@extends('admin.master')
@section('title','Users')
@section('usersActivity','active')
@section('content')
<div class="container">
    @include('inc.success')
    @include('inc.errors')
    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-info float-left">Place New user</a>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="container">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{substr($user->name,0,6).".."}}</td>
                                <td>{{substr($user->email,0,15).".."}}</td>
                                <td>{{substr($user->phone,0,11).".."}}</td>
                                <td><span>{{$user->type->label()}}</span></td>
                                <td>
                                    <img class="img-circle img-bordered-sm" src="{{FileHelper::get_file_path($user->image?->path,'user')}}" alt="Image" width="100" height="100">
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('admin.users.edit',$user->id)}}">Edit</a>
                                    <div class="btn-group" role="group">
                                        <form class="d-inline" action="{{route('admin.users.destroy',$user->id)}}" method="post">
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
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{$users->links()}}
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@endsection