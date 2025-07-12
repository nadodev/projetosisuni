<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - SisUni</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('build/assets/app-CkUfopgh.css') }}">

    @livewireStyles
</head>

<body class="font-['Poppins'] antialiased min-h-screen">
    <div class="min-h-screen flex">
           <!-- Left Side - Login Form -->
           <div class="flex-1 flex items-center justify-center p-8 bg-gradient-to-br from-purple-100 to-blue-100">
               <div class="min-h-screen flex flex-col justify-center items-center  py-8">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-gradient-to-br from-purple-500 to-blue-500 rounded-full p-3 mb-2">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-1">Criar Conta</h2>
            <p class="text-gray-500 text-center">Preencha os dados para se registrar no SisUni</p>
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-user"></i></span>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="pl-10 pr-3 py-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                </div>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-envelope"></i></span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="pl-10 pr-3 py-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- CPF -->
            <div>
                <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-id-card"></i></span>
                    <input id="cpf" type="text" name="cpf" value="{{ old('cpf') }}" required
                        class="pl-10 pr-3 py-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                </div>
                @error('cpf')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- Data de Nascimento -->
            <div>
                <label for="data_nascimento" class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-birthday-cake"></i></span>
                    <input id="data_nascimento" type="date" name="data_nascimento" value="{{ old('data_nascimento') }}" required
                        class="pl-10 pr-3 py-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                </div>
                @error('data_nascimento')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- Gênero -->
            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700 mb-1">Gênero</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-venus-mars"></i></span>
                    <select id="genero" name="genero" required
                        class="pl-10 pr-3 py-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <option value="">Selecione</option>
                        <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="feminino" {{ old('genero') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                        <option value="outro" {{ old('genero') == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                </div>
                @error('genero')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            </div>
            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-gray-600 hover:text-purple-600" href="{{ route('login') }}">
                    Já tem uma conta?
                </a>
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50 transition-all">
                    Registrar
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
</div>

@livewireScripts
</body>
</html>
