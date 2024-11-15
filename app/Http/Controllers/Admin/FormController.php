<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Field;
use App\Models\User;
use App\Models\Anamnese;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->get();
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        $fields = Field::all();
        return view('admin.forms.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*' => 'exists:fields,id'
        ]);

        $form = Form::create([
            'name' => $request->name,
            'user_id' => auth()->id()
        ]);

        // Anexa os campos selecionados ao formulário
        $form->fields()->attach($request->fields);

        return redirect()->route('admin.forms.index')
            ->with('success', 'Formulário criado com sucesso!');
    }

    public function show(Form $form)
    {
        $form->load('fields');
        return view('admin.forms.show', compact('form'));
    }

    public function edit(Form $form)
    {
        $fields = Field::all();
        $formFields = $form->fields->pluck('id')->toArray();
        return view('admin.forms.edit', compact('form', 'fields', 'formFields'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*' => 'exists:fields,id'
        ]);

        $form->update([
            'name' => $request->name
        ]);

        // Sincroniza os campos selecionados
        $form->fields()->sync($request->fields);

        return redirect()->route('admin.forms.index')
            ->with('success', 'Formulário atualizado com sucesso!');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.forms.index')
            ->with('success', 'Formulário excluído com sucesso!');
    }

    public function createAnamnese(Form $form)
    {
        // Busca os estudantes disponíveis
        $students = User::where('role', 'user_student')
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->get();

        // Busca os profissionais disponíveis
        $professionals = User::where('role', 'user_teacher')
            ->where('id_instituicao', auth()->user()->id_instituicao)
            ->get();

        return view('admin.forms.create-anamnese', [
            'form' => $form,
            'students' => $students,
            'professionals' => $professionals
        ]);
    }

    public function storeAnamnese(Request $request, Form $form)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'professional_id' => 'required|exists:users,id',
            'respostas' => 'nullable|array'
        ]);

        $anamnese = Anamnese::create([
            'form_id' => $form->id,
            'student_id' => $validated['student_id'],
            'professional_id' => $validated['professional_id'],
            'id_instituicao' => auth()->user()->id_instituicao,
            'respostas' => $validated['respostas'] ?? [],
            'status' => 'pendente'
        ]);

        return redirect()->route('admin.anamneses.edit', $anamnese)
            ->with('success', 'Anamnese criada com sucesso!');
    }
}
