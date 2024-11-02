<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        $fields = Field::all();
        return view('forms.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $form = Form::create(['name' => $request->name]);

        foreach ($request->fields as $key => $fieldId) {
            FormField::create([
                'form_id' => $form->id,
                'field_id' => $fieldId,
                'order' => $key,
            ]);
        }

        return redirect()->route('forms.index')->with('success', 'Formulário criado com sucesso!');
    }

    public function show(Form $form)
    {
        $fields = $form->fields()->orderBy('pivot_order')->get();
        return view('forms.show', compact('form', 'fields'));
    }

    public function edit(Form $form)
    {
        $fields = Field::orderBy('order')->get();
        $formFields = $form->fields()->pluck('field_id')->toArray();
        return view('forms.edit', compact('form', 'fields', 'formFields'));
    }

    public function update(Request $request, Form $form)
    {
        $form->update(['name' => $request->name]);

        // Atualizar campos do formulário
        $form->fields()->detach();
        foreach ($request->fields as $key => $fieldId) {
            FormField::create([
                'form_id' => $form->id,
                'field_id' => $fieldId,
                'order' => $key,
            ]);
        }

        return redirect()->route('forms.index')->with('success', 'Formulário atualizado com sucesso!');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index')->with('success', 'Formulário deletado com sucesso!');
    }

    public function submit(Request $request, Form $form)
    {
        $responses = $request->except('_token');

        FormResponse::create([
            'form_id' => $form->id,
            'responses' => json_encode($responses),
        ]);

        return redirect()->back()->with('success', 'Formulário enviado com sucesso!');
    }

    public function responses(Form $form)
    {
        $responses = FormResponse::where('form_id', $form->id)->get();
        return view('forms.responses', compact('form', 'responses'));
    }
}
