<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class LoginAuth
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
        $auth=Auth::guard('home');
        $url=URL::current();
        if(!$auth->check()){
            return redirect('/Index/login')->with(['url.intended'=>$url]);
        }
        return $next($request);
    }
}
