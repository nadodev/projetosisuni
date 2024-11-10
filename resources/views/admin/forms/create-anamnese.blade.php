@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Criar Anamnese</h2>
            <p class="mt-2 text-gray-600">Formulário: {{ $form->name }}</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.forms.store-anamnese', $form) }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Estudante --}}
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700">Estudante</label>
                        <select name="student_id" id="student_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecione um estudante</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Profissional --}}
                    <div>
                        <label for="professional_id" class="block text-sm font-medium text-gray-700">Profissional Responsável</label>
                        <select name="professional_id" id="professional_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecione um profissional</option>
                            @foreach($professionals as $professional)
                                <option value="{{ $professional->id }}" {{ old('professional_id') == $professional->id ? 'selected' : '' }}>
                                    {{ $professional->name }}
                                    @if($professional->categoria)
                                        - {{ $professional->categoria->nome }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('professional_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Campos do Formulário</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @foreach($form->fields as $field)
                            <div class="mb-4 last:mb-0 p-3 bg-white rounded shadow-sm">
                                <p class="font-medium">{{ $field->name }}</p>
                                <p class="text-sm text-gray-500">Tipo: {{ ucfirst($field->type) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.forms.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Criar Anamnese
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
