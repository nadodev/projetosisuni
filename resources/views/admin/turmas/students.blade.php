@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Alunos da Turma {{ $turma->nome }}</h1>
            <p class="mt-1 text-gray-600">
                {{ $turma->serie }} - {{ ucfirst($turma->turno) }} - 
                Prof. {{ $turma->teacher->name }} - 
                {{ $turma->students->count() }}/{{ $turma->capacidade }} alunos
            </p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.turmas.index') }}" class="btn btn-ghost">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
            @if($turma->students->count() < $turma->capacidade)
                <a href="{{ route('admin.students.create', ['turma_id' => $turma->id]) }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Novo Aluno
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="min-w-full align-middle">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsável</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($turma->students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($student->photo_path)
                                        <img src="{{ Storage::url($student->photo_path) }}" 
                                             alt="Foto de {{ $student->full_name }}"
                                             class="h-8 w-8 rounded-full mr-3">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $student->full_name }}</div>
                                        @if($student->social_name)
                                            <div class="text-sm text-gray-500">{{ $student->social_name }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $student->registration_number }}</div>
                                <div class="text-xs text-gray-500">{{ $student->school_code }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $student->guardian_name }}</div>
                                <div class="text-xs text-gray-500">{{ ucfirst($student->guardian_kinship) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $student->guardian_phone }}</div>
                                <div class="text-xs text-gray-500">{{ $student->guardian_email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.students.show', $student) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.students.edit', $student) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Nenhum aluno encontrado nesta turma.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 