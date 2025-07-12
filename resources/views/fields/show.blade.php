@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detalhes do Campo</h2>
    <p><strong>Nome:</strong> {{ $field->name }}</p>
    <p><strong>Tipo:</strong> {{ $field->type }}</p>
    <a href="{{ route('fields.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Voltar</a>
</div>
@endsection
