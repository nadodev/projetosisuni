@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gerenciamento de Alunos</h1>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Cadastrar Novo Aluno
        </a>
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

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-sm">
                        <th class="px-6 py-3 text-left">Nome</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Turma</th>
                        <th class="px-6 py-3 text-left">Perfil Educacional</th>
                        <th class="px-6 py-3 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($student->photo_path)
                                        <img src="{{ Storage::url($student->photo_path) }}" 
                                             alt="Foto de {{ $student->name }}"
                                             class="h-8 w-8 rounded-full mr-3">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $student->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $student->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($student->studentProfile && $student->studentProfile->class)
                                    <div class="text-sm text-gray-900">
                                        {{ $student->studentProfile->class->nome }}
                                        <div class="text-xs text-gray-500">
                                            {{ $student->studentProfile->class->serie }} - 
                                            {{ ucfirst($student->studentProfile->class->turno) }}
                                        </div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Sem turma</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($student->educationalProfile)
                                    <div class="text-sm">
                                        @if($student->educationalProfile->hasAnyNeurodivergence())
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                Neurodivergente
                                            </span>
                                        @endif
                                        @if($student->educationalProfile->needsAnySupport())
                                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800 ml-1">
                                                Apoios Específicos
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Não configurado</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.students.show', $student->id) }}" 
                                       class="text-blue-600 hover:text-blue-900"
                                       title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.students.edit', $student->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-900"
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.students.progress.index', $student->id) }}" 
                                       class="text-purple-600 hover:text-purple-900"
                                       title="Andamento">
                                        <i class="fas fa-brain"></i>
                                    </a>
                                    <button type="button" 
                                            class="text-red-600 hover:text-red-900"
                                            title="Excluir"
                                            onclick="confirmDelete({{ $student->id }}, '{{ $student->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Nenhum aluno encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t">
            {{ $students->links() }}
        </div>
    </div>
</div>

<!-- Modal de Confirmação -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmar Exclusão</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Você tem certeza que deseja excluir o aluno <strong id="studentName"></strong>?
                </p>
                <p class="text-xs text-gray-400 mt-2">
                    Esta ação é irreversível e todos os dados associados ao aluno serão perdidos.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <div class="flex justify-end gap-x-3">
                    <button type="button" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300"
                            onclick="closeModal()">
                        Cancelar
                    </button>
                    <button type="button" 
                            class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                            onclick="deleteStudent()">
                        Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let currentStudentId = null;
    let currentStudentName = null;

    function confirmDelete(studentId, studentName) {
        currentStudentId = studentId;
        currentStudentName = studentName;
        document.getElementById('studentName').textContent = studentName;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        currentStudentId = null;
        currentStudentName = null;
    }

    function deleteStudent() {
        if (currentStudentId) {
            // Criar um formulário temporário para enviar a requisição
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/students/${currentStudentId}`;
            
            // Adicionar token CSRF
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            
            // Adicionar método DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Fechar modal ao clicar fora dele
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
