<?php

namespace App\Http\Controllers\Site;

use App\Models\Major;
use App\Models\Banner;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(Request $request){
        $majors=Major::with( 'image')->get();
        $doctors=Doctor::with('user','user.image','major')->orderBy('id','desc')->paginate(5);
        $banner_home=Banner::with('image')->where('name','home')->first();
        return view('site.pages.home',compact(['doctors','majors','banner_home']));
    }
}
