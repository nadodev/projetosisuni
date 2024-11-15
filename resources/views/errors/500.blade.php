@extends('layouts.master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full px-6 py-8 bg-white shadow-md rounded-lg">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-red-600 mb-4">500</h1>
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Erro no Servidor</h2>
            <p class="text-gray-600 mb-6">Desculpe, ocorreu um erro inesperado. Nossa equipe foi notificada.</p>
            <a href="{{ url('/') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Voltar para Home
            </a>
        </div>
    </div>
</div>
@endsection
