@extends('layouts.master')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Editar Usuário</h2>
        </div>

        @if(auth()->user()->isAdmin())
            <div class="bg-white shadow sm:rounded-lg">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- CPF --}}
                        <div>
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input type="text" name="cpf" id="cpf" value="{{ old('cpf', $user->cpf) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('cpf')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nome Completo --}}
                        <div>
                            <label for="nome_completo" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                            <input type="text" name="nome_completo" id="nome_completo" value="{{ old('nome_completo', $user->nome_completo) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('nome_completo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Função</label>
                            <select name="role" id="role"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                onchange="toggleTurmaField(this.value)">
                                <option value="user_admin" {{ $user->role === 'user_admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="user_teacher" {{ $user->role === 'user_teacher' ? 'selected' : '' }}>Professor</option>
                                <option value="user_student" {{ $user->role === 'user_student' ? 'selected' : '' }}>Estudante</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Senha (opcional) --}}
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha (opcional)</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirmação de Senha --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nova Senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.users.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Atualizar Usuário
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Acesso Negado!</strong>
                <span class="block sm:inline">Apenas administradores podem editar usuários.</span>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function toggleTurmaField(role) {
        const turmaField = document.getElementById('turma-field');
        if (role === 'user_student') {
            turmaField.classList.remove('hidden');
        } else {
            turmaField.classList.add('hidden');
            document.getElementById('codigo_turma').value = '';
        }
    }
</script>
@endpush
@endsection
