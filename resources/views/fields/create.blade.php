@extends('layouts.master')

@section('content')
<div class="w-full max-w-[900px] p-6  bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Criar Novo Campo</h2>
    <form action="{{ route('fields.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Campo</label>
            <input
            type="text"
            name="name"
            id="name"
            placeholder="Digite um nome para o campo"
            class="w-full py-2 pl-2 mt-1 border border-gray-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>        </div>
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Tipo do Campo</label>
            <select name="type" id="type"             class="w-full py-2 pl-2 mt-1 border border-gray-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>        </div>

                <option value="text">Texto</option>
                <option value="number">Número</option>
                <option value="textarea">Área de Texto</option>
            </select>
        </div>
        <button type="submit" class="w-full px-4 py-2 text-white transition-colors duration-200 bg-blue-500 rounded-md hover:bg-blue-600">Criar Campo</button>
    </form>
</div>
@endsection
