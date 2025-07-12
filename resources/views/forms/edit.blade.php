@extends('layouts.master')

@section('content')
<div class="w-full max-w-[900px] p-6 bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Editar Formulário</h2>
    <form action="{{ route('forms.update', $form) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Formulário</label>
            <input type="text" name="name" id="name" value="{{ $form->name }}" class="w-full py-2 pl-2 mt-1 border border-gray-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Selecione e Ordene os Campos</label>
            <ul id="form-fields-list" class="space-y-2">
                @foreach($fields as $field)
                    <li class="flex items-center mt-2 p-2 border rounded" data-id="{{ $field->id }}">
                        <input type="checkbox" name="fields[]" value="{{ $field->id }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" {{ in_array($field->id, $formFields) ? 'checked' : '' }}>
                        <label class="ml-2 text-sm text-gray-700">{{ $field->name }}</label>
                        <span class="ml-auto cursor-move text-gray-500">☰</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <button type="submit" class="w-full px-4 py-2 text-white transition-colors duration-200 bg-blue-500 rounded-md hover:bg-blue-600">Atualizar Formulário</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formFieldsList = document.getElementById('form-fields-list');
        if (formFieldsList) {
            Sortable.create(formFieldsList, {
                animation: 150,
                handle: '.cursor-move',
                onEnd: function (evt) {
                    const order = Array.from(formFieldsList.children).map((item, index) => ({
                        id: item.dataset.id,
                        order: index
                    }));
                    // Atualiza a ordem dos campos no formulário
                    axios.post('{{ route('fields.updateOrder') }}', { order })
                        .then(response => {
                            console.log('Ordem atualizada com sucesso');
                        })
                        .catch(error => {
                            console.error('Erro ao atualizar a ordem', error);
                        });
                }
            });
        }
    });
</script>
@endpush
