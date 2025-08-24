<?php

namespace App\Http\Controllers\Site;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function __invoke(Request $request ){
        $doctors= Doctor::with('user','user.image','major')->orderBy('id','desc')->paginate(9);
        return view('site.pages.doctors',compact('doctors'));
    }
}
