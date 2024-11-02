@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Administrar Formulários</h2>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nome do Formulário</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form)
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $form->name }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('forms.show', $form) }}" class="text-blue-500 hover:underline">Visualizar</a>
                        <a href="{{ route('forms.edit', $form) }}" class="ml-4 text-blue-500 hover:underline">Editar</a>
                        <a href="{{ route('forms.responses', $form) }}" class="ml-4 text-blue-500 hover:underline">Respostas</a>
                        <form action="{{ route('forms.destroy', $form) }}" method="POST" class="inline">
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
