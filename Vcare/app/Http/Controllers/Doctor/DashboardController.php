<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        abort_if(!auth()->user()->doctor,403,'Unauthorize');
        $bookings = Booking::where('doctor_id',auth()->user()->doctor->id)
        ->with('doctor.user','patient.user')->paginate(10);
        $patientsCount = Booking::where('doctor_id',auth()->user()->doctor->id)
        ->distinct('patient_id')->count('patient_id');
         $totalAmount = Booking::join('doctors', 'bookings.doctor_id', '=', 'doctors.id')
            ->where('bookings.doctor_id',auth()->user()->doctor->id)
            ->where('bookings.status', 'visited')
            ->selectRaw('SUM(doctors.price) as total')
            ->pluck('total')
            ->first();
        return view('doctor.pages.dashboard',compact("bookings","totalAmount","patientsCount"));
    }
}
