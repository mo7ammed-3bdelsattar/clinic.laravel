@extends('admin.master')
@section('title','Appointments')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.appointments.create', $id)}}" class="btn btn-sm btn-info float-left">Place New Appointment</a>
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
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment )

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$appointment->doctor->user->name}}</td>
                            <td>{{\App\Enums\DaysEnum::from($appointment->date)->label()}}</td>
                            <td>{{$appointment->start_at}}</td>
                            <td>{{$appointment->end_at}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('admin.appointments.edit',$appointment->id)}}">Edit</a>
                                <div class="btn-group" role="group">
                                    <form class="d-inline" action="{{route('admin.appointments.destroy',$appointment->id)}}"
                                        method="post">
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