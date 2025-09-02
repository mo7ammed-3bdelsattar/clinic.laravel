<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user()??auth()->user();

        if (!$user) {
            return redirect()->route('login.index')->withErrors(['error' => 'Please Login And Try Again!']);
        }elseif(!Admin::where('user_id', $user->id)->exists()){
            abort(403,'You are not have permission to access this page');
        }
        return $next($request);
    }
}
