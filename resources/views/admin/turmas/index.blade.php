@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Gerenciar Turmas</h2>
            <a href="{{ route('admin.turmas.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nova Turma
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vagas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($turmas as $turma)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $turma->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $turma->nome }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $turma->quantidade_vagas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.turmas.edit', ['id' => $turma->id]) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                <form action="{{ route('admin.turmas.destroy', ['id' => $turma->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Tem certeza que deseja excluir esta turma?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
