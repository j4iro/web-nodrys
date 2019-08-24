<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $roles = func_get_args();
        $roles = array_slice($roles,2);

        if (auth()->user()->hasRoles($roles))
        {
            return $next($request);
        }

        return \redirect('/');
    }
}
