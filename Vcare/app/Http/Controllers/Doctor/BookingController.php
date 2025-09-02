<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $auth = auth()->user();
        abort_if(!$auth->doctor, 403, 'Unauthorize');
        $bookings = Booking::where('doctor_id', auth()->user()->doctor->id)
            ->with('patient.user', 'doctor.user')->paginate(10);
        return view('doctor.pages.bookings', compact('bookings'));
    }
    public function show(string $id)
    {
        $auth = auth()->user();
        abort_if(!$auth->doctor, 403, 'Unauthorize');
        $booking = Booking::with('patient.user', 'doctor.user')->findOrFail($id);
        return view('doctor.pages.bookings-show', compact('booking'));
    }
    public function update(Request $request,string $id)
    {
        $booking = Booking::findOrFail($id);
        $auth = auth()->user();
        abort_if(!$auth || $auth->cannot('bookings.update'), 403);
        $validated = $request->validate([
            'status' => 'required|in:cancelled,visited,pending',
            'updated_at' => now(),
        ]);
        $booking->update($validated);
        return redirect()->back()->with('success', 'Booking updated successfully.');
    }
}
