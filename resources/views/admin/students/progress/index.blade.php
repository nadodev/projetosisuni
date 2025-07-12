@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Andamento do Aluno</h1>
            <p class="text-gray-600 mt-1">{{ $student->name }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.students.progress.create', $student) }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i> Registrar Andamento
            </a>
            <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informações do Aluno</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Nome</label>
                    <p class="text-gray-900">{{ $student->name }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Email</label>
                    <p class="text-gray-900">{{ $student->email }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Turma</label>
                    <p class="text-gray-900">
                        @if($student->studentProfile && $student->studentProfile->class)
                            {{ $student->studentProfile->class->nome }}
                        @else
                            Sem turma
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Histórico de Andamento</h2>
            
            <!-- Placeholder para o histórico -->
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-chart-line text-4xl mb-4"></i>
                <p class="text-lg">Nenhum registro de andamento encontrado</p>
                <p class="text-sm">Clique em "Registrar Andamento" para começar</p>
            </div>
        </div>
    </div>
</div>
@endsection 