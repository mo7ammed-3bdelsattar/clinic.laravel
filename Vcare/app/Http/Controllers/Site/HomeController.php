<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request){
        $doctors=Doctor::orderBy('visitors','desc')->paginate(5);
        $majors=Major::get();
        return view('site.pages.home',compact(['doctors','majors']));
    }
}
