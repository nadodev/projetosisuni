@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Registrar Andamento</h1>
            <p class="text-gray-600 mt-1">{{ $student->name }}</p>
        </div>
        <a href="{{ route('admin.students.progress.index', $student) }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left mr-2"></i> Voltar
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-error mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <strong>Erro!</strong> Por favor, corrija os seguintes erros:
            <ul class="mt-2 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.progress.store', $student) }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="label" for="date">Data da Observação</label>
                <input type="date" name="date" id="date" 
                       class="input input-bordered w-full {{ $errors->has('date') ? 'input-error' : '' }}" 
                       required value="{{ old('date', date('Y-m-d')) }}">
                @error('date') 
                    <span class="text-error text-sm mt-1 block">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </span> 
                @enderror
            </div>

            <div>
                <label class="label" for="category">Categoria</label>
                <select name="category" id="category" 
                        class="select select-bordered w-full {{ $errors->has('category') ? 'select-error' : '' }}" 
                        required>
                    <option value="">Selecione...</option>
                    <option value="comportamento" {{ old('category') == 'comportamento' ? 'selected' : '' }}>Comportamento</option>
                    <option value="aprendizagem" {{ old('category') == 'aprendizagem' ? 'selected' : '' }}>Aprendizagem</option>
                    <option value="socializacao" {{ old('category') == 'socializacao' ? 'selected' : '' }}>Socialização</option>
                    <option value="desenvolvimento" {{ old('category') == 'desenvolvimento' ? 'selected' : '' }}>Desenvolvimento</option>
                    <option value="outro" {{ old('category') == 'outro' ? 'selected' : '' }}>Outro</option>
                </select>
                @error('category') 
                    <span class="text-error text-sm mt-1 block">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </span> 
                @enderror
            </div>

            <div>
                <label class="label" for="status">Status</label>
                <select name="status" id="status" 
                        class="select select-bordered w-full {{ $errors->has('status') ? 'select-error' : '' }}" 
                        required>
                    <option value="">Selecione...</option>
                    <option value="melhorou" {{ old('status') == 'melhorou' ? 'selected' : '' }}>Melhorou</option>
                    <option value="manteve" {{ old('status') == 'manteve' ? 'selected' : '' }}>Manteve</option>
                    <option value="piorou" {{ old('status') == 'piorou' ? 'selected' : '' }}>Piorou</option>
                </select>
                @error('status') 
                    <span class="text-error text-sm mt-1 block">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </span> 
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <label class="label" for="description">Descrição do Andamento</label>
            <textarea name="description" id="description" rows="6" 
                      class="textarea textarea-bordered w-full {{ $errors->has('description') ? 'textarea-error' : '' }}"
                      placeholder="Descreva detalhadamente o andamento do aluno..."
                      required>{{ old('description') }}</textarea>
            @error('description') 
                <span class="text-error text-sm mt-1 block">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </span> 
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i> Registrar Andamento
            </button>
        </div>
    </form>
</div>
@endsection 