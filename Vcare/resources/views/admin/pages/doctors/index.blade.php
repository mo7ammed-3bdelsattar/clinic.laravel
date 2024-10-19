@extends('admin.master')
@section('title','Doctors')
@section('doctorsActivity','active')
@section('content')
@include('admin.inc.success')
<div class="card">
    <div class="card-header border-transparent">
        <a href="{{route('admin.doctors.create')}}" class="btn btn-sm btn-info float-left">Place New Doctor</a>
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
                            <th>Major</th>
                            <th>Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor )

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{substr($doctor->name,0,6).".."}}</td>
                            <td>{{substr($doctor->email,0,15).".."}}</td>
                            <td>{{substr($doctor->phone,0,11).".."}}</td>
                            <td>
                                <img class="img-circle img-bordered-sm" src="{{FileHelper::get_file_path($doctor->image,'user')}}" alt="Image" width="100" height="100">
                            </td>
                            <td>{{$doctor->major->title}}</td>
                            <td>{{$doctor->dates}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.doctors.edit',$doctor->id)}}">Edit</a>
                                <div class="btn-group" role="group">
                                    <form class="d-inline" action="{{route('admin.doctors.destroy',$doctor->id)}}" method="post">
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
        {{$doctors->links()}}
    </div>
    <!-- /.card-footer -->
</div>
@endsection