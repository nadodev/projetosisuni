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
        <link rel="stylesheet" href="{{ asset('build/assets/app-El_R8l8g.css') }}">

    @livewireStyles
</head>

<body class="font-['Poppins'] antialiased min-h-screen">
    <div class="min-h-screen flex">
        <!-- Left Side - Login Form -->
        <div class="flex-1 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <a href="{{ route('landing') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voltar para o site
                    </a>
                </div>

                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Bem-vindo de volta!</h1>
                    <p class="text-gray-600">Entre para acessar sua conta</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-purple-600" 
                                   :value="old('email')" 
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   placeholder="seu@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" 
                                   name="password" 
                                   type="password" 
                                   class="block w-full pl-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-purple-600" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <!-- <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-600">
                            <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-700">
                                Esqueceu a senha?
                            </a>
                        @endif
                    </div> -->

                    <button type="submit" class="w-full bg-purple-600 text-white py-3 px-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2 transition-colors text-lg font-medium">
                        Entrar
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Side - Brand Info -->
        <div class="hidden sm:flex md:flex lg:flex lg:w-1/2 bg-gradient-to-br from-purple-600 to-blue-600 p-12">
            <div class="w-full max-w-2xl mx-auto flex flex-col justify-center">
                <div class="mb-12">
                    <img src="{{ asset('/assets/img/logo.svg') }}" alt="SisUni Logo" class="h-16 w-auto mb-6">
                    <h2 class="text-4xl font-bold text-white mb-4">SisUni</h2>
                    <p class="text-xl text-purple-100">Tecnologia com propósito</p>
                </div>
                
                <div class="space-y-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-3xl text-purple-200"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Gestão Simplificada</h3>
                            <p class="text-purple-100 text-lg">Gerencie documentos e alunos de forma eficiente e organizada</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-3xl text-purple-200"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Acessibilidade Total</h3>
                            <p class="text-purple-100 text-lg">Interface adaptável para todas as necessidades e perfis</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-3xl text-purple-200"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Suporte Dedicado</h3>
                            <p class="text-purple-100 text-lg">Equipe especializada para ajudar você em cada etapa</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-purple-500">
                    <div class="flex space-x-6">
                        <a href="#" class="text-purple-200 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="text-purple-200 hover:text-white transition-colors">
                            <i class="fab fa-linkedin text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
