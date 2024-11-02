@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Gerenciar Campos</h2>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nome do Campo</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tipo</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fields as $field)
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $field->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $field->type }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('fields.show', $field) }}" class="text-blue-500 hover:underline">Ver</a>
                        <a href="{{ route('fields.edit', $field) }}" class="ml-4 text-blue-500 hover:underline">Editar</a>
                        <form action="{{ route('fields.destroy', $field) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-4 text-red-500 hover:underline">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
