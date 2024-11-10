@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Anamnese</h2>
                <p class="mt-2 text-gray-600">
                    Paciente: {{ $anamnese->student->nome_completo }}
                </p>
            </div>
            <a href="{{ route('admin.anamneses.evolucoes.create', $anamnese) }}"
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Nova Evolução
            </a>
        </div>

        {{-- Informações da Anamnese --}}
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Informações da Anamnese
                </h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Formulário</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $anamnese->form->name }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Profissional</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $anamnese->professional->nome_completo }}
                            ({{ $anamnese->professional->categoria->nome ?? 'Sem categoria' }})
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Status Atual</dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $anamnese->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $anamnese->status === 'em_andamento' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $anamnese->status === 'concluida' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ ucfirst($anamnese->status) }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- Lista de Evoluções --}}
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Evoluções
                </h3>
            </div>
            <div class="border-t border-gray-200">
                @forelse($anamnese->evolucoes as $evolucao)
                    <div class="p-4 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $evolucao->data_evolucao->format('d/m/Y') }} às {{ $evolucao->hora_evolucao->format('H:i') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Por: {{ $evolucao->professional->nome_completo }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.anamneses.evolucoes.edit', [$anamnese, $evolucao]) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                <form action="{{ route('admin.anamneses.evolucoes.destroy', [$anamnese, $evolucao]) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Tem certeza que deseja excluir esta evolução?')">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $evolucao->status === 'em_andamento' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $evolucao->status === 'em_observacao' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $evolucao->status === 'concluido' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $evolucao->status)) }}
                            </span>
                        </div>
                        <div class="mt-2 text-sm text-gray-700">
                            {{ $evolucao->descricao }}
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Nenhuma evolução registrada ainda.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
