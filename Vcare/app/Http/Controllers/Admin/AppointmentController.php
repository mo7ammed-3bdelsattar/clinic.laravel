<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
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
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('appointments.view'), 403);
        $appointments = Appointment::with('doctor.user')->where('doctor_id', $id)->get();
        return view('admin.pages.appointments.index', compact('appointments', 'id'));
    }

    public function create($id)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('appointments.create'), 403);
        $doctor = Doctor::findOrFail($id);
        $days = DaysEnum::all();
        // dd($doctor);
        return view('admin.pages.appointments.create', compact('days', 'doctor'));
    }

    public function store(AppointmentRequest $request)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('appointments.create'), 403);
        $data = $request->validated();
        $data['created_at'] = now();
        $appointment = Appointment::create($data);
        return redirect()->route('admin.appointments.index', $appointment->doctor_id)->with('success', 'Appointment created successfully');
    }

    public function edit(Appointment $appointment)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('appointments.update'), 403);
        return view('admin.pages.appointments.edit', compact('appointment'));
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('appointments.update'), 403);

        $appointment->update($request->validated());
        return redirect()->route('admin.pages.appointments.index', $appointment->doctor_id)->with('success', 'Appointment updated successfully');
    }

    public function destroy($id)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('appointments.delete'), 403);
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('admin.appointments.index', $appointment->doctor_id)->with('success', 'Appointment deleted successfully');
    }
}
