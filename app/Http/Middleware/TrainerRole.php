<?php

namespace App\Http\Middleware;

use Session as FlashSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() &&
            Auth::user()->isTrainer()) {
             return $next($request);
        }
        FlashSession::flash('primary','No cuentas con los permisos');
        return redirect('/');
    }
}
