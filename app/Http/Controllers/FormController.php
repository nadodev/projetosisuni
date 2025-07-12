<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormResponse;
use App\Models\Anamnese;
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

    public function show(string $uuid)
    {
        $anamnese = Anamnese::with(['form.fields', 'student', 'professional'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        // Se a anamnese estiver pendente, atualiza para em_andamento
        if ($anamnese->status === 'pendente') {
            $anamnese->update(['status' => 'em_andamento']);
        }
        // Se estiver concluída, redireciona com mensagem
        elseif ($anamnese->status === 'concluida') {
            return redirect()->back()->with('error', 'Este formulário já foi concluído e não pode mais ser acessado.');
        }

        return view('forms.show', compact('anamnese'));
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

    public function submit(Request $request, string $uuid)
    {
        try {
            \Log::info('Iniciando submissão do formulário', [
                'uuid' => $uuid,
                'request_data' => $request->all()
            ]);

            $anamnese = Anamnese::with(['form.fields', 'student', 'professional'])
                ->where('uuid', $uuid)
                ->firstOrFail();

            \Log::info('Anamnese encontrada', [
                'anamnese_id' => $anamnese->id,
                'form_id' => $anamnese->form_id,
                'status' => $anamnese->status
            ]);

            // Verifica se a anamnese está em andamento
            if ($anamnese->status !== 'em_andamento') {
                return redirect()->back()->with('error', 'Este formulário não pode receber respostas no momento.');
            }
            
            $request->validate([
                'respostas' => ['required', 'array'],
                'respostas.*' => ['required', 'string']
            ]);

            \Log::info('Dados validados, tentando salvar resposta', [
                'form_id' => $anamnese->form_id,
                'respostas' => $request->respostas
            ]);

            // Salva a resposta na tabela form_responses
            $response = FormResponse::create([
                'form_id' => $anamnese->form_id,
                'responses' => $request->respostas
            ]);

            \Log::info('Resposta salva com sucesso', [
                'response_id' => $response->id
            ]);

            return redirect()->back()->with('success', 'Formulário enviado com sucesso! Você pode continuar enviando respostas enquanto o formulário estiver em andamento.');
        } catch (\Exception $e) {
            \Log::error('Erro ao salvar respostas', [
                'erro' => $e->getMessage(),
                'linha' => $e->getLine(),
                'arquivo' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Ocorreu um erro ao salvar suas respostas: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function responses(Form $form)
    {
        $responses = FormResponse::where('form_id', $form->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('forms.responses', [
            'form' => $form,
            'responses' => $responses
        ]);
    }

    public function responseDetails(FormResponse $response)
    {
        return view('forms.response-details', [
            'response' => $response,
            'form' => $response->form
        ]);
    }
}
