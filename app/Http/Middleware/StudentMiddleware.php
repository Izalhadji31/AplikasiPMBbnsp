<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !(auth()->user()?->isStudent())) {
            abort(403, 'Akses ditolak. Hanya siswa yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
