<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika user adalah customer, logout dan redirect
        if(Auth::check() && Auth::user()->role === 'customer') {
             Auth::logout();
             return redirect(route('home'))->withErrors('Anda tidak memiliki hak akses admin.');
        }

        // Jika belum login, redirect ke form login admin
        return redirect(route('admin.login.form'));
    }
}
