<?php

namespace App\Http\Controllers\Site;

use App\Models\Doctor;
use App\Models\Booking;
use App\Mail\BookingMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function index(Doctor $doctor){
        
        return view('site.pages.booking.booking',compact('doctor'));
    }
    public function store(BookingRequest $request){
        $data = $request->validated();
        // dd($data);
        $patient = Auth::user()->patient->user;
        $booking=Booking::create($data);
        $date=rand(date('H', (int)$booking->appointment->start_at), date('H', (int)$booking->appointment->end_at));
        $mailData = [
            'bookingNumber' => '2025'.($booking->id+rand(1, 100)),
            'doctorName' => $booking->appointment->doctor->user->name,
            'patientName' => Auth::user()->name,
            'date' => date('h:i', $date),
            'day'=>\App\Enums\DaysEnum::from($booking->appointment->date)->label(),
        ];
        Mail::to($patient->email)->send(new BookingMail($mailData));

        return redirect()->route('home.index')->with('success', 'Booking successfully created.');
    }
    public function appointments(){
        // dd(Auth::user()->patient->id);
        $books = Booking::with('appointment','doctor','doctor.user', 'patient','patient.user')
        ->where('patient_id', Auth::user()->patient->id)
        ->where('status','!=', 'cancelled')->get();
        // dd($books);

        return view('site.pages.booking.books', compact('books'));
    }
    public function cancel($id){
        $booking = Booking::findOrFail($id);
        if ($booking && $booking->update(['status' => 'cancelled'])) {
            return redirect()->back()->with('success', 'Booking cancelled successfully.');
        }
        return redirect()->back()->with('error', 'No booking found to cancel.');
    }
}
