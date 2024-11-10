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
        if (!$user->id_instituicao) {
            return redirect()->route('home')
                ->with('error', 'Você precisa estar vinculado a uma instituição.');
        }

        // Verifica se está tentando acessar recursos de outra instituição
        if ($request->route('user')) {
            $requestedUser = $request->route('user');
            if ($requestedUser->id_instituicao !== $user->id_instituicao) {
                return redirect()->back()
                    ->with('error', 'Você não tem permissão para acessar dados de outras instituições.');
            }
        }

        return $next($request);
    }
}
