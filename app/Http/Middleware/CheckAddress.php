<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAddress
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->hasCompleteAddress()) {
            return redirect()->route('profile.edit')
                ->with('warning', 'Por favor, complete seu endereço para continuar.');
        }

        return $next($request);
    }
}
