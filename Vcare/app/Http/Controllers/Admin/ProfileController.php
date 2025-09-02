<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $user =auth('admin')->user() ?? abort(403, 'Unauthorized');
        $auth =$user->admin;
        return view('admin.pages.profile.index', compact('user','auth'));
    }
}
