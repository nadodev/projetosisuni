@extends('layouts.master')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- Header com breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">Usuários</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-700">Criar Usuário</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Criar Novo Usuário</h2>
            <p class="mt-2 text-gray-600">Preencha os dados abaixo para criar um novo usuário no sistema.</p>
        </div>

        <div class="bg-white shadow-lg rounded-2xl">
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="Digite o nome completo">
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="Digite o email">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Função -->
                    <div class="col-span-2">
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Função no Sistema</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-shield text-gray-400"></i>
                            </div>
                            <select name="role" id="role" 
                                class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">Selecione uma função</option>
                                <option value="user_admin" {{ old('role') == 'user_admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="user_teacher" {{ old('role') == 'user_teacher' ? 'selected' : '' }}>Professor</option>
                                <option value="user_student" {{ old('role') == 'user_student' ? 'selected' : '' }}>Estudante</option>
                            </select>
                        </div>
                        @error('role')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" id="password"
                                class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="Digite a senha">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar Senha -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="Confirme a senha">
                        </div>
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex justify-end gap-4 mt-8">
                    <a href="{{ route('admin.users.index') }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>
                        Criar Usuário
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
