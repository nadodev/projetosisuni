@extends('layouts.master')

@section('content')
<div class="flex-1 min-h-screen bg-gray-50">
    <div class="py-8 px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Header com breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors duration-200">
                    <i class="fas fa-home"></i>
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('admin.forms.index') }}" class="hover:text-blue-600 transition-colors duration-200">Formulários</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-700">Editar Formulário</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Editar Formulário</h1>
            <p class="mt-2 text-base text-gray-600">Atualize as informações do formulário e seus campos abaixo.</p>
        </div>

        <!-- Card do Formulário -->
        <div class="bg-white shadow-lg rounded-2xl">
            <div class="p-8">
                <form action="{{ route('admin.forms.update', $form) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-y-6">
                        <!-- Nome do Formulário -->
                        <div class="relative">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome do Formulário</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-file-alt text-gray-400"></i>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $form->name) }}"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o nome do formulário">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campos do Formulário -->
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-4">
                                <i class="fas fa-list-ul text-blue-500 mr-2"></i>
                                Campos do Formulário
                            </label>
                            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($fields as $field)
                                        <div class="flex items-center p-3 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                            <input type="checkbox" name="fields[]" value="{{ $field->id }}"
                                                id="field_{{ $field->id }}"
                                                class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                                {{ in_array($field->id, old('fields', $formFields)) ? 'checked' : '' }}>
                                            <label for="field_{{ $field->id }}" class="ml-3 flex-1 flex items-center justify-between text-sm">
                                                <span class="font-medium text-gray-700">{{ $field->name }}</span>
                                                <span class="px-2 py-1 text-xs rounded-full {{ $field->type == 'text' ? 'bg-blue-100 text-blue-700' : ($field->type == 'number' ? 'bg-green-100 text-green-700' : 'bg-purple-100 text-purple-700') }}">
                                                    {{ ucfirst($field->type) }}
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('fields')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.forms.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Atualizar Formulário
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
