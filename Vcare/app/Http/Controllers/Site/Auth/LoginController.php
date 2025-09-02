<?php

namespace App\Http\Controllers\Site\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user() || Auth::guard('admin')->user()) {
            return redirect()->back();
        }
        return view('site.pages.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = User::whereEmail($request['email'])->first();
            // dd($user->type->value == 1);
            $request->session()->regenerate();
            if ($user->type->value == 4):
                return redirect()->intended('/')->with('success', "you're logged in now!");
            elseif ($user->type->value == 1 || $user->type->value == 2):
                if (Auth::guard('admin')->attempt($credentials)) :
                    unset($user);
                    $user = auth('admin')->user();
                // Session::flush();
                // Auth::logout();
                return redirect()->route('admin.dashboard')->with('success', "you're logged in now!");
                endif;
            else:
                return redirect()->route('doctor.dashboard')->with('success', "you're logged in now!");
            endif;
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
