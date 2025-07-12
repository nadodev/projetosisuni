@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Editar Turma</h1>
            <p class="mt-1 text-gray-600">Atualize as informações da turma</p>
        </div>
        <a href="{{ route('admin.turmas.index') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left mr-2"></i> Voltar
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-error mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.turmas.update', $turma) }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informações Básicas -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informações Básicas</h2>

                <div>
                    <label class="label" for="nome">Nome da Turma</label>
                    <input type="text" name="nome" id="nome" class="input input-bordered w-full" required value="{{ old('nome', $turma->nome) }}" placeholder="Ex: 1º Ano A">
                    @error('nome') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="serie">Série/Ano</label>
                    <input type="text" name="serie" id="serie" class="input input-bordered w-full" required value="{{ old('serie', $turma->serie) }}" placeholder="Ex: 1º Ano">
                    @error('serie') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="turno">Turno</label>
                    <select name="turno" id="turno" class="select select-bordered w-full" required>
                        <option value="">Selecione...</option>
                        <option value="manha" {{ old('turno', $turma->turno) == 'manha' ? 'selected' : '' }}>Manhã</option>
                        <option value="tarde" {{ old('turno', $turma->turno) == 'tarde' ? 'selected' : '' }}>Tarde</option>
                        <option value="integral" {{ old('turno', $turma->turno) == 'integral' ? 'selected' : '' }}>Integral</option>
                        <option value="noite" {{ old('turno', $turma->turno) == 'noite' ? 'selected' : '' }}>Noite</option>
                    </select>
                    @error('turno') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="teacher_id">Professor Responsável</label>
                    <select name="teacher_id" id="teacher_id" class="select select-bordered w-full" required>
                        <option value="">Selecione...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $turma->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Detalhes Adicionais -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detalhes Adicionais</h2>

                <div>
                    <label class="label" for="capacidade">Capacidade de Alunos</label>
                    <input type="number" name="capacidade" id="capacidade" class="input input-bordered w-full" required value="{{ old('capacidade', $turma->capacidade) }}" min="1" placeholder="Ex: 30">
                    @error('capacidade') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="sala">Sala</label>
                    <input type="text" name="sala" id="sala" class="input input-bordered w-full" value="{{ old('sala', $turma->sala) }}" placeholder="Ex: Sala 101">
                    @error('sala') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="ano_letivo">Ano Letivo</label>
                    <input type="number" name="ano_letivo" id="ano_letivo" class="input input-bordered w-full" required value="{{ old('ano_letivo', $turma->ano_letivo) }}" min="2024" max="2100">
                    @error('ano_letivo') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label" for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" class="textarea textarea-bordered w-full" rows="3" placeholder="Informações adicionais sobre a turma...">{{ old('descricao', $turma->descricao) }}</textarea>
                    @error('descricao') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i> Atualizar Turma
            </button>
        </div>
    </form>
</div>
@endsection
