<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::where('user_id', auth()->id())->get();
        return view('teacher.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('teacher.forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Adicione outras validações necessárias
        ]);

        $form = Form::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            // Adicione outros campos necessários
        ]);

        return redirect()->route('teacher.forms.index')->with('success', 'Formulário criado com sucesso!');
    }

    public function show(Form $form)
    {
        return view('teacher.forms.show', compact('form'));
    }

    public function edit(Form $form)
    {
        return view('teacher.forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Adicione outras validações necessárias
        ]);

        $form->update($request->all());

        return redirect()->route('teacher.forms.index')->with('success', 'Formulário atualizado com sucesso!');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('teacher.forms.index')->with('success', 'Formulário deletado com sucesso!');
    }

    public function responses(Form $form)
    {
        $responses = $form->responses;
        return view('teacher.forms.responses', compact('form', 'responses'));
    }
}
