<?php

namespace App\Http\Middleware;

use Session as FlashSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentRole
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
        if (Auth::check() &&  Auth::user()->isStudent()) {
             return $next($request);
        }

        if(!Auth::check()){
            return redirect('/login');
        }

        FlashSession::flash('primary','No cuentas con los permisos');
        return redirect('/');
    }
}
