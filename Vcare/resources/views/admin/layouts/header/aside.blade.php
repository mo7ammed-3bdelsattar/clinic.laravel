<?php
use Illuminate\Support\Facades\Auth;
$admin =Auth::guard('admin')->user();
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"> <b>{{env('APP_NAME')}}</b>Dashboard </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{route('admin.profile')}}" class="d-block">
                    <img src="{{FileHelper::get_file_path($admin->image?->path,'user')}}" class="img-circle elevation-2 " alt="User Image">
                    <span class="brand-text font-weight-light">{{$admin->name}}</span>
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
                            <a href="{{route('admin.dashboard')}}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @if (Gate::denies('doctor'))
                        <li class="nav-item">
                            <a href="{{route('admin.majors.index')}}" class="nav-link {{ Route::is('admin.majors.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Majors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.banners.index')}}" class="nav-link {{ Route::is('admin.banners.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banners</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.roles.index')}}" class="nav-link {{ Route::is('admin.roles.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.permissions.index')}}" class="nav-link {{ Route::is('admin.permissions.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.bookings.index')}}" class="nav-link {{ Route::is('admin.bookings.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bookings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.admins.index')}}" class="nav-link {{ Route::is('admin.admins.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.doctors.index')}}" class="nav-link {{ Route::is('admin.doctors.*')|| Route::is('admin.appointments.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Doctors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.patients.index')}}" class="nav-link {{ Route::is('admin.patients.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>patients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}" class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>