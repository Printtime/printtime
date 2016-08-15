<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        #return false;
        #return $next($request);
        $auth = Auth::guard($guard);
       # dd($auth->user());
        
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        
        // if ($auth->user()) {
        //     if ($auth->user()->isUser()) {
        //         return $next($request);
        //     }
        // }
        
        #return redirect()->guest('login');
        #return response('Access denied.', 401);
        
    }
}
