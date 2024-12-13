<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\AuthenticationException;

class Authenticate
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
         // Mengecek apakah pengguna sudah terautentikasi
         if (Auth::guard($guard)->check()) {
            return $next($request);
        }

        // Jika tidak terautentikasi, lemparkan exception atau redirect ke login
        throw new AuthenticationException('Unauthenticated.');
    }
}
