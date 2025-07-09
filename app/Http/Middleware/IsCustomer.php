<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (Auth::check() && Auth::user()->role == 2) {
    //         return $next($request);
    //     }
    //     return redirect('/beranda')->with('msgError', 'Anda harus login sebagai customer');
    // }
}
