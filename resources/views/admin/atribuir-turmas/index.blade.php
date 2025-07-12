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
                <a href="{{ route('admin.turmas.index') }}" class="hover:text-blue-600 transition-colors duration-200">Turmas</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-700">Atribuir Turmas</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Atribuir Turmas aos Estudantes</h1>
            <p class="mt-2 text-base text-gray-600">Gerencie a atribuição de turmas para os estudantes.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Turma Atual</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Atribuir Turma</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($user->id_turma)
                                            <span class="font-medium">{{ $user->turma->nome }}</span>
                                            <span class="text-gray-500">({{ $user->turma->serie }} - {{ ucfirst($user->turma->turno) }})</span>
                                        @else
                                            <span class="text-gray-500">Sem turma</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.atribuir-turmas.update', $user) }}" method="POST" class="flex-1">
                                            @csrf
                                            <div class="flex gap-2">
                                                <select name="turma_id" class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Selecione uma turma</option>
                                                    @foreach($turmas as $turma)
                                                        @php
                                                            $isCurrentClass = $user->id_turma && $user->id_turma == $turma->id;
                                                        @endphp
                                                        <option value="{{ $turma->id }}" 
                                                            {{ $isCurrentClass ? 'selected' : '' }}>
                                                            {{ $turma->nome }} - {{ $turma->serie }} 
                                                            ({{ $turma->getCountStudentAtTurma() }}/{{ $turma->capacidade }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </div>
                                        </form>
                                        
                                        @if($user->id_turma && $user->id_turma > 0)
                                            <form action="{{ route('admin.atribuir-turmas.remove', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover o aluno desta turma?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Nenhum estudante encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
