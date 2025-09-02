<?php

namespace App\Http\Controllers\Site;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index(Request $request ){
        $doctors= Doctor::with('user','user.image','major')->orderBy('id','desc')->paginate(9);
        return view('site.pages.doctors',compact('doctors'));
    }
    public function show(string $id){
        $doctor = Doctor::with('user','user.image','major')->where('user_id',$id)->first();
        return view('site.pages.doctor-show',compact('doctor'));
    }
}
