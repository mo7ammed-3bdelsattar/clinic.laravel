<?php

namespace App\Http\Controllers\Site;

use App\Models\Major;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(Request $request){
        $doctors=Doctor::orderBy('id','desc')->paginate(5);
        $majors=Major::get();
        return view('site.pages.home',compact(['doctors','majors']));
    }
}
