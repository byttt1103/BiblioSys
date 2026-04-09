<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// Middleware que comprueba si el user esta autenticado y que su user_type sea admin
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if there's no session, redirect to the login page
        if( !Auth::check() ){
            return redirect('/login');
        }

        if(  Auth::user()->roles->pluck('name')->contains('admin') ){
            return $next($request);
        }
        else{
            abort(403, "No autorizado");
        }


    }
}
