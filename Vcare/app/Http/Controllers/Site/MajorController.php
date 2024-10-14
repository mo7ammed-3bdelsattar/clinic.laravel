<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;


class MajorController extends Controller
{
    public function __invoke(Request $request,Major $majors){
        $majors=Major::paginate(9);
        
        return view('site.pages.majors',compact('majors'));
    }
}
