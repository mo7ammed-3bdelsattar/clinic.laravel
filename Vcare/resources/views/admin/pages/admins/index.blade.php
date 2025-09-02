@extends('admin.master')
@section('title','Admins')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header border-transparent">
            @if($auth->hasRole('admin'))
                <a href="{{route('admin.admins.create')}}" class="btn btn-sm btn-info float-left">Place New admin</a>
            @endif
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
                                <th>Image</th>
                                <th>Type</th>
                                <th>Gender</th>
                                @if($auth->can('admins.manage'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin )

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{substr($admin->user->name,0,6).".."}}</td>
                                <td>{{substr($admin->user->email,0,15).".."}}</td>
                                <td>{{substr($admin->user->phone,0,11).".."}}</td>
                                <td>
                                    <img class="img-circle img-bordered-sm" src="{{FileHelper::get_file_path($admin->user->image?->path,'user')}}" alt="Image" width="100" height="100">
                                </td>
                                @if ($admin->user->type->label()=='Admin')
                                    <?php $badge='badge-danger'?>
                                @elseif($admin->user->type->label()=='Manager')
                                    <?php $badge='badge-warning'?>
                                @endif
                                <td><span class="badge {{$badge}}">{{$admin->user->type->label()}}</span></td>
                                <td>{{$admin->user->gender->label()}}</td>
                                @if($auth->can('admins.manage'))
                                    <td>
                                        <a class="btn btn-warning" href="{{route('admin.admins.edit',$admin->id)}}">Edit</a>
                                        <div class="btn-group" role="group">
                                        <form class="d-inline" action="{{route('admin.admins.destroy',$admin->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
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
            {{$admins->links()}}
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@endsection