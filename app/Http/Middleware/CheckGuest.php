<?php

namespace App\Http\Middleware;

use Closure;
use App\Member;

class CheckGuest
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
        //Check session
        if ( isset($_SESSION['username']) ){
            return $next($request);
        };


        //Check cookie
        if ( isset($_COOKIE['username']) ) {
            $cookieValue = $_COOKIE['username'];

            //If cookie value is valid:
            if (Member::where('remember_token', $cookieValue)->first()) {
                return $next($request);
            };
        };

        return redirect('/');

    }
}
