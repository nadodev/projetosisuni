@extends('layouts.master')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Dashboard do Professor</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h2 class="font-bold mb-2">Meus Formulários</h2>
                        <p class="text-2xl">0</p>
                    </div>

                    <div class="bg-green-100 p-4 rounded-lg">
                        <h2 class="font-bold mb-2">Respostas Recebidas</h2>
                        <p class="text-2xl">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
