<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turma;
use App\Models\Instituicao;
use App\Models\Form;
use App\Models\Plan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = [
            'totalUsers' => User::count(),
            'totalTurmas' => Turma::count(),
            'totalInstituicoes' => Instituicao::count(),
            'totalForms' => Form::count(),
            'totalPlans' => Plan::count(),
            
            // Últimas 5 instituições com seus planos e número de usuários
            'recentInstituicoes' => [],
            
            // Últimos 5 usuários com suas instituições
            'recentUsers' => User::with('institution')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'instituicao' => $user->institution?->nome ?? 'Sem instituição',
                        'created_at' => $user->created_at->format('d/m/Y H:i')
                    ];
                }),
            
            // Últimas 5 turmas com suas instituições
            'recentTurmas' => Turma::with('institution')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($turma) {
                    return [
                        'id' => $turma->id,
                        'nome' => $turma->nome,
                        'instituicao' => $turma->institution?->nome ?? 'Sem instituição',
                        'created_at' => $turma->created_at->format('d/m/Y')
                    ];
                }),

            // Estatísticas por estado
                'estadosStats' => [],
        ];
        $users = User::all();
        return view('admin.dashboard', $data, compact('users'));
    }
} 