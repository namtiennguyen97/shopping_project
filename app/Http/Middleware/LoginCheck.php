<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginCheck
{

    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('logged')){
//            return response()->json(['Error','You have to login or register new account!']);
            return redirect()->route('index')->with(['Error','You have to login or register new account!']);
        }
        return $next($request);
    }
}
