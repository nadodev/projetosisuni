@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Preencher Anamnese</h2>
            <p class="mt-2 text-gray-600">
                Estudante: {{ $anamnese->student->nome_completo }} |
                Profissional: {{ $anamnese->professional->nome_completo }}
            </p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.anamneses.update', $anamnese) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                @foreach($anamnese->form->fields as $field)
                    <div class="mb-4">
                        <label for="field_{{ $field->id }}" class="block text-sm font-medium text-gray-700">
                            {{ $field->name }}
                        </label>

                        @switch($field->type)
                            @case('text')
                                <input type="text"
                                    name="respostas[{{ $field->id }}]"
                                    id="field_{{ $field->id }}"
                                    value="{{ old('respostas.' . $field->id, $anamnese->respostas[$field->id] ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @break

                            @case('textarea')
                                <textarea name="respostas[{{ $field->id }}]"
                                    id="field_{{ $field->id }}"
                                    rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('respostas.' . $field->id, $anamnese->respostas[$field->id] ?? '') }}</textarea>
                                @break

                            @case('number')
                                <input type="number"
                                    name="respostas[{{ $field->id }}]"
                                    id="field_{{ $field->id }}"
                                    value="{{ old('respostas.' . $field->id, $anamnese->respostas[$field->id] ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @break
                        @endswitch
                    </div>
                @endforeach

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="pendente" {{ $anamnese->status === 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="em_andamento" {{ $anamnese->status === 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="concluida" {{ $anamnese->status === 'concluida' ? 'selected' : '' }}>Concluída</option>
                    </select>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.anamneses.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Salvar Anamnese
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
