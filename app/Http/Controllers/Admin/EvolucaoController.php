<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anamnese;
use App\Models\Evolucao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EvolucaoController extends Controller
{
    public function create(Anamnese $anamnese)
    {
        return view('admin.evolucoes.create', compact('anamnese'));
    }

    public function store(Request $request, Anamnese $anamnese)
    {

        try {
            $validated = $request->validate([
                'data_evolucao' => 'required|date',
                'hora_evolucao' => 'required',
                'descricao' => 'required|string',
                'status' => 'required|in:em_andamento,em_observacao,concluido'
            ]);




            $evolucao = new Evolucao();
            $evolucao->anamnese_id = $anamnese->id;
            $evolucao->professional_id = auth()->id();
            $evolucao->id_institution = $anamnese->id_instituicao ?? auth()->user()->id_instituicao;
            $evolucao->data_evolucao = $validated['data_evolucao'];
            $evolucao->hora_evolucao = $validated['hora_evolucao'];
            $evolucao->descricao = $validated['descricao'];
            $evolucao->status = $validated['status'];
            $evolucao->save();

            return redirect()->route('admin.anamneses.show', $anamnese)
                ->with('success', 'Evolução registrada com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao salvar evolução: ' . $e->getMessage(), [
                'anamnese_id' => $anamnese->id,
                'id_institution' => $anamnese->id_institution ?? null,
                'user_id_institution' => auth()->user()->id_institution ?? null,
                'student_id_institution' => $anamnese->student->id_institution ?? null,
                'professional_id_institution' => $anamnese->professional->id_institution ?? null
            ]);

            return back()
                ->withInput()
                ->with('error', 'Erro ao salvar evolução: ' . $e->getMessage());
        }
    }

    public function edit(Anamnese $anamnese, Evolucao $evolucao)
    {
        return view('admin.evolucoes.edit', compact('anamnese', 'evolucao'));
    }

    public function update(Request $request, Anamnese $anamnese, Evolucao $evolucao)
    {
        $validated = $request->validate([
            'data_evolucao' => 'required|date',
            'hora_evolucao' => 'required',
            'descricao' => 'required|string',
            'status' => 'required|in:em_andamento,em_observacao,concluido'
        ]);

        try {
            $evolucao->update([
                'data_evolucao' => Carbon::parse($validated['data_evolucao']),
                'hora_evolucao' => Carbon::parse($validated['hora_evolucao']),
                'descricao' => $validated['descricao'],
                'status' => $validated['status']
            ]);

            return redirect()
                ->route('admin.anamneses.show', $anamnese)
                ->with('success', 'Evolução atualizada com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar evolução: ' . $e->getMessage());
        }
    }

    public function destroy(Anamnese $anamnese, Evolucao $evolucao)
    {
        $evolucao->delete();

        return redirect()->route('admin.anamneses.show', $anamnese)
            ->with('success', 'Evolução excluída com sucesso!');
    }
}
