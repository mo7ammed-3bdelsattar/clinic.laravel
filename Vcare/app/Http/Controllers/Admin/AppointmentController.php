<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create');
    }

    public function store(AppointmentRequest $request)
    {
        Appointment::create($request->validated());
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully');
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    public function update(AppointmentRequest $request,Appointment $appointment)
    {

        $appointment->update($request->validated());
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }
}
