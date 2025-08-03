@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Nova Turma</h1>
            <p class="mt-1 text-gray-600">Crie uma nova turma para sua instituição</p>
        </div>
        <a href="{{ route('admin.turmas.index') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left mr-2"></i> Voltar
        </a>
    </div>

    <form action="{{ route('admin.turmas.store') }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informações Básicas -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informações Básicas</h2>

                <div>
                    <label class="label text-gray-500" for="nome">Nome da Turma</label>
                    <input type="text" name="nome" id="nome" class="bg-gray-100 border-gray-200 w-full rounded" required value="{{ old('nome') }}" placeholder="Ex: 1º Ano A">
                    @error('nome') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="serie">Série/Ano</label>
                    <input type="text" name="serie" id="serie" class="bg-gray-100 border-gray-200 w-full rounded" required value="{{ old('serie') }}" placeholder="Ex: 1º Ano">
                    @error('serie') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="turno">Turno</label>
                    <select name="turno" id="turno" class="bg-gray-100 border-gray-200 w-full rounded text-gray-500" required>
                        <option value="">Selecione...</option>
                        <option value="manha" {{ old('turno') == 'manha' ? 'selected' : '' }}>Manhã</option>
                        <option value="tarde" {{ old('turno') == 'tarde' ? 'selected' : '' }}>Tarde</option>
                        <option value="integral" {{ old('turno') == 'integral' ? 'selected' : '' }}>Integral</option>
                        <option value="noite" {{ old('turno') == 'noite' ? 'selected' : '' }}>Noite</option>
                    </select>
                    @error('turno') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="professor_id">Professor Responsável</label>
                    <select name="professor_id" id="professor_id" class="bg-gray-100 border-gray-200 w-full rounded text-gray-500" required>
                        <option value="">Selecione...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('professor_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('professor_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Detalhes Adicionais -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detalhes Adicionais</h2>

                <div>
                    <label class="label" for="capacidade">Capacidade de Alunos</label>
                    <input type="number" name="capacidade" id="capacidade" class="bg-gray-100 border-gray-200 w-full rounded text-gray-500" required value="{{ old('capacidade') }}" min="1" placeholder="Ex: 30">
                    @error('capacidade') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="sala">Sala</label>
                    <input type="text" name="sala" id="sala" class="bg-gray-100 border-gray-200 w-full rounded text-gray-500" value="{{ old('sala') }}" placeholder="Ex: Sala 101">
                    @error('sala') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="ano_letivo">Ano Letivo</label>
                    <input type="number" name="ano_letivo" id="ano_letivo" class="bg-gray-100 border-gray-200 w-full rounded text-gray-500" required value="{{ old('ano_letivo', date('Y')) }}" min="2024" max="2100">
                    @error('ano_letivo') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" class="bg-gray-100 border-gray-200 w-full rounded text-gray-500" rows="3" placeholder="Informações adicionais sobre a turma...">{{ old('descricao') }}</textarea>
                    @error('descricao') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i> Criar Turma
            </button>
        </div>
    </form>
</div>
@endsection
