<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Aaa
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
        //dd(Auth::user());
//        if (Auth::check()){
//            $user = Auth::user();
//            if ($user->name == null){
//                return redirect()->route('cabinet.settings');
//            }
//        }
//        return $next($request);
    }
}
