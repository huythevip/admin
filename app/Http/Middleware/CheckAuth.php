<?php

namespace App\Http\Middleware;

use Closure;
use App\Member;

class CheckAuth
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
        session_start();
        if ( isset($_SESSION['username'])  ){
            return redirect('/home');
        };

        if ( isset($_COOKIE['username']) ){
            $cookieValue = $_COOKIE['username'];
            if ( Member::where('remember_token', $cookieValue)->first() ){
                $_SESSION['username'] = Member::where('remember_token', $cookieValue)->first()->name;
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
