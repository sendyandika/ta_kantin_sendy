<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Debugging: Cek apakah user sudah login
        if (!Auth::check()) {
            abort(403, 'User belum login');
        }

        // Debugging: Cek apakah user memiliki role 'admin'
        if (Auth::user()->role !== 'admin') {
            abort(403, 'User bukan admin. Role: ' . Auth::user()->role);
        }

        return $next($request);
    }
}
