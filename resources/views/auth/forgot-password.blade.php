<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Senha - SisUni</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-CkUfopgh.css') }}">
    @livewireStyles
</head>

<body class="font-['Poppins'] antialiased min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 mb-4">
                            <i class="fas fa-key text-white text-2xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Recuperar Senha</h2>
                        <p class="text-gray-600">Não se preocupe! Vamos te ajudar a recuperar sua senha.</p>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-600 text-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl bg-white/50 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200"
                                    placeholder="seu@email.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Voltar para login
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Enviar link
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

