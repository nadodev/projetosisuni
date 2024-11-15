<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $fields = Field::orderBy('order')->get();
        return view('admin.fields.index', compact('fields'));
    }

    public function create()
    {
        return view('admin.fields.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,textarea,number'
        ]);

        Field::create($request->all());

        return redirect()->route('admin.fields.index')
            ->with('success', 'Campo criado com sucesso!');
    }

    public function edit(Field $field)
    {
        return view('admin.fields.edit', compact('field'));
    }

    public function update(Request $request, Field $field)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,textarea,number'
        ]);

        $field->update($request->all());

        return redirect()->route('admin.fields.index')
            ->with('success', 'Campo atualizado com sucesso!');
    }

    public function destroy(Field $field)
    {
        $field->delete();
        return redirect()->route('admin.fields.index')
            ->with('success', 'Campo excluído com sucesso!');
    }

    public function updateOrder(Request $request)
    {
        $orderedFields = $request->input('order', []);

        try {
            foreach ($orderedFields as $field) {
                Field::where('id', $field['id'])->update(['order' => $field['order']]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar ordem: ' . $e->getMessage()
            ], 500);
        }
    }
}
