<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anamnese;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;

class AnamneseController extends Controller
{
    public function index()
    {
        $anamneses = Anamnese::whereHas('student', function($query) {
            $query->where('id_instituicao', auth()->user()->id_instituicao);
        })->get();

        $turmas = Turma::where('id_instituicao', auth()->user()->id_instituicao)->get();
        $students = User::where('id_instituicao', auth()->user()->id_instituicao)
            ->where('role', 'user_student')
            ->get();

        return view('admin.anamneses.index', compact('anamneses', 'turmas', 'students'));
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
