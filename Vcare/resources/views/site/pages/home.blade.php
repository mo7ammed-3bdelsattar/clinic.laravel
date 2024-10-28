@extends('site.app')
@section('title','Home')

@section('content')
@include('site.layouts.header')
@include('inc.success')
<div class="container-fluid bg-blue text-white pt-3">
    <div class="container pb-0">
        <div class="row gap-2">
            <div class="col-sm order-sm-2">
                <img src={{asset('site/images/banner.jpg')}} class="img-fluid banner-img banner-img" alt="banner-image" height="200">
            </div>
            <div class="col-sm order-sm-1">
                <h1 class="h1">Have a Medical Question?</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque,
                    laborum
                    saepe
                    enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis
                    consequatur
                    cum
                    iure
                    quod facere.</p>
            </div>
        </div>
    </div>
</div>
    <svg viewBox="0 0 1440 240">
        <path fill="#0066cc" fill-opacity="1" d="M0,128L48,112C96,96,192,64,288,64C384,64,480,96,576,133.3C672,171,768,200,864,208C960,216,1056,192,1152,160C1248,128,1344,96,1392,80L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
    </svg>
<div class="container">
    <h2 class="h1 fw-bold text-center my-4">majors</h2>
    <div class="d-flex flex-wrap gap-4 justify-content-center">
    @foreach ($majors as $major)
        <div class="card p-2" style="width: 18rem;">
            <img src="{{FileHelper::get_file_path($major->image)}}" class="card-img-top rounded-circle card-image-circle" alt="major">
            <div class="card-body d-flex flex-column gap-1 justify-content-center">
                <h4 class="card-title fw-bold text-center">{{$major->title}}</h4>
                <a href="" class="btn btn-outline-primary card-button">Browse Doctors</a>
            </div>
        </div>
        @endforeach
    </div>
    <h2 class="h1 fw-bold text-center my-4">Best Five Doctors</h2>
    <section class="splide home__slider__doctors mb-5">
        <div class="splide__track ">
            <ul class="splide__list">
                @foreach ($doctors as $doctor)
                <li class="splide__slide">
                    <div class="card p-2" style="width: 18rem;">
                        <img src={{FileHelper::get_file_path($doctor->image,'user')}} class="card-img-top rounded-circle card-image-circle" alt="major">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center">
                            <h4 class="card-title fw-bold text-center">{{$doctor->name}}</h4>
                            <h6 class="card-title fw-bold text-center">{{$doctor->major->title}}</h6>
                            <a href="{{route("booking.index")}}" class="btn btn-outline-primary card-button">Book an
                                appointment</a>
                        </div>
                    </div>

                </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>

@endsection
@push('footer-scripts')
<script src={{asset("site/scripts/home.js")}}></script>
@endpush