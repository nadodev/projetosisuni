<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisUni - Tecnologia com propósito</title>
    <style>[x-cloak] { display: none !important; }</style>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/faviconn.png') }}" type="image/x-icon" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   


    @if (app()->environment('production'))
    <link rel="stylesheet" href="{{ asset('build/assets/app-CyEKRNSM.css') }}">

    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>
<body class="font-['Poppins'] antialiased">
    <!-- Topbar -->
    <header class="fixed w-full bg-white shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ open: false }">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('/images/logo.png') }}" alt="SisUni Logo" class="h-16 w-auto">
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#sobre" class="text-gray-600 hover:text-purple-600 transition-colors">Sobre</a>
                    <a href="#como-funciona" class="text-gray-600 hover:text-purple-600 transition-colors">Como Funciona</a>
                    <a href="#funcionalidades" class="text-gray-600 hover:text-purple-600 transition-colors">Funcionalidades</a>
                    <a href="/contato" class="text-gray-600 hover:text-purple-600 transition-colors">Contato</a>
                  @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-purple-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-purple-600 text-gray-100 px-4  py-1 rounded-full hover:bg-purple-800 transition-colors font-light">Entrar</a>
                @endauth

                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-600 hover:text-purple-600" @click="open = !open">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            <!-- Mobile menu -->
            <div
                x-show="open"
                class="md:hidden bg-white border-t"
            >
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#sobre" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Sobre</a>
                    <a href="#como-funciona" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Como Funciona</a>
                    <a href="#funcionalidades" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Funcionalidades</a>
                    <a href="#planos" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Planos</a>
                    <a href="#depoimentos" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Depoimentos</a>
                    <a href="/contato" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Contato</a>
                    <a href="{{ route('login') }}" class="bg-purple-600 block px-3 py-2 text-gray-100 hover:text-purple-600">Entrar</a>
                   
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16 bg-gray-100">
        {{ $slot }}
    </main>

    @if (Route::currentRouteName() == 'privacidade' || Route::currentRouteName() == 'termos-uso')
    <footer class="bg-gray-900 text-white py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">SisUni</h3>
                    <p class="text-gray-400">Tecnologia com propósito</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Links Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Início</a></li>
                        <li><a href="#sobre" class="text-gray-400 hover:text-white transition-colors">Sobre</a></li>
                        <li><a href="#funcionalidades" class="text-gray-400 hover:text-white transition-colors">Funcionalidades</a></li>
                        <li><a href="/contato" class="text-gray-400 hover:text-white transition-colors">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="/privacidade" class="text-gray-400 hover:text-white transition-colors">Política de Privacidade</a></li>
                        <li><a href="/termos-uso" class="text-gray-400 hover:text-white transition-colors">Termos de Uso</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Redes Sociais</h4>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/uniao_sistemas" target="_blank" class="text-gray-400 hover:text-white transition-colors transform hover:scale-110">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/uni%C3%A3o-sistemas/" target="_blank" class="text-gray-400 hover:text-white transition-colors transform hover:scale-110">
                            <i class="fab fa-linkedin text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SisUni. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
    @endif
    @livewireScripts
    @livewire('wire-elements-modal')
   
    <script src="{{ asset('js/cookie-consent.js') }}"></script>
    <script src="{{ asset('js/accessibility.js') }}"></script>
    @if (app()->environment('production'))
    <script src="{{ asset('build/assets/app-B-q6ydEb.js') }}"></script>
    @endif
</body>
</html> 