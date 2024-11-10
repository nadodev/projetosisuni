<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turma;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function turmas()
    {
        $turmas = Turma::with(['professor', 'alunos'])
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->get()
            ->map(function ($turma) {
                return [
                    'nome' => $turma->nome,
                    'professor' => $turma->professor?->name ?? 'Sem professor',
                    'total_alunos' => $turma->alunos->count(),
                    'created_at' => $turma->created_at->format('d/m/Y'),
                ];
            });

        return view('admin.reports.turmas', compact('turmas'));
    }

    public function categorias()
    {
        $categorias = Categoria::withCount(['users' => function($query) {
            $query->where('id_instituicao', auth()->user()->id_instituicao);
        }])->get();

        return view('admin.reports.categorias', compact('categorias'));
    }

    public function estudantes()
    {
        $estudantes = User::with(['turma', 'categoria'])
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->where('role', 'user_student')
            ->get()
            ->map(function ($estudante) {
                return [
                    'nome' => $estudante->name,
                    'email' => $estudante->email,
                    'turma' => $estudante->turma?->nome ?? 'Sem turma',
                    'categoria' => $estudante->categoria?->nome ?? 'Sem categoria',
                    'created_at' => $estudante->created_at->format('d/m/Y'),
                ];
            });

        return view('admin.reports.estudantes', compact('estudantes'));
    }

    public function professores()
    {
        $professores = User::with(['turmas'])
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->where('role', 'user_teacher')
            ->get()
            ->map(function ($professor) {
                return [
                    'nome' => $professor->name,
                    'email' => $professor->email,
                    'total_turmas' => $professor->turmas->count(),
                    'turmas' => $professor->turmas->pluck('nome')->join(', '),
                    'created_at' => $professor->created_at->format('d/m/Y'),
                ];
            });

        return view('admin.reports.professores', compact('professores'));
    }

    public function usuariosPorCategoria()
    {
        $usuarios = DB::table('users')
            ->join('categorias', 'users.categoria_id', '=', 'categorias.id')
            ->where('users.id_instituicao', auth()->user()->id_instituicao)
            ->select('categorias.nome as categoria', 'users.role', DB::raw('count(*) as total'))
            ->groupBy('categorias.nome', 'users.role')
            ->get();

        return view('admin.reports.usuarios-por-categoria', compact('usuarios'));
    }

    public function exportTurmasPDF()
    {
        $turmas = Turma::with(['professor', 'alunos'])
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->get()
            ->map(function ($turma) {
                return [
                    'nome' => $turma->nome,
                    'professor' => $turma->professor?->name ?? 'Sem professor',
                    'total_alunos' => $turma->alunos->count(),
                    'created_at' => $turma->created_at->format('d/m/Y'),
                ];
            });

        $pdf = PDF::loadView('admin.reports.pdf.turmas', compact('turmas'));
        return $pdf->download('relatorio-turmas.pdf');
    }

    public function exportCategoriasPDF()
    {
        $categorias = Categoria::withCount(['users' => function($query) {
            $query->where('id_instituicao', auth()->user()->id_instituicao);
        }])->get();

        $pdf = PDF::loadView('admin.reports.pdf.categorias', compact('categorias'));
        return $pdf->download('relatorio-categorias.pdf');
    }

    public function exportUsuariosPorCategoriaPDF()
    {
        $usuarios = DB::table('users')
            ->join('categorias', 'users.categoria_id', '=', 'categorias.id')
            ->where('users.id_instituicao', auth()->user()->id_instituicao)
            ->select('categorias.nome as categoria', 'users.role', DB::raw('count(*) as total'))
            ->groupBy('categorias.nome', 'users.role')
            ->get();

        $pdf = PDF::loadView('admin.reports.pdf.usuarios-por-categoria', compact('usuarios'));
        return $pdf->download('relatorio-usuarios-por-categoria.pdf');
    }

    public function exportProfessoresPDF()
    {
        $professores = User::with(['turmas'])
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->where('role', 'user_teacher')
            ->get()
            ->map(function ($professor) {
                return [
                    'nome' => $professor->name,
                    'email' => $professor->email,
                    'total_turmas' => $professor->turmas->count(),
                    'turmas' => $professor->turmas->pluck('nome')->join(', '),
                    'created_at' => $professor->created_at->format('d/m/Y'),
                ];
            });

        $pdf = PDF::loadView('admin.reports.pdf.professores', compact('professores'));
        return $pdf->download('relatorio-professores.pdf');
    }

    public function exportEstudantesPDF()
    {
        $estudantes = User::with(['turma', 'categoria'])
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->where('role', 'user_student')
            ->get()
            ->map(function ($estudante) {
                return [
                    'nome' => $estudante->name,
                    'email' => $estudante->email,
                    'turma' => $estudante->turma?->nome ?? 'Sem turma',
                    'categoria' => $estudante->categoria?->nome ?? 'Sem categoria',
                    'created_at' => $estudante->created_at->format('d/m/Y'),
                ];
            });

        $pdf = PDF::loadView('admin.reports.pdf.estudantes', compact('estudantes'));
        return $pdf->download('relatorio-estudantes.pdf');
    }
}
