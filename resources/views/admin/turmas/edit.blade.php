@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Editar Turma</h2>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.turmas.update', $turma) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nome da Turma --}}
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700">Nome da Turma</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome', $turma->nome) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nome')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Quantidade de Vagas --}}
                    <div>
                        <label for="quantidade_vagas" class="block text-sm font-medium text-gray-700">Quantidade de Vagas</label>
                        <input type="number" name="quantidade_vagas" id="quantidade_vagas"
                            value="{{ old('quantidade_vagas', $turma->quantidade_vagas) }}"
                            min="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('quantidade_vagas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Informações Adicionais --}}
                    <div class="col-span-2">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Informações da Turma</h3>
                            <p class="text-sm text-gray-600">Código da Turma: {{ $turma->codigo }}</p>
                            <p class="text-sm text-gray-600 mt-1">
                                Alunos Matriculados: {{ $turma->alunos->count() }} / {{ $turma->quantidade_vagas }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.turmas.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Atualizar Turma
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
