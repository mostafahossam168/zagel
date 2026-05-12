<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('user.login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        if (auth()->user()->type->value === 'admin') {
            return redirect()->route('dashboard.home');
        }

        if (auth()->user()->status->value !== 'active') {
            auth()->logout();
            return redirect()->route('user.login')->with('error', 'حسابك موقوف، تواصل مع الدعم');
        }

        return $next($request);
    }
}
