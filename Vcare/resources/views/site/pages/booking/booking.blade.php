@extends('site.app')
@section('title','Booking')
@section('content')
@include('site.layouts.header')
<div class="container">
  <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb" class="fw-bold my-4 h4">
    <ol class="breadcrumb justify-content-center">
      <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{route("home.index")}}">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{route("doctors.index")}}">doctors</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        doctor name
      </li>
    </ol>
  </nav>
  <div class="d-flex flex-column gap-3 details-card doctor-details">
    <div class="details d-flex gap-2 align-items-center">
      <img src={{FileHelper::get_file_path($doctor->user->image?->path,'user')}}
      alt="doctor"
      class="img-fluid rounded-circle"
      height="150"
      width="150"
      />
      <div class="details-info d-flex flex-column ">
        <h5 class="card-title "><span class="card-title fw-bold">name: </span>{{ $doctor->user->name }}</h5>
        <p class="card-titl">
          <span class="card-title fw-bold">address: </span> {{ $doctor->address }}
        </p>
        <p class="card-titl">
          <span class="card-title fw-bold">price: </span> {{ $doctor->price }}
        </p>
      </div>
    </div>
    <hr />
    <form class="form d-flex flex-column gap-3" action="{{route('booking.store')}}" method="POST">
      @csrf
      <div class="form-items">
        <div class="mb-3">
          <label class="form-label required-label" for="appointment_id">Appointment</label>
          <select class="form-control" id="appointment_id" name="appointment_id">
            <option value="">Select a date</option>
            @foreach($doctor->appointments as $date)
            <option value="{{ $date->id }}">
              {{ \Carbon\Carbon::parse(\App\Enums\DaysEnum::from($date->date)->label())
            ->translatedFormat('l d/m/y')." ".$date->start_at." - ".$date->end_at }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <input type="hidden" name="patient_id" class="form-control" id="name" value="{{ Auth::user()->patient->id ?? (Auth::guard('admin')->user()->id ?? '') }}">
        </div>
        <div class="mb-3">
          <input type="hidden" name="doctor_id" class="form-control" id="name" value="{{ $doctor->id }}">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">
        Confirm Booking
      </button>
    </form>
  </div>
</div>
@endsection