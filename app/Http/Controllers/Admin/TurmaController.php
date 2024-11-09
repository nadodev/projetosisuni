<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turma;
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

    public function edit($codigo)
    {
        $turma = Turma::findOrFail($codigo);
        return view('admin.turmas.edit', compact('turma'));
    }

    public function update(Request $request, $codigo)
    {
        $turma = Turma::findOrFail($codigo);

        $request->validate([
            'nome' => 'required|string|max:255|unique:turmas,nome,' . $turma->codigo . ',codigo',
            'quantidade_vagas' => 'required|integer|min:1'
        ]);

        $turma->update($request->all());

        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy($codigo)
    {
        $turma = Turma::findOrFail($codigo);
        $turma->delete();

        return redirect()->route('admin.turmas.index')
            ->with('success', 'Turma excluída com sucesso!');
    }
}
