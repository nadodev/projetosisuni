<form method="post" action="{{ route('profile.address') }}" class="space-y-6">
    @csrf
    @method('patch')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- CEP -->
        <div>
            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input type="text" name="cep" id="cep"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('cep', $user->cep) }}"
                    maxlength="8"
                    required>
            </div>
            <x-input-error :messages="$errors->get('cep')" class="mt-2" />
        </div>

        <!-- Endereço -->
        <div class="md:col-span-2">
            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
            <div class="mt-1">
                <input type="text" name="endereco" id="endereco"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('endereco', $user->endereco) }}"
                    required>
            </div>
            <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
        </div>

        <!-- Número e Complemento -->
        <div>
            <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
            <div class="mt-1">
                <input type="text" name="numero" id="numero"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('numero', $user->numero) }}"
                    required>
            </div>
            <x-input-error :messages="$errors->get('numero')" class="mt-2" />
        </div>

        <div>
            <label for="complemento" class="block text-sm font-medium text-gray-700">Complemento</label>
            <div class="mt-1">
                <input type="text" name="complemento" id="complemento"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('complemento', $user->complemento) }}">
            </div>
            <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
        </div>

        <!-- Bairro -->
        <div>
            <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
            <div class="mt-1">
                <input type="text" name="bairro" id="bairro"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('bairro', $user->bairro) }}"
                    required>
            </div>
            <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
        </div>

        <!-- Cidade -->
        <div>
            <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
            <div class="mt-1">
                <input type="text" name="cidade" id="cidade"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ old('cidade', $user->cidade) }}"
                    required>
            </div>
            <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
        </div>

        <!-- UF -->
        <div>
            <label for="uf" class="block text-sm font-medium text-gray-700">UF</label>
            <div class="mt-1">
                <select id="uf" name="uf"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    <option value="">Selecione...</option>
                    @foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $estado)
                        <option value="{{ $estado }}" {{ old('uf', $user->uf) == $estado ? 'selected' : '' }}>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
            </div>
            <x-input-error :messages="$errors->get('uf')" class="mt-2" />
        </div>
    </div>

    <div class="flex justify-end mt-6">
        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Salvar Endereço
        </button>
    </div>
</form>
