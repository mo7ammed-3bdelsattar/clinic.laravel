<?php

namespace App\Http\Controllers\Site;

use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MajorController extends Controller
{
    public function index(Request $request){
        $majors=Major::with('image')->paginate(9);
        
        return view('site.pages.majors',compact('majors'));
    }
    public function show(Major $major)
    {
        $doctors = $major->doctors()->with('user.image','user')->paginate(10);
        // dd($doctors);
        return view('site.pages.major-show', compact('major', 'doctors'));
    }
}
