<?php

namespace App\Http\Middleware;

use App\Http\UserFacade;
use Closure;
use Illuminate\Http\Request;

class AdminCheck
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
        if (session()->has('logged')){
            if (UserFacade::getUser()->role_id == 2){
                return $next($request);
            } else{
                return false;
            }
        }
        return false;

    }
}
