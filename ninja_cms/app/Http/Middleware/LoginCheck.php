<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginCheck
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
        if(session()->get('session_login') == false || session()->get('session_login') == ''){
            return  redirect('login');
        }
        return $next($request);
    }
}
