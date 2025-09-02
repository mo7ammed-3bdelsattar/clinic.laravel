<?php
use Illuminate\Support\Facades\Auth;
$doctor =auth()->user();
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('doctor.dashboard')}}" class="brand-link">
        <img src="{{asset('admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"> <b>{{env('APP_NAME')}}</b>Dashboard </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{route('doctor.profile')}}" class="d-block">
                    <img src="{{FileHelper::get_file_path($doctor->image?->path??'','user')}}" class="img-circle elevation-2 " alt="User Image">
                    <span class="brand-text font-weight-light">{{ $doctor->name }}</span>
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item " >
                            <a href="{{route('doctor.dashboard')}}" class="nav-link {{ Route::is('doctor.dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('doctor.bookings')}}" class="nav-link {{ Route::is('doctor.bookings.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bookings</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{route('doctor.patients.index')}}" class="nav-link {{ Route::is('doctor.patients.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>patients</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>