@extends('admin.master')
@section('title', 'Create Appointment')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Fill New Appointment Data</h3>
    </div>
    <form action="{{route('admin.appointments.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="Doctor">Doctor</label>
                <select name="doctor_id" class="form-control" id="Doctor">
                    <option value="{{$doctor->id}}">{{$doctor->user->name}}</option>
                </select>
                @error('doctor_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <select name="date" id="date" class="form-control">
                    <option value="">Select Date</option>
                    @foreach ($days as $day)
                        <option value="{{ $day }}">{{ \App\Enums\DaysEnum::from($day)->label()}}</option>
                    @endforeach
                </select>
                @error('date')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_at">Start At</label>
                <input name="start_at" type="time" class="form-control" id="start_at"></input>
                @error('start_at')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_at">End At</label>
                <input name="end_at" type="time" class="form-control" id="end_at"></input>
                @error('end_at')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</div>
@endsection