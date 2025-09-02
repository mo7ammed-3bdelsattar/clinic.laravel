@extends('doctor.master')
@section('title','Dashboard')
@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            
            {{-- <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col --> --}}

           

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">{{ $totalAmount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Patients</span>
                        <span class="info-box-number">{{ $patientsCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest Bookings</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
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
                                <td><a href="{{ route('admin.bookings.show', $booking->id) }}">{{ $booking->id }}</a>
                                </td>
                                <td>{{ $booking->doctor->user->name }}</td>
                                <td>{{ $booking->patient->user->name }}</td>
                                <td><span
                                        class="badge badge-{{ $booking->status=='visited'?'success':($booking->status=='pending'?'warning':'danger') }}">{{
                                        $booking->status }}</span></td>
                                <td>
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                    <form action="{{route('doctor.bookings.update',$booking->id)}}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" class="btn btn-success btn-sm"
                                            value="visited">Visited</button>
                                        <button type="submit" name="status" class="btn btn-warning btn-sm"
                                            value="pending">Pending</button>
                                        <button type="submit" name="status" class="btn btn-danger btn-sm"
                                            value="cancelled">Cancelled</button>
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
                <a href="{{ route('doctor.bookings') }}" class="btn btn-sm btn-secondary float-right">View All
                    Bookings</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col -->

</section>
@endsection