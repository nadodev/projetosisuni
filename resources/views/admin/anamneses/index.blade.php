@extends('layouts.master')

@section('content')
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Anamneses</h2>
                <a href="{{ route('admin.anamneses.create') }}"
                   class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Nova Anamnese
                </a>
            </div>

            {{-- Filtros --}}
            <div class="px-4 py-5 mb-6 bg-white shadow sm:rounded-lg">
                <form action="{{ route('admin.anamneses.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    {{-- Filtro por Turma --}}
                    <div>
                        <label for="turma_id" class="block text-sm font-medium text-gray-700">Turma</label>
                        <select name="turma_id" id="turma_id"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            onchange="this.form.submit()">
                            <option value="">Todas as Turmas</option>
                            @foreach($turmas as $turma)
                                <option value="{{ $turma->codigo }}" {{ request('turma_id') == $turma->codigo ? 'selected' : '' }}>
                                    {{ $turma->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filtro por Estudante --}}
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700">Estudante</label>
                        <select name="student_id" id="student_id"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            onchange="this.form.submit()">
                            <option value="">Todos os Estudantes</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botão de Limpar Filtros --}}
                    <div class="flex items-end">
                        <a href="{{ route('admin.anamneses.index') }}"
                           class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                            Limpar Filtros
                        </a>
                    </div>
                </form>
            </div>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="p-6">
                    @if($anamneses->isEmpty())
                        <div class="text-center text-gray-500">
                            Nenhuma anamnese registrada ainda.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Paciente
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Profissional
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Link do Formulário
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($anamneses as $anamnese)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $anamnese->student->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $anamnese->professional->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full
                                                    {{ $anamnese->status === 'pendente' ? 'text-yellow-800 bg-yellow-100' : '' }}
                                                    {{ $anamnese->status === 'em_andamento' ? 'text-blue-800 bg-blue-100' : '' }}
                                                    {{ $anamnese->status === 'concluida' ? 'text-green-800 bg-green-100' : '' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $anamnese->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <input type="text" 
                                                           value="{{ route('forms.show', $anamnese->uuid) }}"
                                                           class="block w-full text-sm text-gray-500 bg-gray-100 border-gray-300 rounded-md"
                                                           readonly>
                                                    <button onclick="copyFormLink('{{ route('forms.show', $anamnese->uuid) }}')"
                                                            class="p-2 text-gray-500 hover:text-gray-700"
                                                            title="Copiar Link">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                                <div class="flex justify-center gap-2">
                                                    <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                                                       class="text-indigo-600 hover:text-indigo-900">
                                                        Ver
                                                    </a>
                                                    <a href="{{ route('forms.responses', $anamnese->form_id) }}"
                                                       class="text-green-600 hover:text-green-900">
                                                        Respostas
                                                    </a>
                                                    <a href="{{ route('admin.anamneses.edit', $anamnese) }}"
                                                       class="text-yellow-600 hover:text-yellow-900">
                                                        Editar
                                                    </a>
                                                    <button type="button" 
                                                            onclick="openDeleteModal('{{ $anamnese->id }}')"
                                                            class="text-red-600 hover:text-red-900">
                                                        Excluir
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $anamneses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                Confirmar Exclusão
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Tem certeza que deseja excluir esta anamnese? Esta ação não pode ser desfeita.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Excluir
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    @if(session('success') || session('error'))
        <div id="toast" class="fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out {{ session('error') ? 'bg-red-500' : 'bg-green-500' }} text-white">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

    @push('scripts')
    <script>
        // Toast notification
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // Copy form link
        function copyFormLink(link) {
            navigator.clipboard.writeText(link).then(() => {
                // Create and show temporary toast
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg bg-green-500 text-white transform transition-all duration-300 ease-in-out';
                toast.textContent = 'Link copiado com sucesso!';
                document.body.appendChild(toast);

                // Remove toast after 3 seconds
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 3000);
            }).catch(() => {
                // Show error toast
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg bg-red-500 text-white transform transition-all duration-300 ease-in-out';
                toast.textContent = 'Erro ao copiar o link. Por favor, tente novamente.';
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 3000);
            });
        }

        // Delete modal functions
        function openDeleteModal(anamneseId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `{{ url('admin/anamneses') }}/${anamneseId}`;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        });

        // Close modal with ESC key
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
    @endpush
@endsection
