<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'user_teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
