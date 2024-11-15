@extends('layouts.master')

@section('content')
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h2 class="text-2xl font-semibold text-gray-900">Anamneses</h2>

            <div class="bg-white shadow sm:rounded-lg mt-6">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Paciente
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($anamneses as $anamnese)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $anamnese->student->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $anamnese->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $anamnese->status === 'em_andamento' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $anamnese->status === 'concluida' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($anamnese->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $anamnese->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-3">
                                            <!-- Botão Ver Detalhes -->
                                            <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-eye"></i>
                                                Ver Detalhes
                                            </a>

                                            <!-- Botão Nova Evolução -->
                                            <a href="{{ route('admin.anamneses.evolucoes.create', $anamnese) }}"
                                                class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-plus"></i>
                                                Nova Evolução
                                            </a>

                                            <!-- Botão Editar -->
                                            <a href="{{ route('admin.anamneses.edit', $anamnese) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                                Editar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
