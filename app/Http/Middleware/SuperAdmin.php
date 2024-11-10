<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->is_super_admin) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Acesso restrito ao super administrador.');
        }

        return $next($request);
    }
}
