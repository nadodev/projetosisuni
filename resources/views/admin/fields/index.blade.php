@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Gerenciar Campos</h2>
            <a href="{{ route('admin.fields.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Novo Campo
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody id="sortable-fields" class="bg-white divide-y divide-gray-200">
                    @foreach($fields as $field)
                        <tr data-id="{{ $field->id }}" class="cursor-move">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="handle cursor-move">
                                    <i class="fas fa-grip-vertical text-gray-400"></i>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $field->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($field->type)
                                    @case('text')
                                        Texto
                                        @break
                                    @case('textarea')
                                        Área de Texto
                                        @break
                                    @case('number')
                                        Número
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.fields.edit', $field) }}"
                                   class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                <form action="{{ route('admin.fields.destroy', $field) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Tem certeza que deseja excluir este campo?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('sortable-fields');

        if (tbody) {
            new Sortable(tbody, {
                animation: 150,
                handle: '.handle',
                ghostClass: 'bg-gray-100',
                onEnd: function() {
                    const rows = tbody.getElementsByTagName('tr');
                    const order = Array.from(rows).map((row, index) => ({
                        id: row.dataset.id,
                        order: index
                    }));

                    // Mostrar indicador de carregamento
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg bg-blue-500 text-white transform transition-all duration-300 ease-in-out';
                    toast.textContent = 'Atualizando ordem...';
                    document.body.appendChild(toast);

                    // Enviar a nova ordem para o servidor
                    fetch('{{ route("admin.fields.updateOrder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        toast.className = 'fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg text-white transform transition-all duration-300 ease-in-out ' + 
                            (data.success ? 'bg-green-500' : 'bg-red-500');
                        toast.textContent = data.success ? 'Ordem atualizada com sucesso!' : 'Erro ao atualizar a ordem.';
                        
                        setTimeout(() => {
                            toast.style.opacity = '0';
                            setTimeout(() => {
                                toast.remove();
                            }, 300);
                        }, 3000);
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        toast.className = 'fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg bg-red-500 text-white transform transition-all duration-300 ease-in-out';
                        toast.textContent = 'Erro ao atualizar a ordem.';
                        
                        setTimeout(() => {
                            toast.style.opacity = '0';
                            setTimeout(() => {
                                toast.remove();
                            }, 300);
                        }, 3000);
                    });
                }
            });
        }
    });
</script>
@endpush
@endsection
