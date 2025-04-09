<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{

    public function index()
    {
        if(Auth::guard('admin')->user()){return redirect()->back();}
        return view('admin.pages.login');
    }
    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            if (!Admin::where('user_id', $user->id)->exists()) {
                Auth::guard('admin')->logout();
                return back()->withErrors(['email' => 'this user is not an admin']);
            }
            $request->session()->regenerate();
            return redirect()->intended('/admin/home',);
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email','password');
    }

}
