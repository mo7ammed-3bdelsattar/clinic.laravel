@extends('admin.master')
@section('title','Create Booking')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Fill New Booking Data</h3>
    </div>
    <form action="{{route('admin.bookings.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="patient_id">Patient</label>
                <select name="patient_id" id="patient_id" class="form-control">
                    <option value="">Select Patient</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                    @endforeach
                </select>
                @error('patient_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select name="doctor_id" id="doctor" class="form-control">
                    <option value="">Select Doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                    @endforeach
                </select>
                @error('doctor_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="appointment_id">Appointment</label>
                <select name="appointment_id" id="appointment" class="form-control">
                    <option value="">Select Appointment</option>
                </select>
                @error('appointment_id')
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
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#doctor').on('change', function() {
        var doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '../doctor/' + doctorId + '/appointments',
                type: 'GET',
                success: function(data) {
                    $('#appointment').empty();
                    $('#appointment').append('<option value="">Select Appointment</option>');
                    $.each(data, function(key, appointment) {
                        $('#appointment').append('<option value="'+ appointment.id +'">'+ appointment.date +' - '+ appointment.start_at +' - '+ appointment.end_at +'</option>');
                    });
                }
            });
        } else {
            $('#appointment').empty();
            $('#appointment').append('<option value="">Select Appointment</option>');
        }
    });
</script>
@endpush