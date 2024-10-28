@extends('admin.master')
@section('title','Admins')
@section('adminsActivity','active')
@section('content')
<div class="container">
    @include('inc.success')
    @include('inc.errors')
    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.admins.create')}}" class="btn btn-sm btn-info float-left">Place New admin</a>
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
                                @if (Gate::denies('manager'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin )

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{substr($admin->name,0,6).".."}}</td>
                                <td>{{substr($admin->email,0,15).".."}}</td>
                                <td>{{substr($admin->phone,0,11).".."}}</td>
                                <td>
                                    <img class="img-circle img-bordered-sm" src="{{FileHelper::get_file_path($admin->image,'admin')}}" alt="Image" width="100" height="100">
                                </td>
                                @if ($admin->type=='admin')
                                    <?php $badge='badge-danger'?>
                                @elseif($admin->type=='manager')
                                    <?php $badge='badge-warning'?>
                                @elseif($admin->type=='doctor')
                                    <?php $badge='badge-success'?>
                                @endif
                                <td><span class="badge {{$badge}}">{{$admin->type}}</span></td>
                                @if (Gate::denies('manager'))
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