<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth =auth('admin')->user()->admin ?? auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.view'), 403);
        $bookings = Booking::with('patient.user', 'doctor.user')->paginate(10);
        return view('admin.pages.bookings.index', compact('bookings','auth'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auth =auth('admin')->user()->admin ?? auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.create'), 403);
        $doctors = Doctor::with('user')->get();
        $patients = Patient::with('user')->get();
        return view('admin.pages.bookings.create', compact('doctors', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {$auth =auth('admin')->user()->admin ?? auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.create'), 403);
        $validated = $request->validated();
        Booking::create($validated);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auth =auth('admin')->user()->admin ?? auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.view'), 403);
        $booking = Booking::with('patient.user', 'doctor.user')->findOrFail($id);
        return view('admin.pages.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $auth =auth('admin')->user()->admin ?? auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.update'), 403);
        return view('admin.pages.bookings.index', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $auth =auth('admin')->user()->admin ?? auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.update'), 403);
        $validated = $request->validate([
            'status' => 'required|in:cancelled,visited,pending',
            'updated_at' => now(),
        ]);
        $booking->update($validated);
        return redirect()->back()->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $auth =auth('admin')->user()->admin ?? auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.delete'), 403);
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
    public function getDoctorAppointments($id)
    {
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('appointments.create'), 403);
        $appointments = Appointment::where('doctor_id', $id)->get();
        return response()->json($appointments);
    }
}
