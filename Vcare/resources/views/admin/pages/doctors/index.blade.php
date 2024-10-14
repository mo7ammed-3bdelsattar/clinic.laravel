@extends('admin.master')
@section('title','Doctors')
@section('doctorsActivity','active')
@section('content')
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
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Adress</th>
                        <th>Image</th>
                        <th>Major</th>
                        <th>Dates</th>
                        <th>Visitors</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$doctor->name}}</td>
                        <td>{{$doctor->email}}</td>
                        <td>{{$doctor->phone}}</td>
                        <td>{{$doctor->adress}}</td>
                        <td>
                            <img class="img-circle img-bordered-sm"
                             src="{{asset($doctor->image?"$doctor->image":"uploads/user.png")}}"
                              alt="Image" width="100" height="100">
                        </td>
                        <td>{{$doctor->major->name}}</td>
                        <td>{{$doctor->dates}}</td>
                        <td>{{$doctor->visitors}}</td>
                        <td><span class="badge badge-success">Top Doctor</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{$doctors->links()}}
    </div>
    <!-- /.card-footer -->
</div>
@endsection