<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instituicao;
use App\Models\Plan;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function index()
    {
        $instituicoes = Instituicao::paginate(10);
        return view('admin.instituicoes.index', compact('instituicoes'));
    }

    public function create()
    {
        $instituicoes = Instituicao::paginate(10);
        $plans = Plan::all();
        return view('admin.instituicoes.create', compact('instituicoes', 'plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:instituicoes',
            'cnpj' => 'nullable|string|max:18',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'cep' => 'nullable|string|max:9',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|size:2',
            'numero' => 'nullable|integer',
            'complemento' => 'nullable|string|max:255',
            'plan_id' => 'nullable|exists:plans,id'
        ]);

        Instituicao::create($request->all());

        return redirect()->route('admin.instituicoes.index')
            ->with('success', 'Instituição criada com sucesso!');
    }

    public function edit(Instituicao $instituicao)
    {
        $plans = Plan::all();
        return view('admin.instituicoes.edit', compact('instituicao', 'plans'));
    }

    public function update(Request $request, Instituicao $instituicao)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:instituicoes,nome,' . $instituicao->id,
            'cnpj' => 'nullable|string|max:18',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'cep' => 'nullable|string|max:9',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|size:2',
            'numero' => 'nullable|integer',
            'complemento' => 'nullable|string|max:255',
            'plan_id' => 'nullable|exists:plans,id'
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
