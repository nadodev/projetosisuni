<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        return view('fields.index', compact('fields'));
    }

    public function create()
    {
        return view('fields.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string|in:text,number,textarea',
        ]);

        Field::create($request->all());

        return redirect()->route('fields.index')->with('success', 'Campo criado com sucesso!');
    }

    public function show(Field $field)
    {
        return view('fields.show', compact('field'));
    }

    public function edit(Field $field)
    {
        return view('fields.edit', compact('field'));
    }

    public function update(Request $request, Field $field)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string|in:text,number,textarea',
        ]);

        $field->update($request->all());

        return redirect()->route('fields.index')->with('success', 'Campo atualizado com sucesso!');
    }

    public function destroy(Field $field)
    {
        $field->delete();
        return redirect()->route('fields.index')->with('success', 'Campo deletado com sucesso!');
    }
}
