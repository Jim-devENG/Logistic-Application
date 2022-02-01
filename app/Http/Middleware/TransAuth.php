<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransAuth
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
        $path = $request->path();

        if(($path=="admin-login" || $path=="sign-up") && (Session::has('login'))){

            return redirect('Dashboard');
        }elseif($path !='login'  && !Session::has('login')){
            return redirect('/login');
        }
        
        return $next($request);
    }
}
