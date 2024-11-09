<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Field;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
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
            'fields.*' => 'exists:fields,id',
        ]);

        $form = Form::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        $form->fields()->attach($request->fields);

        return redirect()->route('admin.forms.index')->with('success', 'Formulário criado com sucesso!');
    }

    public function edit(Form $form)
    {
        $fields = Field::all();
        $formFields = $form->fields()->pluck('field_id')->toArray();
        return view('admin.forms.edit', compact('form', 'fields', 'formFields'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*' => 'exists:fields,id',
        ]);

        $form->update(['name' => $request->name]);
        $form->fields()->sync($request->fields);

        return redirect()->route('admin.forms.index')->with('success', 'Formulário atualizado com sucesso!');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.forms.index')->with('success', 'Formulário deletado com sucesso!');
    }

    public function responses(Form $form)
    {
        $responses = $form->responses;
        return view('admin.forms.responses', compact('form', 'responses'));
    }
}
