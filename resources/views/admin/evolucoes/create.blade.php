@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Nova Evolução</h2>
            <p class="mt-2 text-gray-600">
                Anamnese de: {{ $anamnese->student->name }}
            </p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.anamneses.evolucoes.store', $anamnese) }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Data da Evolução -->
                    <div>
                        <label for="data_evolucao" class="block text-sm font-medium text-gray-700">
                            Data da Evolução
                        </label>
                        <input type="date"
                               name="data_evolucao"
                               id="data_evolucao"
                               value="{{ old('data_evolucao', now()->format('Y-m-d')) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('data_evolucao')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hora da Evolução -->
                    <div>
                        <label for="hora_evolucao" class="block text-sm font-medium text-gray-700">
                            Hora da Evolução
                        </label>
                        <input type="time"
                               name="hora_evolucao"
                               id="hora_evolucao"
                               value="{{ old('hora_evolucao', now()->format('H:i')) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('hora_evolucao')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="mt-6">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                            id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="em_andamento" {{ old('status') == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="em_observacao" {{ old('status') == 'em_observacao' ? 'selected' : '' }}>Em Observação</option>
                        <option value="concluido" {{ old('status') == 'concluido' ? 'selected' : '' }}>Concluído</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descrição -->
                <div class="mt-6">
                    <label for="descricao" class="block text-sm font-medium text-gray-700">
                        Descrição da Evolução
                    </label>
                    <textarea name="descricao"
                              id="descricao"
                              rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Salvar Evolução
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
