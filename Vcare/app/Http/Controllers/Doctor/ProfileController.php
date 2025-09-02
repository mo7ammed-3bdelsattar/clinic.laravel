<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Services\ProfileService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $auth=$user;
        return view('doctor.pages.profile', compact('user','auth'));
    }
}
