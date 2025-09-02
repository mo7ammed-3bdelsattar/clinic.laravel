@extends('admin.master')
@section('title','Dashboard')
@section('loading')

<!-- Preloader -->
{{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">
</div> --}}

@endsection
@section('content')

<!-- Main content -->
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
            </div> --}}
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

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
                        <span class="info-box-text">Doctors</span>
                        <span class="info-box-number">{{ $doctorsCount }}</span>
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
                    <form method="GET" action="{{ route('admin.dashboard') }}">
                        <select name="filter" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="" {{ request('filter')=='' ?'selected':'' }}>All</option>
                            <option value="today" {{ request('filter')=='today' ?'selected':'' }}>Today</option>
                            <option value="week" {{ request('filter')=='week' ?'selected':'' }}>This Week</option>
                            <option value="month" {{ request('filter')=='month' ?'selected':'' }}>This Month</option>
                            <option value="year" {{ request('filter')=='year' ?'selected':'' }}>This Year</option>
                        </select>
                    </form>
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
                                <th>Created At</th>
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
                                <td>{{ $booking->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <form action="{{route('admin.bookings.update',$booking->id)}}" method="POST"
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
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-secondary float-right">View All
                    Bookings</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
        <!-- TABLE: LATEST MEMBERS -->
        <div class="row">
            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Members</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">{{ $count }} New Members</span>
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
                        <ul class="users-list clearfix">
                            @foreach($lastMembers as $member)
                            <li>
                                <img src="{{ FileHelper::get_file_path($member->image?->path, 'user') }}"
                                    alt="User Image">
                                <a class="users-list-name" href="#">{{$member->name}}</a>
                                <span class="users-list-date">{{$member->created_at->diffForHumans()}}</span>
                            </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.users.index') }}">View All Users</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <!-- DIRECT CHATS -->
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Chat Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="list-group">
                                    @forelse($chats as $chat)
                                    <a href="{{ route('admin.chats.chatForm', $chat->id) }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center py-3 px-2 shadow-sm mb-2 rounded"
                                        style="{{ $chat->unread_count > 0 ? 'border-left: 5px solid #ffc107;' : '' }}">
                                        <img src="{{ FileHelper::get_file_path($chat->image?->path, 'user') }}"
                                            class="img-circle elevation-2 mr-3" alt="User Image" width="48" height="48"
                                            style="object-fit: cover; border: 2px solid #ffc107;">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-{{ $chat->unread_count > 0 ? 'white' : 'muted' }}">{{
                                                    $chat->name }}</span>
                                                <small class="text-{{ $chat->unread_count > 0 ? 'white' : 'muted' }}">{{
                                                    $chat->latest_message?
                                                    $chat->latest_message->updated_at->diffForHumans() : '' }}</small>
                                            </div>
                                            <p class="mb-0 text-{{ $chat->unread_count > 0 ? 'white' : 'secondary' }}"
                                                style="font-size: 0.95em;">
                                                {{ ($chat->latest_message->sender == auth('admin')->id()?"You:" :"" ).
                                                Str::limit($chat->latest_message->message, 50) }}
                                            </p>
                                        </div>
                                        @if($chat->unread_count ?? 0)
                                        <span title="New Messages" class="badge badge-warning">
                                            {{ $chat->unread_count ?? 0 }}
                                        </span>
                                        @endif
                                    </a>
                                    @empty
                                    <div class="list-group-item text-center">
                                        No chats found.
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.chats.index') }}" class="btn btn-warning">Show All Chats</a>
                    </div>
                </div>
                <!--/.direct-chat -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col -->

    </div>
    <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection