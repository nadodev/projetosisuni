@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Editar Campo</h2>
    <form action="{{ route('fields.update', $field) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Campo</label>
            <input type="text" name="name" id="name" value="{{ $field->name }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
        </div>
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Tipo do Campo</label>
            <select name="type" id="type" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="text" {{ $field->type == 'text' ? 'selected' : '' }}>Texto</option>
                <option value="number" {{ $field->type == 'number' ? 'selected' : '' }}>Número</option>
                <option value="textarea" {{ $field->type == 'textarea' ? 'selected' : '' }}>Área de Texto</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-200">Atualizar Campo</button>
    </form>
</div>
@endsection
