<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anamnese;
use Illuminate\Http\Request;

class AnamneseController extends Controller
{
    public function index()
    {
        $anamneses = Anamnese::with(['student', 'professional', 'form'])->get();
        return view('admin.anamneses.index', compact('anamneses'));
    }

    public function show(Anamnese $anamnese)
    {
        $anamnese->load(['student', 'professional', 'form']);
        return view('admin.anamneses.show', compact('anamnese'));
    }

    public function edit(Anamnese $anamnese)
    {
        $anamnese->load(['form.fields', 'student', 'professional']);
        return view('admin.anamneses.edit', compact('anamnese'));
    }

    public function update(Request $request, Anamnese $anamnese)
    {
        $request->validate([
            'respostas' => 'required|array',
            'status' => 'required|in:pendente,em_andamento,concluida'
        ]);

        $anamnese->update([
            'respostas' => $request->respostas,
            'status' => $request->status
        ]);

        return redirect()->route('admin.anamneses.show', $anamnese)
            ->with('success', 'Anamnese atualizada com sucesso!');
    }
}
