@extends('layouts.master')

@section('content')
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Anamneses</h2>
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
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Paciente</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Turma</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Profissional</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Formulário</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($anamneses as $anamnese)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $anamnese->student->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $anamnese->student->turma->nome ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $anamnese->professional->name }}
                                    <br>
                                    <span class="text-sm text-gray-500">
                                        {{ $anamnese->professional->categoria->nome ?? 'Sem categoria' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.forms.show', $anamnese->form) }}"
                                       class="text-blue-600 hover:text-blue-900">
                                        {{ $anamnese->form->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $anamnese->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $anamnese->status === 'em_andamento' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $anamnese->status === 'concluida' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst($anamnese->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <a href="{{ route('admin.anamneses.show', $anamnese) }}"
                                       class="mr-3 text-blue-600 hover:text-blue-900">Ver</a>
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
