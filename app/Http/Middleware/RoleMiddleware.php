<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $role
    ): Response {
        // Periksa apakah pengguna sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Periksa kesesuaian role pengguna
        if (auth()->user()->role !== $role) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}