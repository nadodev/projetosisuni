@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Editar Formulário</h2>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.forms.update', $form) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome do Formulário</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $form->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Campos do Formulário</label>
                    <div class="space-y-2">
                        @foreach($fields as $field)
                            <div class="flex items-center">
                                <input type="checkbox" name="fields[]" value="{{ $field->id }}"
                                    id="field_{{ $field->id }}"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    {{ in_array($field->id, old('fields', $formFields)) ? 'checked' : '' }}>
                                <label for="field_{{ $field->id }}" class="ml-2 text-sm text-gray-700">
                                    {{ $field->name }} ({{ ucfirst($field->type) }})
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('fields')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.forms.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Atualizar Formulário
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
