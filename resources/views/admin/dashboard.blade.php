@extends('layouts.master')

@section('content')
<div class="p-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Users Card -->
        <div class="p-4 bg-white rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="flex-1 ml-4">
                    <p class="text-sm font-medium text-gray-500">Total de Usuários</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-blue-600 hover:text-blue-700">
                Ver detalhes
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Total Classes Card -->
        <div class="p-4 bg-white rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="flex-1 ml-4">
                    <p class="text-sm font-medium text-gray-500">Total de Turmas</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalTurmas }}</p>
                </div>
            </div>
            <a href="{{ route('admin.turmas.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-green-600 hover:text-green-700">
                Ver detalhes
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Total Institutions Card -->
        <div class="p-4 bg-white rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="flex-1 ml-4">
                    <p class="text-sm font-medium text-gray-500">Total de Instituições</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalInstituicoes }}</p>
                </div>
            </div>
            <a href="{{ route('admin.instituicoes.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-purple-600 hover:text-purple-700">
                Ver detalhes
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Total Forms Card -->
        <div class="p-4 bg-white rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="flex-1 ml-4">
                    <p class="text-sm font-medium text-gray-500">Total de Formulários</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalForms }}</p>
                </div>
            </div>
            <a href="{{ route('admin.forms.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-yellow-600 hover:text-yellow-700">
                Ver detalhes
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Recent Activity and Stats Grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Usuários Recentes</h3>
            </div>
            <div class="p-4">
                <div class="flow-root">
                    <ul class="-my-5 divide-y divide-gray-200">
                        @foreach($recentUsers as $user)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-500">
                                        <span class="text-sm font-medium leading-none text-white">
                                            {{ strtoupper(substr($user['name'], 0, 1)) }}
                                        </span>
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $user['name'] }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                        {{ $user['email'] }}
                                    </p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Novo
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Classes -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Turmas Recentes</h3>
            </div>
            <div class="p-4">
                <div class="flow-root">
                    <ul class="-my-5 divide-y divide-gray-200">
                        @foreach($recentTurmas as $turma)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-500">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $turma['nome'] }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                        {{ $turma['instituicao'] }}
                                    </p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Nova
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- State Statistics -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Distribuição por Estado</h3>
            </div>
            <div class="p-4">
                <div class="flow-root">
                    <ul class="-my-5 divide-y divide-gray-200">
                        @foreach($estadosStats as $stat)
                        <li class="py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 font-medium">
                                        {{ $stat['uf'] }}
                                    </span>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $stat['total'] }} {{ Str::plural('instituição', $stat['total']) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="relative w-24 h-2 bg-gray-200 rounded">
                                        <div class="absolute top-0 left-0 h-2 bg-indigo-600 rounded" style="width: {{ ($stat['total'] / $totalInstituicoes) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
