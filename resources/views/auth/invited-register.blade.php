<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Você foi convidado para se juntar à instituição. Por favor, complete seu cadastro.') }}
    </div>

    @if(session('error'))
        <div class="mb-4 text-sm text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('invited.register', $invite->token) }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" :value="$invite->email" disabled />
            <p class="mt-1 text-sm text-gray-600">Este é o email para o qual o convite foi enviado.</p>
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full"
                type="text"
                name="cpf"
                :value="old('cpf')"
                required
                maxlength="11"
                minlength="11"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" class="block mt-1 w-full"
                type="text"
                name="telefone"
                :value="old('telefone')"
                required
            />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="mt-4">
            <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
            <x-text-input id="data_nascimento" class="block mt-1 w-full"
                type="date"
                name="data_nascimento"
                :value="old('data_nascimento')"
                required
            />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

        <!-- Gênero -->
        <div class="mt-4">
            <x-input-label for="genero" :value="__('Gênero')" />
            <select id="genero" name="genero" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Selecione...</option>
                <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Feminino</option>
                <option value="O" {{ old('genero') == 'O' ? 'selected' : '' }}>Outro</option>
            </select>
            <x-input-error :messages="$errors->get('genero')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
