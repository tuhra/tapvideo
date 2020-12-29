<?php

namespace App\Http\Middleware;

use Closure;

class MyIdAuthMiddleware
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
        $data = $request->all();
        if(empty($data)) {
            dd('invalid credential');
        }
        if(!array_key_exists('myid_auth_password', $data)) {
            dd('invalid credential');
        }

        $password = $data['myid_auth_password'];
        if ($password === 'taptubemyid@tech2020') {
            return $next($request);
        } else {
            dd('Invalid credential');
        }
    }
}
