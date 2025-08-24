@extends('admin.master')
@section('title','Profile')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="{{FileHelper::get_file_path($admin->image?->path,'user')}}"
                                class="img-circle elevation-2 " alt="User Image">
                                <form action="{{route('admin.profile.updateImage',$admin->id)}}" class="py-1 d-inline" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control-file">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                                <form action="{{route('admin.profile.destroyImage',$admin->id)}}" class="py-1 d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this table?');">Delete</button>
                                </form>
                                <p class="text-muted text-center">{{$admin->type->label()}}</p>
                            </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-inbox mr-1"></i>Email</strong>

                            <p class="text-muted">
                                {{$admin->email}}
                            </p>

                            <hr>
                            @if ($admin->type=='doctor')


                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">{{$admin->doctor->adress}}</p>
                            <hr>
                            @endif

                            <strong><i class="fas fa-phone mr-1"></i>Phone</strong>

                            <p class="text-muted">
                                {{$admin->phone}}
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9 mx-auto">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings"
                                    data-toggle="tab">Settings</a></li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal"
                                    action="{{route('admin.profile.changePassword',$admin->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="currentPassword" class="col-sm-2 col-form-label">Old
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="currentPassword"
                                                id="inputName" placeholder="Current Password">
                                            @error('currentPassword')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="password" id="inputEmail"
                                                placeholder=" Password">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm" class="col-sm-2 col-form-label">Confirm
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="password_confirmation"
                                                id="confirm" placeholder="Confirm Password">
                                            @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection