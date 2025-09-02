@extends('doctor.master')
@section('title','Doctor Bookings')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header border-transparent">
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
                            <th>Booking ID</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                        <tr>
                            <td><a href="{{ route('doctor.bookings.show', $booking->id) }}">{{ $booking->id }}</a></td>
                            <td>{{ $booking->doctor->user->name }}</td>
                            <td>{{ $booking->patient->user->name }}</td>
                            <td><span
                                    class="badge badge-{{ $booking->status=='visited'?'success':($booking->status=='pending'?'warning':'danger') }}">{{
                                    $booking->status }}</span></td>
                            <td>
                                <a href="{{ route('doctor.bookings.show', $booking->id) }}"
                                    class="btn btn-info btn-sm d-inline">View</a>
                                <form action="{{route('doctor.bookings.update',$booking->id)}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" class="btn btn-success btn-sm" value="visited">Visited</button>
                                    <button type="submit" name="status" class="btn btn-warning btn-sm" value="pending">Pending</button>
                                    <button type="submit" name="status" class="btn btn-danger btn-sm" value="cancelled">Cancelled</button>
                                </form>
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
            {{$bookings->links()}}
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@endsection