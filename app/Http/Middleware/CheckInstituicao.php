<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInstituicao
{
    public function handle(Request $request, Closure $next)
    {
        // Se não estiver autenticado, redireciona para login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Se for super admin, permite acesso a tudo
        if ($user->is_super_admin) {
            return $next($request);
        }

        // Se não tem instituição e não é super admin, redireciona
        if (!$user->institution_id) {
            session()->put('needs_institution_update', true);
            return redirect()->route('profile.edit');
        }

        // Verifica se está tentando acessar recursos de outra instituição
        if ($request->route('user')) {
            $requestedUser = $request->route('user');
            if ($requestedUser->institution_id !== $user->institution_id) {
                abort(403, 'Você não tem permissão para acessar este usuário.');
            }
        }

        return $next($request);
    }
}
