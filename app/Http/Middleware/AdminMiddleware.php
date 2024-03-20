<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    public function handle(Request $request, Closure $next): Response
    {
       if(Auth::check()&&Auth::user()->Role=='1') {
        return $next($request);
       }
       return redirect()->route('home');
    }
}
