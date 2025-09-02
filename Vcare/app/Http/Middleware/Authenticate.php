<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    
    public function handle($request, Closure $next, ...$guards)
    {
        $user = Auth::guard('web')->user()??Auth::guard('admin')->user();
        
        if (!$user) {
            return redirect()->route('login.index')->with(['error'=>"Invalid request please login!"]);
        }

        return $next($request);
    }

    protected function redirectTo($request)
    {
            return $request->expectsJson() ? null: route('login.index');
    }
    

}
