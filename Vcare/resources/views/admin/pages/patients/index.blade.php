@extends('admin.master')
@section('title','Patients')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.patients.create')}}" class="btn btn-sm btn-info float-left">Place New Patient</a>
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
                                <th>Gender</th>
                                @if (Gate::denies('manager'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient )

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{substr($patient->user->name,0,6).".."}}</td>
                                <td>{{substr($patient->user->email,0,15).".."}}</td>
                                <td>{{substr($patient->user->phone,0,11).".."}}</td>
                                <td>
                                    <img class="img-circle img-bordered-sm" src="{{FileHelper::get_file_path($patient->user->image?->path,'user')}}" alt="Image" width="100" height="100">
                                </td>
                                <td>{{$patient->user->gender->label()}}</td>
                                @if (Gate::denies('manager'))
                                <td>
                                    <a class="btn btn-warning" href="{{route('admin.patients.edit',$patient->id)}}">Edit</a>
                                    <div class="btn-group" role="group">
                                        <form class="d-inline" action="{{route('admin.patients.destroy',$patient->id)}}" method="post">
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
            {{$patients->links()}}
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@endsection