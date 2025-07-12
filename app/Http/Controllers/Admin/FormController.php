<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Field;
use App\Models\User;
use App\Models\Anamnese;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->paginate(10);
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
        // Busca estudantes
        $students = User::where('role', 'user_student')->get();

        // Busca profissionais (professores e admins com categoria)
        $professionals = User::whereIn('role', ['user_teacher', 'user_admin'])
            ->whereNotNull('categoria_id')
            ->with('categoria')
            ->get();

        return view('admin.forms.create-anamnese', compact('form', 'students', 'professionals'));
    }

    public function storeAnamnese(Request $request, Form $form)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'professional_id' => 'required|exists:users,id'
        ]);

        // Verifica se o estudante selecionado é realmente um estudante
        $student = User::findOrFail($request->student_id);
        if ($student->role !== 'user_student') {
            return back()->with('error', 'O usuário selecionado não é um estudante.');
        }

        // Verifica se o profissional selecionado tem uma categoria
        $professional = User::findOrFail($request->professional_id);
        if (!$professional->categoria_id) {
            return back()->with('error', 'O profissional selecionado não possui uma categoria.');
        }

        // Cria a anamnese
        $anamnese = Anamnese::create([
            'form_id' => $form->id,
            'student_id' => $request->student_id,
            'professional_id' => $request->professional_id,
            'status' => 'pendente',
            'uuid' => Str::uuid()
        ]);

        return redirect()->route('admin.anamneses.show', $anamnese)
            ->with('success', 'Anamnese criada com sucesso!');
    }
}
