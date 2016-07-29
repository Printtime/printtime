<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $auth = Auth::guard($guard);
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

/*        if (! $auth->user()->isSuperAdmin()) {
            return response('Access denied.', 401);
        }

            return $next($request);*/


        if ($auth->user()->isSuperAdmin()) {
            return $next($request);
        }
        
        if ($auth->user()->isManager()) {
            return $next($request);
        }
        
        if ($auth->user()->isDesigner()) {
            return $next($request);
        }
        
        if ($auth->user()->isPrinter()) {
            return $next($request);
        }
        
        if ($auth->user()->isStorekeeper()) {
            return $next($request);
        }

            return response('Access denied.', 401);
    }
}