@extends('admin.master')
@section('title','Bookings')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-header border-transparent">
            <a href="{{route('admin.bookings.create')}}" class="btn btn-sm btn-info float-left">Place New Booking</a>
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
                            <td><a href="{{ route('admin.bookings.show', $booking->id) }}">{{ $booking->id }}</a></td>
                            <td>{{ $booking->doctor->user->name }}</td>
                            <td>{{ $booking->patient->user->name }}</td>
                            <td><span
                                    class="badge badge-{{ $booking->status=='visited'?'success':($booking->status=='pending'?'warning':'danger') }}">{{
                                    $booking->status }}</span></td>
                            <td>
                                @if ($booking->status == 'pending')
                                <form action="{{ route('booking.cancel', $booking->id) }}" class="d-inline"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" class="d-inline"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                    class="btn btn-info btn-sm">View</a>
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