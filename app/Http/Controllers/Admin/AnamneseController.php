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
        $anamneses = Anamnese::with(['student', 'professional'])
            ->whereHas('student', function($query) {
                $query->where('institution_id', auth()->user()->institution_id);
            })
            ->select('id', 'student_id', 'professional_id', 'status', 'uuid', 'form_id')
            ->paginate(10);

        $turmas = Turma::where('institution_id', auth()->user()->institution_id)->get();
        $students = User::where('institution_id', auth()->user()->institution_id)
            ->where('role', 'user_student')
            ->get();

        return view('admin.anamneses.index', compact('anamneses', 'turmas', 'students'));
    }

    public function create()
    {
        $forms = \App\Models\Form::all();
        $students = User::where('institution_id', auth()->user()->institution_id)
            ->where('role', 'user_student')
            ->get();
        $professionals = User::where('institution_id', auth()->user()->institution_id)
            ->whereIn('role', ['user_teacher', 'user_admin'])
            ->with('categoria')
            ->get();

        return view('admin.anamneses.create', compact('forms', 'students', 'professionals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_id' => 'required|exists:forms,id',
            'student_id' => 'required|exists:users,id',
            'professional_id' => 'required|exists:users,id',
        ]);

        $anamnese = Anamnese::create([
            'form_id' => $request->form_id,
            'student_id' => $request->student_id,
            'professional_id' => $request->professional_id,
            'status' => 'pendente',
            'respostas' => [],
            'uuid' => \Str::uuid(),
        ]);

        return redirect()->route('admin.anamneses.edit', $anamnese)
            ->with('success', 'Anamnese criada com sucesso! Agora você pode preencher as informações.');
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

    public function responses(Anamnese $anamnese)
    {
        return view('admin.anamneses.responses', compact('anamnese'));
    }

    public function destroy(Anamnese $anamnese)
    {
        try {
            // Delete the anamnese
            $anamnese->delete();

            return redirect()->route('admin.anamneses.index')
                ->with('success', 'Anamnese excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.anamneses.index')
                ->with('error', 'Erro ao excluir anamnese: ' . $e->getMessage());
        }
    }
}
