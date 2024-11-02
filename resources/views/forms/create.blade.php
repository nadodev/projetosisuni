@extends('layouts.master')

@section('content')
<div class="w-full max-w-[900px] p-6  bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Criar Novo Formulário</h2>
    <form action="{{ route('forms.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Formulário</label>
            <input
                type="text"
                name="name"
                id="name"
                placeholder="Digite um nome para o formulário"
                class="w-full py-2 pl-2 mt-1 border border-gray-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Selecione os Campos</label>
            @foreach($fields as $field)
                <div class="flex items-center mt-2">
                    <input type="checkbox" name="fields[]" value="{{ $field->id }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label class="ml-2 text-sm text-gray-700">{{ $field->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="px-4 py-2 text-white transition-colors duration-200 bg-blue-500 rounded-md  hover:bg-blue-600">Criar Formulário</button>
    </form>
</div>
@endsection
