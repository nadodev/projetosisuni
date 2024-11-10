@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Editar Evolução</h2>
            <p class="mt-2 text-gray-600">
                Paciente: {{ $anamnese->student->nome_completo }}
            </p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.anamneses.evolucoes.update', [$anamnese, $evolucao]) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    {{-- Data da Evolução --}}
                    <div>
                        <label for="data_evolucao" class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data_evolucao" id="data_evolucao"
                            value="{{ old('data_evolucao', $evolucao->data_evolucao->format('Y-m-d')) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('data_evolucao')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hora da Evolução --}}
                    <div>
                        <label for="hora_evolucao" class="block text-sm font-medium text-gray-700">Hora</label>
                        <input type="time" name="hora_evolucao" id="hora_evolucao"
                            value="{{ old('hora_evolucao', $evolucao->hora_evolucao->format('H:i')) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('hora_evolucao')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status do Paciente</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="em_andamento" {{ old('status', $evolucao->status) === 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="em_observacao" {{ old('status', $evolucao->status) === 'em_observacao' ? 'selected' : '' }}>Em Observação</option>
                        <option value="concluido" {{ old('status', $evolucao->status) === 'concluido' ? 'selected' : '' }}>Concluído</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Descrição --}}
                <div class="mb-4">
                    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição da Evolução</label>
                    <textarea name="descricao" id="descricao" rows="5"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao', $evolucao->descricao) }}</textarea>
                    @error('descricao')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Atualizar Evolução
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
