<?php

namespace App\Http\Controllers\Site\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function __invoke()
    {
        if(Auth::user()) {
            $route= 'login.index';
        } else if(Auth::guard('admin')->check()) {
            $route='admin.auth.login.index';
        }
        Session::flush();
        Auth::logout();
        return redirect()->route($route);
    }
}
