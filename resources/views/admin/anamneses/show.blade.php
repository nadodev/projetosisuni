@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Anamnese</h2>
                <p class="mt-2 text-gray-600">
                    Paciente: {{ $anamnese->student->name }}
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.anamneses.evolucoes.create', $anamnese) }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                    Nova Evolução
                </a>
                <div class="relative dropdown" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="inline-flex items-center px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        <span>Exportar</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open"
                         @click.away="open = false"
                         class="absolute right-0 z-50 mt-2 w-48 bg-white rounded-md shadow-lg">
                        <a href="{{ route('admin.anamneses.report.pdf', $anamnese) }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Exportar PDF
                        </a>
                        <a href="{{ route('admin.anamneses.report.excel', $anamnese) }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Exportar Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progresso do Paciente --}}
        <div class="overflow-hidden mb-6 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Progresso do Paciente
                </h3>
            </div>
            <div class="p-4 border-t border-gray-200">
                <div class="mb-4">
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Progresso Geral</span>
                        <span class="text-sm font-medium text-gray-700">{{ $anamnese->progresso }}%</span>
                    </div>
                    <div class="w-full h-2.5 bg-gray-200 rounded-full">
                        <div class="h-2.5 rounded-full transition-all duration-500
                            {{ $anamnese->progresso < 25 ? 'bg-red-600' : '' }}
                            {{ $anamnese->progresso >= 25 && $anamnese->progresso < 50 ? 'bg-yellow-600' : '' }}
                            {{ $anamnese->progresso >= 50 && $anamnese->progresso < 75 ? 'bg-blue-600' : '' }}
                            {{ $anamnese->progresso >= 75 ? 'bg-green-600' : '' }}"
                            style="width: {{ $anamnese->progresso }}%">
                        </div>
                    </div>
                </div>

                {{-- Estatísticas detalhadas --}}
                <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-4">
                    @php $estatisticas = $anamnese->getEstatisticasEvolucoes(); @endphp

                    <div class="p-4 bg-green-50 rounded-lg">
                        <h4 class="font-medium text-green-700">Concluídas</h4>
                        <p class="text-2xl font-bold text-green-800">{{ $estatisticas['concluido']['quantidade'] }}</p>
                        <p class="text-sm text-green-600">{{ $estatisticas['concluido']['porcentagem'] }}%</p>
                    </div>

                    <div class="p-4 bg-yellow-50 rounded-lg">
                        <h4 class="font-medium text-yellow-700">Em Observação</h4>
                        <p class="text-2xl font-bold text-yellow-800">{{ $estatisticas['em_observacao']['quantidade'] }}</p>
                        <p class="text-sm text-yellow-600">{{ $estatisticas['em_observacao']['porcentagem'] }}%</p>
                    </div>

                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h4 class="font-medium text-blue-700">Em Andamento</h4>
                        <p class="text-2xl font-bold text-blue-800">{{ $estatisticas['em_andamento']['quantidade'] }}</p>
                        <p class="text-sm text-blue-600">{{ $estatisticas['em_andamento']['porcentagem'] }}%</p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-medium text-gray-700">Total de Evoluções</h4>
                        <p class="text-2xl font-bold text-gray-800">{{ $estatisticas['total'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lista de Evoluções --}}
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Evoluções
                </h3>
            </div>
            <div class="border-t border-gray-200">
                @forelse($anamnese->evolucoes()->orderBy('data_evolucao', 'desc')->get() as $evolucao)
                    <div class="p-4 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $evolucao->data_evolucao->format('d/m/Y') }} às {{ $evolucao->hora_evolucao->format('H:i') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Por: {{ $evolucao->professional->name }}
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

@push('scripts')
<script>
    // Inicializa o Alpine.js se necessário
    if (typeof Alpine === 'undefined') {
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false
            }))
        })
    }
</script>
@endpush
@endsection
