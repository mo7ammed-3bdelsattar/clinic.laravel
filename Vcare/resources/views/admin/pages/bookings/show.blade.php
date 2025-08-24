@extends('admin.master')
@section('title', 'Booking Details')
@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Booking Details</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="booking_id">Booking ID</label>
                <input type="text" class="form-control" id="booking_id" value="{{ $booking->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" class="form-control" id="patient_name" value="{{ $booking->patient->user->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="patient_email">Patient Email</label>
                <input type="text" class="form-control" id="patient_email" value="{{ $booking->patient->user->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="doctor_name">Doctor Name</label>
                <input type="text" class="form-control" id="doctor_name" value="{{ $booking->doctor->user->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="appointment_time">Appointment Time</label>
                <input type="text" class="form-control" id="appointment_time" value="{{ $booking->appointment->time() }}" readonly>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" value="{{ $booking->status }}" readonly>
            </div>
            <div class="form-group">
                <label for="created_at">Created At</label>
                <input type="text" class="form-control" id="created_at" value="{{ $booking->created_at->format('Y-m-d H:i:s') }}" readonly>
            </div>
            <div class="form-group">
                <label for="updated_at">Updated At</label>
                <input type="text" class="form-control" id="updated_at" value="{{ $booking->updated_at->format('Y-m-d H:i:s') }}" readonly>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection