<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// middleware que comprueba si esta autenticado y es librero o admin
class BookerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //If there's no session, redirect to the login page
        if( !Auth::check() ){
            return redirect('/login');
        }

        // Si es un lector, no es ni admin ni librero
        if(  Auth::user()->roles->pluck('name')->contains('librarian') ){
            return $next($request);
        }
        else{
            abort(403, "No autorizado");
        }

        return $next($request);
    }
}
