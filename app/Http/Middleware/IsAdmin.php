<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
   public function handle(Request $request, Closure $next)
{
    // Jika user login DAN role-nya admin, silakan lewat
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    // Jika bukan, tendang ke halaman home atau error 403
    return redirect('/')->with('error', 'Anda bukan admin!');
}
}