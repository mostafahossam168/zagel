<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->type->value != 'admin') {
            return redirect()->route('dashboard.login')->with('error', 'ليس لديك صلاحيه الوصول لهذه الصفحه');
        }

        return $next($request);
    }
}