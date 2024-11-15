@extends('layouts.master')

@section('content')
<div class="py-4">
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="mb-4 text-2xl font-bold">Dashboard Administrativo</h1>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="p-4 bg-blue-100 rounded-lg">
                        <h2 class="mb-2 font-bold">Total de Usuários</h2>
                        <p class="text-2xl">{{ \App\Models\User::count() }}</p>
                    </div>

                    <div class="p-4 bg-green-100 rounded-lg">
                        <h2 class="mb-2 font-bold">Total de Professores</h2>
                        <p class="text-2xl">{{ \App\Models\User::where('role', 'user_teacher')->count() }}</p>
                    </div>

                    <div class="p-4 bg-yellow-100 rounded-lg">
                        <h2 class="mb-2 font-bold">Total de Estudantes</h2>
                        <p class="text-2xl">{{ \App\Models\User::where('role', 'user_student')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
