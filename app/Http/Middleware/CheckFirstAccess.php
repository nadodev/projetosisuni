<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckFirstAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (isset($user->is_super_admin) && !$user->is_super_admin && !$user->id_instituicao) {
            session(['needs_institution_update' => true]);
        }

        return $next($request);
    }
}
