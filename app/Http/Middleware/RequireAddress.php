<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireAddress
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado
        if (auth()->check()) {
            $user = auth()->user();

            // Verifica se o usuário não tem endereço completo e não está em uma rota excluída
            if (!$user->hasCompleteAddress() &&
                !$request->is('profile*') &&
                !$request->is('logout')) {

                return redirect()->route('profile.edit')
                    ->with('warning', 'Por favor, complete seu endereço antes de continuar.');
            }
        }

        return $next($request);
    }
}
