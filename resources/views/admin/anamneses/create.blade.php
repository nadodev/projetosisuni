@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Nova Anamnese</h2>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.anamneses.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    {{-- Formulário --}}
                    <div>
                        <label for="form_id" class="block text-sm font-medium text-gray-700">Formulário</label>
                        <select name="form_id" id="form_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecione um formulário</option>
                            @foreach($forms as $form)
                                <option value="{{ $form->id }}" {{ old('form_id') == $form->id ? 'selected' : '' }}>
                                    {{ $form->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('form_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

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

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.anamneses.index') }}"
                        class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Criar Anamnese
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 