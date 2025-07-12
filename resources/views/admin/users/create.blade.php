@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Novo Usuário</h1>
                <p class="mt-2 text-sm text-gray-700">Preencha os dados para criar um novo usuário.</p>
            </div>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="mt-8 space-y-6">
            @csrf

            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <!-- Nome -->
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div class="mt-2">
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CPF -->
                        <div class="sm:col-span-3">
                            <label for="cpf" class="block text-sm font-medium leading-6 text-gray-900">CPF</label>
                            <div class="mt-2">
                                <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('cpf')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="sm:col-span-3">
                            <label for="data_nascimento" class="block text-sm font-medium leading-6 text-gray-900">Data de
                                Nascimento</label>
                            <div class="mt-2">
                                <input type="date" name="data_nascimento" id="data_nascimento"
                                    value="{{ old('data_nascimento') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('data_nascimento')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gênero -->
                        <div class="sm:col-span-3">
                            <label for="genero" class="block text-sm font-medium leading-6 text-gray-900">Gênero</label>
                            <div class="mt-2">
                                <select name="genero" id="genero"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Selecione</option>
                                    <option value="masculino" {{ old('genero')=='masculino' ? 'selected' : '' }}>Masculino
                                    </option>
                                    <option value="feminino" {{ old('genero')=='feminino' ? 'selected' : '' }}>Feminino
                                    </option>
                                    <option value="outro" {{ old('genero')=='outro' ? 'selected' : '' }}>Outro</option>
                                </select>
                            </div>
                            @error('genero')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div class="sm:col-span-3">
                            <label for="telefone" class="block text-sm font-medium leading-6 text-gray-900">Telefone</label>
                            <div class="mt-2">
                                <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('telefone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CEP -->
                        <div class="sm:col-span-3">
                            <label for="cep" class="block text-sm font-medium leading-6 text-gray-900">CEP</label>
                            <div class="mt-2">
                                <input type="text" name="cep" id="cep" value="{{ old('cep') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('cep')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Endereço -->
                        <div class="sm:col-span-4">
                            <label for="endereco"
                                class="block text-sm font-medium leading-6 text-gray-900">Endereço</label>
                            <div class="mt-2">
                                <input type="text" name="endereco" id="endereco" value="{{ old('endereco') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('endereco')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Número -->
                        <div class="sm:col-span-2">
                            <label for="numero" class="block text-sm font-medium leading-6 text-gray-900">Número</label>
                            <div class="mt-2">
                                <input type="text" name="numero" id="numero" value="{{ old('numero') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('numero')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Complemento -->
                        <div class="sm:col-span-6">
                            <label for="complemento"
                                class="block text-sm font-medium leading-6 text-gray-900">Complemento</label>
                            <div class="mt-2">
                                <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('complemento')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bairro -->
                        <div class="sm:col-span-2">
                            <label for="bairro" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                            <div class="mt-2">
                                <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('bairro')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cidade -->
                        <div class="sm:col-span-2">
                            <label for="cidade" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                            <div class="mt-2">
                                <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('cidade')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- UF -->
                        <div class="sm:col-span-2">
                            <label for="uf" class="block text-sm font-medium leading-6 text-gray-900">UF</label>
                            <div class="mt-2">
                                <select name="uf" id="uf"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Selecione</option>
                                    @foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $estado)
                                    <option value="{{ $estado }}" {{ old('uf')==$estado ? 'selected' : '' }}>{{ $estado }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('uf')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instituição -->
                        <div class="sm:col-span-3">
                            <label for="institution_id"
                                class="block text-sm font-medium leading-6 text-gray-900">Instituição</label>
                            <div class="mt-2">
                                <select name="institution_id" id="institution_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Selecione</option>
                                    @foreach($instituicoes as $instituicao)
                                    <option value="{{ $instituicao->id }}" {{ old('institution_id')==$instituicao->id ?
                                        'selected' : '' }}>
                                        {{ $instituicao->nome }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('institution_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categoria -->
                        <div class="sm:col-span-3">
                            <label for="categoria_id"
                                class="block text-sm font-medium leading-6 text-gray-900">Categoria</label>
                            <div class="mt-2">
                                <select name="categoria_id" id="categoria_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Selecione</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id')==$categoria->id ? 'selected'
                                        : '' }}>
                                        {{ $categoria->nome }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('categoria_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Perfil -->
                        <div class="sm:col-span-3">
                            <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Perfil</label>
                            <div class="mt-2">
                                <select name="role" id="role"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Selecione</option>
                                    <option value="user_admin" {{ old('role')=='user_admin' ? 'selected' : '' }}>
                                        Administrador</option>
                                    <option value="user_teacher" {{ old('role')=='user_teacher' ? 'selected' : '' }}>
                                        Professor</option>
                                    <option value="user_student" {{ old('role')=='user_student' ? 'selected' : '' }}>
                                        Estudante</option>
                                </select>
                            </div>
                            @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Senha -->
                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="sm:col-span-3">
                            <label for="password_confirmation"
                                class="block text-sm font-medium leading-6 text-gray-900">Confirmar Senha</label>
                            <div class="mt-2">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="{{ route('admin.users.index') }}"
                        class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
