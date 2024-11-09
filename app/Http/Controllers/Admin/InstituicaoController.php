<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function index()
    {
        $instituicoes = Instituicao::all();
        return view('admin.instituicoes.index', compact('instituicoes'));
    }

    public function create()
    {
        return view('admin.instituicoes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:instituicoes'
        ]);

        Instituicao::create($request->all());

        return redirect()->route('admin.instituicoes.index')
            ->with('success', 'Instituição criada com sucesso!');
    }

    public function edit(Instituicao $instituicao)
    {
        return view('admin.instituicoes.edit', compact('instituicao'));
    }

    public function update(Request $request, Instituicao $instituicao)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:instituicoes,nome,' . $instituicao->id
        ]);

        $instituicao->update($request->all());

        return redirect()->route('admin.instituicoes.index')
            ->with('success', 'Instituição atualizada com sucesso!');
    }

    public function destroy(Instituicao $instituicao)
    {
        $instituicao->delete();
        return redirect()->route('admin.instituicoes.index')
            ->with('success', 'Instituição excluída com sucesso!');
    }
}
