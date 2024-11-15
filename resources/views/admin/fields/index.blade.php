@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h2 class="text-2xl font-semibold text-gray-900">Gerenciar Campos</h2>

        <div class="bg-white shadow sm:rounded-lg mt-6">
            <div class="p-6">
                <a href="{{ route('admin.fields.create') }}"
                   class="mb-4 inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    <i class="fas fa-plus mr-2"></i>Novo Campo
                </a>

                <ul id="sortable-fields" class="space-y-2">
                    @foreach($fields as $field)
                        <li class="border p-4 rounded bg-white shadow-sm cursor-move" data-id="{{ $field->id }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="handle cursor-move px-2">
                                        <i class="fas fa-grip-vertical text-gray-400"></i>
                                    </span>
                                    <div class="ml-4">
                                        <span class="font-medium">{{ $field->name }}</span>
                                        <span class="ml-2 text-sm text-gray-500">({{ $field->type }})</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admin.fields.edit', $field) }}"
                                       class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.fields.destroy', $field) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Tem certeza que deseja excluir este campo?')"
                                                class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var el = document.getElementById('sortable-fields');

    new Sortable(el, {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            var order = Array.from(evt.to.children).map((item, index) => ({
                id: item.dataset.id,
                order: index + 1
            }));

            fetch('{{ route('admin.fields.update-order') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ order: order })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Erro ao atualizar ordem: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
        }
    });
});
</script>
@endpush
@endsection
