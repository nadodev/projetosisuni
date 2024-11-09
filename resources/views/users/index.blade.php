@extends('layouts.master')

@section('content')
<div class="w-full max-w-[900px] p-6  bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Administrar Formulários</h2>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">Nome do Formulário</th>
                <th class="px-4 py-2 text-sm font-medium text-left text-gray-700">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $user->name }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="ml-4 text-blue-500 hover:underline">Editar</a>
                        <form action="{{ route('admin.forms.destroy', $user) }}" method="POST" class="inline">
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
