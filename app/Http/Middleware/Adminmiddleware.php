<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth::check()){
            if(auth::user()->user_type=="admin"){
                return $next($request);
            }
            else{
                return redirect('/clinic_welcome')->with('status','Access Denied! as you are not as admin');
            }
        }
        else{
            return redirect('/clinic_welcome')->with('status','please login first');
        }

    }
}
