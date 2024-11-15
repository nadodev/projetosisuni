<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Relatório de Anamneses') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.reports.anamneses.pdf') }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Exportar Lista PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aluno
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Profissional
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Formulário
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
                            @foreach($anamneses as $anamnese)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $anamnese->student->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $anamnese->professional->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $anamnese->form->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $anamnese->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $anamnese->status === 'em_andamento' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $anamnese->status === 'concluida' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($anamnese->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $anamnese->created_at ? $anamnese->created_at->format('d/m/Y') : 'Data não disponível' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                                           class="text-blue-600 hover:text-blue-900 mr-3">
                                            Ver
                                        </a>
                                        <a href="{{ route('admin.reports.anamnese.pdf', $anamnese) }}"
                                           class="text-red-600 hover:text-red-900 mr-3">
                                            PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
