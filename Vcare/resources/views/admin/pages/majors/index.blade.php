@extends('admin.master')
@section('title','Majors')
@section('majorsActivity','active')
@section('content')
<div class="container">
@include('inc.success')
@include('inc.errors')

    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.majors.create')}}" class="btn btn-sm btn-info float-left">Place New Major</a>
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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($majors as $major )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$major->title}}</td>
                            <td>
                                <img class="img-circle img-bordered-sm" src="{{FileHelper::get_file_path($major->image)}}" alt="Image" width="100" height="100">
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.majors.edit',$major->id)}}">Edit</a>
                                <div class="btn-group" role="group">
                                    <form class="d-inline" action="{{route('admin.majors.destroy',$major->id)}}" method="post">
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
            {{$majors->links()}}
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@endsection