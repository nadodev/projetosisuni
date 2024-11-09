@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Atribuir Turmas aos Estudantes</h2>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Turma Atual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Atribuir Turma</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $student->turma ? $student->turma->nome : 'Sem turma' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.atribuir-turmas.update', $student) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <select name="id_turma" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Selecione uma turma</option>
                                        @foreach($turmas as $turma)
                                            <option value="{{ $turma->id }}" {{ $student->id_turma == $turma->id ? 'selected' : '' }}>
                                                {{ $turma->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                        Atribuir
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
@endsection
