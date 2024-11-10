<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anamnese;
use App\Models\Evolucao;
use Illuminate\Http\Request;

class EvolucaoController extends Controller
{
    public function create(Anamnese $anamnese)
    {
        return view('admin.evolucoes.create', compact('anamnese'));
    }

    public function store(Request $request, Anamnese $anamnese)
    {
        $request->validate([
            'descricao' => 'required|string',
            'status' => 'required|in:em_andamento,concluido,em_observacao',
            'data_evolucao' => 'required|date',
            'hora_evolucao' => 'required'
        ]);

        $anamnese->evolucoes()->create([
            'professional_id' => auth()->id(),
            'descricao' => $request->descricao,
            'status' => $request->status,
            'data_evolucao' => $request->data_evolucao,
            'hora_evolucao' => $request->hora_evolucao
        ]);

        return redirect()->route('admin.anamneses.show', $anamnese)
            ->with('success', 'Evolução registrada com sucesso!');
    }

    public function edit(Anamnese $anamnese, Evolucao $evolucao)
    {
        return view('admin.evolucoes.edit', compact('anamnese', 'evolucao'));
    }

    public function update(Request $request, Anamnese $anamnese, Evolucao $evolucao)
    {
        $request->validate([
            'descricao' => 'required|string',
            'status' => 'required|in:em_andamento,concluido,em_observacao',
            'data_evolucao' => 'required|date',
            'hora_evolucao' => 'required'
        ]);

        $evolucao->update($request->all());

        return redirect()->route('admin.anamneses.show', $anamnese)
            ->with('success', 'Evolução atualizada com sucesso!');
    }

    public function destroy(Anamnese $anamnese, Evolucao $evolucao)
    {
        $evolucao->delete();

        return redirect()->route('admin.anamneses.show', $anamnese)
            ->with('success', 'Evolução excluída com sucesso!');
    }
} 