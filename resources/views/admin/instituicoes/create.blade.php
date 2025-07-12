@extends('layouts.master')

@section('content')
<div class="flex-1 min-h-screen bg-gray-50">
    <div class="py-8 px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Header com breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors duration-200">
                    <i class="fas fa-home"></i>
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('admin.instituicoes.index') }}" class="hover:text-blue-600 transition-colors duration-200">Instituições</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-700">Nova Instituição</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Nova Instituição</h1>
            <p class="mt-2 text-base text-gray-600">Preencha as informações para criar uma nova instituição.</p>
        </div>

        <!-- Card do Formulário -->
        <div class="bg-white shadow-lg rounded-2xl">
            <div class="p-8">
                <form action="{{ route('admin.instituicoes.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Nome -->
                        <div class="relative">
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome da Instituição</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-building text-gray-400"></i>
                                </div>
                                <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o nome da instituição">
                            </div>
                            @error('nome')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CNPJ -->
                        <div class="relative">
                            <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-2">CNPJ</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o CNPJ">
                            </div>
                            @error('cnpj')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="relative">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o email">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div class="relative">
                            <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite o telefone">
                            </div>
                            @error('telefone')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cidade -->
                        <div class="relative">
                            <label for="cidade" class="block text-sm font-medium text-gray-700 mb-2">Cidade</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-city text-gray-400"></i>
                                </div>
                                <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Digite a cidade">
                            </div>
                            @error('cidade')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- UF -->
                        <div class="relative">
                            <label for="uf" class="block text-sm font-medium text-gray-700 mb-2">UF</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <select name="uf" id="uf"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione o estado</option>
                                    @foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $estado)
                                        <option value="{{ $estado }}" {{ old('uf') == $estado ? 'selected' : '' }}>
                                            {{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('uf')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Plano -->
                        <div class="relative">
                            <label for="plan_id" class="block text-sm font-medium text-gray-700 mb-2">Plano</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-crown text-gray-400"></i>
                                </div>
                                <select name="plan_id" id="plan_id"
                                    class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione um plano</option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('plan_id')
                                <p class="mt-2 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.instituicoes.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Criar Instituição
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
