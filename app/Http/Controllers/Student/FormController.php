<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::where('id_institution', auth()->user()->id_institution)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.forms.index', compact('forms'));
    }

    public function show(Form $form)
    {
        return view('student.forms.show', compact('form'));
    }

    public function submit(Request $request, Form $form)
    {
        $validated = $request->validate([
            'respostas' => 'required|array'
        ]);

        // Lógica para salvar as respostas do formulário
        // ...

        return redirect()->route('student.forms.index')
            ->with('success', 'Formulário enviado com sucesso!');
    }
}
