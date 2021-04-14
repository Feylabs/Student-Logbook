<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
        if (Auth::guard('guru')->check()) {
            return redirect('/guru');
        }
        if (Auth::guard('santri')->check()) {
            return redirect('/santri');
        }
        

        return $next($request);
    }
}
