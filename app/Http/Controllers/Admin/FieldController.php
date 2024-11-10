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
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:fields,id',
            'order.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->order as $item) {
            Field::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
