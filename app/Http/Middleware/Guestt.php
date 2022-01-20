<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Guestt
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
        // return $next($request);
        if (Auth::check() && Auth::user()->role == 'guest') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'customer') {
            return redirect('/customer');
        }
        else {
            return redirect('/admin/home');
        }
    }
}
