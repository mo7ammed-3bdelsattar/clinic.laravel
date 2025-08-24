
@extends('admin.master')
@section('title','Banners')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.banners.create')}}" class="btn btn-sm btn-info float-left">Place New banner</a>
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
                            <th>Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner )
                    
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$banner->name}}</td>
                            <td>{{$banner->title}}</td>
                            <td>{{substr($banner->description, 0, 50)}}...</td>
                            <td>
                                <img class="img-circle img-bordered-sm" src="{{FileHelper::get_file_path($banner->image?->path)}}" alt="Image" width="100" height="100">
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.banners.edit',$banner->id)}}">Edit</a>
                                <div class="btn-group" role="group">
                                    <form class="d-inline" action="{{route('admin.banners.destroy',$banner->id)}}" method="post">
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
            {{$banners->links()}}
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@endsection