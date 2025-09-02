<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Services\ProfileService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $auth=$user;
        return view('site.pages.profile', compact('user','auth'));
    }
    public function updateImage(Request $request)
    {
        ProfileService::updateImage($request);
        return redirect()->back()->with('success', 'image updated successfully');
    }
    public function destroyImage()
    {
        ProfileService::destroyImage();
        return redirect()->back()->with('success', 'image deleted successfully');
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        ProfileService::changePassword($request);
        return redirect()->back()->with('success', 'the password updated successfully');
    }
}
