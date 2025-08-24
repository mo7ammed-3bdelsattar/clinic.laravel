@extends('site.app')
@section('title','Majors')

@section('content')
@include('site.layouts.header')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home.index")}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">majors</li>
        </ol>
    </nav>
    <div class="majors-grid">
        @foreach ($majors as $major)
        <div class="card p-2" style="width: 18rem;">
            <img src="{{FileHelper::get_file_path($major->image?->path)}}" class="card-img-top rounded-circle card-image-circle" alt="major">
            <div class="card-body d-flex flex-column gap-1 justify-content-center">
                <h4 class="card-title fw-bold text-center">{{$major->title}}</h4>
                <a href="{{ route('majors.show', $major->id) }}" class="btn btn-outline-primary card-button">Browse Doctors</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="d-flex justify-content-center">
                    {{ $majors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection