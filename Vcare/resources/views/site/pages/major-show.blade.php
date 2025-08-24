@extends('site.app')
@section('title','Doctors')

@section('content')
@include('site.layouts.header')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home.index")}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">doctors</li>
        </ol>
    </nav>
    <div class="doctors-grid">
        @foreach ($doctors as $doctor)
        <div class="card p-2" style="width: 18rem;">
            <img src={{FileHelper::get_file_path($doctor->user->image?->path,'user')}} class="card-img-top rounded-circle card-image-circle" alt="major">
            <div class="card-body d-flex flex-column gap-1 justify-content-center">
                <h4 class="card-title fw-bold text-center">{{$doctor->user->name}}</h4>
                <h6 class="card-title fw-bold text-center">{{$doctor->major->title}}</h6>
                <a href="{{route("booking.index", $doctor->id)}}" class="btn btn-outline-primary card-button">Book an
                    appointment</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="d-flex justify-content-center">
                    {{ $doctors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection