<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next)
    {

        if($request->user() === null) {
            return redirect()->guest('login');
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if($request->user()->hasAnyRole($roles) || !$roles) 
        {
                return $next($request);
        }
        return redirect()->guest('login');        
    }
}
