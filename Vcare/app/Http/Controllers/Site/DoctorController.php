<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __invoke(Request $request ){
        $doctors= Doctor::orderBy('visitors','desc')->paginate(9);
        return view('site.pages.doctors',compact('doctors'));
    }
}
