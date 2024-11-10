@extends('layouts.master')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Anamneses</h2>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profissional</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Formulário</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Última Evolução</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($anamneses as $anamnese)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $anamnese->student->nome_completo }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $anamnese->professional->nome_completo }}
                                    <br>
                                    <span class="text-sm text-gray-500">
                                        {{ $anamnese->professional->categoria->nome ?? 'Sem categoria' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $anamnese->form->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $anamnese->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $anamnese->status === 'em_andamento' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $anamnese->status === 'concluida' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst($anamnese->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($anamnese->ultimaEvolucao)
                                        {{ $anamnese->ultimaEvolucao->data_evolucao->format('d/m/Y') }}
                                        <br>
                                        <span class="text-sm text-gray-500">
                                            {{ $anamnese->ultimaEvolucao->status }}
                                        </span>
                                    @else
                                        <span class="text-gray-500">Sem evoluções</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                                       class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
                                    <a href="{{ route('admin.anamneses.evolucoes.create', $anamnese) }}"
                                       class="text-green-600 hover:text-green-900">Nova Evolução</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
