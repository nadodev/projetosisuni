@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Registrar Evolução</h2>
            <p class="mt-2 text-gray-600">
                Paciente: {{ $anamnese->student->name }}
            </p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.anamneses.evolucoes.store', $anamnese) }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                    {{-- Data da Evolução --}}
                    <div>
                        <label for="data_evolucao" class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data_evolucao" id="data_evolucao"
                            value="{{ old('data_evolucao', date('Y-m-d')) }}"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('data_evolucao')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hora da Evolução --}}
                    <div>
                        <label for="hora_evolucao" class="block text-sm font-medium text-gray-700">Hora</label>
                        <input type="time" name="hora_evolucao" id="hora_evolucao"
                            value="{{ old('hora_evolucao', date('H:i')) }}"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('hora_evolucao')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status do Paciente</label>
                    <select name="status" id="status"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="em_andamento" {{ old('status') === 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="em_observacao" {{ old('status') === 'em_observacao' ? 'selected' : '' }}>Em Observação</option>
                        <option value="concluido" {{ old('status') === 'concluido' ? 'selected' : '' }}>Concluído</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Descrição --}}
                <div class="mb-4">
                    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição da Evolução</label>
                    <textarea name="descricao" id="descricao" rows="5"
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 justify-end">
                    <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                        class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Registrar Evolução
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
