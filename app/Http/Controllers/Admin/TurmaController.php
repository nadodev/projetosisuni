<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turma;
use Illuminate\Http\Request;
use App\Models\User;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::where('id_instituicao', auth()->user()->id_instituicao)
            ->orderBy('nome')
            ->get();
        return view('admin.turmas.index', compact('turmas'));
    }

    public function create()
    {
        return view('admin.turmas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade_vagas' => 'required|integer|min:1'
        ]);

        $turma = new Turma($validated);
        $turma->id_instituicao = auth()->user()->id_instituicao;
        $turma->quantidade_vagas = $validated['quantidade_vagas'];
        $turma->save();

        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma criada com sucesso!');
    }

    public function edit(Turma $turma)
    {
        return view('admin.turmas.edit', compact('turma'));
    }

    public function update(Request $request, Turma $turma)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:turmas,codigo,' . $turma->id
        ]);

        $turma->update($validated);

        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {

        $turma->delete();
        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma excluída com sucesso!');
    }

    public function atribuirTurmasIndex()
    {
        $turmas = Turma::where('id_institution', auth()->user()->id_institution)->get();
        $users = User::where('id_institution', auth()->user()->id_institution)
            ->where('role', 'user_student')
            ->with('turma')
            ->get();

        return view('admin.turmas.atribuir', compact('turmas', 'users'));
    }

    public function atribuirTurma(Request $request, User $user)
    {
        $request->validate([
            'turma_id' => 'required|exists:turmas,id'
        ]);

        $user->turma_id = $request->turma_id;
        $user->save();

        return back()->with('success', 'Turma atribuída com sucesso!');
    }
}
