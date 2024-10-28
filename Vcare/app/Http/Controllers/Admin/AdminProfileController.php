<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function __invoke(Request $request){
        $admin=Auth::guard('admin')->user();
        return view('admin.pages.profile.index',compact('admin'));
    }
}
