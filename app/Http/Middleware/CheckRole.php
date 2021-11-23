<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if($role == 'superAdmin' && auth()->user()->user_type != 'superAdmin'){
            abort(403);
        }
        // if($role == ['superAdmin','admin'] || auth()->user()->user_type != 'superAdmin'){
        //     abort(403);
        // }
        if($role == 'admin' && auth()->user()->user_type != 'admin'){
            abort(403);
        }
        if($role == 'seller' && auth()->user()->user_type != 'seller'){
            abort(403);
        }
        if($role == 'user' && auth()->user()->user_type != 'user'){
            abort(403);
        }

        return $next($request);
    }
}
