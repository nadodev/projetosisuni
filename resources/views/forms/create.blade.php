@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Criar Novo Formulário</h2>
    <form action="{{ route('forms.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Formulário</label>
            <input type="text" name="name" id="name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Selecione os Campos</label>
            @foreach($fields as $field)
                <div class="flex items-center mt-2">
                    <input type="checkbox" name="fields[]" value="{{ $field->id }}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label class="ml-2 text-sm text-gray-700">{{ $field->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-200">Criar Formulário</button>
    </form>
</div>
@endsection
