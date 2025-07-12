<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'user_admin') {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
