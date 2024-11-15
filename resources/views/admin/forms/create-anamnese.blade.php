@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h2 class="text-2xl font-semibold text-gray-900">Criar Anamnese - {{ $form->name }}</h2>

        <div class="bg-white shadow sm:rounded-lg mt-6">
            <form action="{{ route('admin.forms.store-anamnese', $form) }}" method="POST" class="p-6">
                @csrf

                <div class="mb-4">
                    <label for="student_id" class="block text-sm font-medium text-gray-700">Estudante</label>
                    <select name="student_id" id="student_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecione um estudante</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="professional_id" class="block text-sm font-medium text-gray-700">Profissional</label>
                    <select name="professional_id" id="professional_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecione um profissional</option>
                        @foreach($professionals as $professional)
                            <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Criar Anamnese
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
