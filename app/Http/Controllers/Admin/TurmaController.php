<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::all();
        return view('admin.turmas.index', compact('turmas'));
    }

    public function create()
    {
        return view('admin.turmas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:turmas',
            'quantidade_vagas' => 'required|integer|min:1'
        ]);

        Turma::create($request->all());

        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma criada com sucesso!');
    }

    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        return view('admin.turmas.edit', compact('turma'));
    }

    public function update(Request $request, $id)
    {
        $turma = Turma::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255|unique:turmas,nome,' . $turma->id . ',id',
            'quantidade_vagas' => 'required|integer|min:1'
        ]);

        $turma->update($request->all());

        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();

        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma excluída com sucesso!');
    }

    public function atribuirTurmasIndex()
    {
        $students = User::where('role', 'user_student')
            ->when(!auth()->user()->is_super_admin, function($query) {
                $query->where('id_instituicao', auth()->user()->id_instituicao);
            })
            ->get();

        $turmas = Turma::when(!auth()->user()->is_super_admin, function($query) {
                $query->where('id_instituicao', auth()->user()->id_instituicao);
            })
            ->get();

        return view('admin.atribuir-turmas.index', compact('students', 'turmas'));
    }

    public function atribuirTurma(Request $request, User $user)
    {
        if ($user->role !== 'user_student') {
            return back()->with('error', 'Apenas estudantes podem ser atribuídos a turmas.');
        }

        $request->validate([
            'codigo_turma' => 'required|exists:turmas,codigo'
        ]);

        $user->update([
            'codigo_turma' => $request->codigo_turma
        ]);

        return back()->with('success', 'Turma atribuída com sucesso!');
    }
}
