<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Enums\DaysEnum;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{

    public function index($id)
    {
        $appointments = Appointment::with('doctor.user')->where('doctor_id', $id)->get();
        return view('admin.pages.appointments.index', compact('appointments', 'id'));
    }

    public function create($id)
    {
        $doctor = Doctor::findOrFail($id);
        $days = DaysEnum::all();
        // dd($doctor);
        return view('admin.pages.appointments.create', compact('days', 'doctor'));
    }

    public function store(AppointmentRequest $request)
    {
        // dd($request->validated());
        $data = $request->validated();
        $data['created_at'] = now();
        $appointment = Appointment::create($data);
        return redirect()->route('admin.appointments.index', $appointment->doctor_id)->with('success', 'Appointment created successfully');
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.pages.appointments.edit', compact('appointment'));
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {

        $appointment->update($request->validated());
        return redirect()->route('admin.pages.appointments.index', $appointment->doctor_id)->with('success', 'Appointment updated successfully');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('admin.appointments.index', $appointment->doctor_id)->with('success', 'Appointment deleted successfully');
    }
}
