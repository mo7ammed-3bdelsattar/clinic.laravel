<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function __invoke(Request $request){
        return view('admin.pages.profile.index');
    }
}
