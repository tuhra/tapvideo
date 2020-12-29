<?php

namespace App\Http\Middleware;

use Closure;

class InsufficientMiddleware
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
        $is_not_enough = check_is_enough();
        if (TRUE == $is_not_enough) {
            return redirect(route('frontend.welcome'));
        } else {
           return $next($request); 
        }  
    }
}
