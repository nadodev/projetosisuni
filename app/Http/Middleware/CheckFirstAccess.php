<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckFirstAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (isset($user->is_super_admin) && !$user->is_super_admin && !$user->institution_id) {
            session()->put('needs_institution_update', true);
            return redirect()->route('profile.edit');
        }

        return $next($request);
    }
}
