<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentProgressController extends Controller
{
    public function index(User $student)
    {
        // Verificar se o usuário é um aluno
        if ($student->role !== 'user_student') {
            abort(404);
        }

        // Verificar se o aluno pertence à mesma instituição
        if ($student->institution_id !== auth()->user()->institution_id) {
            abort(403);
        }

        return view('admin.students.progress.index', compact('student'));
    }

    public function create(User $student)
    {
        // Verificar se o usuário é um aluno
        if ($student->role !== 'user_student') {
            abort(404);
        }

        // Verificar se o aluno pertence à mesma instituição
        if ($student->institution_id !== auth()->user()->institution_id) {
            abort(403);
        }

        return view('admin.students.progress.create', compact('student'));
    }

    public function store(Request $request, User $student)
    {
        // Verificar se o usuário é um aluno
        if ($student->role !== 'user_student') {
            abort(404);
        }

        // Verificar se o aluno pertence à mesma instituição
        if ($student->institution_id !== auth()->user()->institution_id) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:1000',
            'category' => 'required|string|max:255',
            'status' => 'required|in:melhorou,manteve,piorou',
        ]);

        // Aqui você pode salvar o andamento em uma tabela específica
        // Por enquanto, vou apenas redirecionar com uma mensagem de sucesso

        return redirect()
            ->route('admin.students.progress.index', $student)
            ->with('success', 'Andamento registrado com sucesso!');
    }
} 