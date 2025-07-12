@extends('layouts.master')

@section('content')
<div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900">Respostas do Formulário</h2>
                    <p class="mt-2 text-gray-600">
                        Paciente: {{ $anamnese->student->name }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                       class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                        Voltar
                    </a>
                    <button onclick="window.print()"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Imprimir
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Informações do Formulário
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Última atualização: {{ $anamnese->updated_at->format('d/m/Y \à\s H:i') }}
                </p>
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    @foreach($anamnese->form->fields as $field)
                        <div class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ $field->name }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {!! nl2br(e($anamnese->respostas[$field->id] ?? 'Não respondido')) !!}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>

        {{-- Histórico de Evoluções --}}
        @if($anamnese->evolucoes->isNotEmpty())
            <div class="mt-6 overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Histórico de Evoluções
                    </h3>
                </div>

                <div class="border-t border-gray-200">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach($anamnese->evolucoes()->orderBy('created_at', 'desc')->get() as $evolucao)
                                <li>
                                    <div class="relative pb-8">
                                        @if(!$loop->last)
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="flex items-center justify-center w-8 h-8 rounded-full
                                                    {{ $evolucao->status === 'em_andamento' ? 'bg-blue-500' : '' }}
                                                    {{ $evolucao->status === 'em_observacao' ? 'bg-yellow-500' : '' }}
                                                    {{ $evolucao->status === 'concluido' ? 'bg-green-500' : '' }}">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-sm text-gray-500">
                                                    <div class="font-medium text-gray-900">
                                                        {{ $evolucao->professional->name }}
                                                    </div>
                                                    <p>
                                                        {{ $evolucao->data_evolucao->format('d/m/Y') }} às {{ $evolucao->hora_evolucao->format('H:i') }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 text-sm text-gray-700">
                                                    {{ $evolucao->descricao }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        body {
            padding: 0;
            margin: 0;
        }
        .shadow {
            box-shadow: none !important;
        }
    }
</style>
@endpush
@endsection 