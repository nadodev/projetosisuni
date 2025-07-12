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
    <link rel="stylesheet" href="{{ asset('build/assets/app-CyEKRNSM.css') }}">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        <img src="{{ asset('/assets/img/logo.svg') }}" alt="SisUni Logo" class="h-8 w-auto">
                        <span class="text-2xl font-bold text-purple-600">sisUni</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#sobre" class="text-gray-600 hover:text-purple-600 transition-colors">Sobre</a>
                    <a href="#como-funciona" class="text-gray-600 hover:text-purple-600 transition-colors">Como Funciona</a>
                    <a href="#funcionalidades" class="text-gray-600 hover:text-purple-600 transition-colors">Funcionalidades</a>
                    <a href="#contato" class="text-gray-600 hover:text-purple-600 transition-colors">Contato</a>
                  @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-purple-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-purple-600 transition-colors">Entrar</a>
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
                    <a href="#contato" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Contato</a>
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-600 hover:text-purple-600">Entrar</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-gray-600 font-semibold">Começar Agora</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16">
        {{ $slot }}
    </main>

    <!-- Accessibility Menu -->
    <div x-data="{ open: false }" class="fixed bottom-4 right-4 z-50">
        <button @click="open = true" class="btn btn-primary btn-circle">
            <i class="fas fa-universal-access"></i>
        </button>

        <!-- Modal -->
        <div x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md" @click.away="open = false">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Acessibilidade</h3>
                    <button @click="open = false" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold mb-2">Tamanho da Fonte</h4>
                        <div class="flex space-x-2">
                            <button class="btn btn-sm flex-1" onclick="fontOriginal()">
                                <i class="fas fa-text-height mr-2"></i> Original
                            </button>
                            <button class="btn btn-sm flex-1" onclick="increaseFontSize()">
                                <i class="fas fa-search-plus mr-2"></i> Aumentar
                            </button>
                            <button class="btn btn-sm flex-1" onclick="decreaseFontSize()">
                                <i class="fas fa-search-minus mr-2"></i> Diminuir
                            </button>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Contraste</h4>
                        <div class="flex items-center justify-between">
                            <span>Alto Contraste</span>
                            <input type="checkbox" class="toggle toggle-primary" onchange="toggleHighContrast()" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cookie Consent -->
    <div x-data="cookieConsent" x-show="showBanner" x-cloak class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5 z-50">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="p-4 bg-gray-800 rounded-lg shadow-lg sm:p-6">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <p class="ml-3 font-medium text-white">
                            <span class="md:hidden">Nós usamos cookies para te dar a melhor experiência.</span>
                            <span class="hidden md:inline">Este site usa cookies para garantir que você tenha a melhor experiência de navegação.</span>
                        </p>
                    </div>
                    <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                        <button @click="acceptAll" class="btn btn-primary btn-block">Aceitar todos</button>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
                        <button @click="openSettings" class="btn btn-secondary btn-block">Preferências</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Modal -->
        <div x-show="showSettings" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md" @click.away="closeSettings">
                <h3 class="text-xl font-semibold mb-4">Preferências de Cookies</h3>
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center justify-between">
                            <span>Necessários</span>
                            <input type="checkbox" class="checkbox" name="necessary" checked disabled>
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Esses cookies são essenciais para o funcionamento do site.</p>
                    </div>
                    <div>
                        <label class="flex items-center justify-between">
                            <span>Analytics</span>
                            <input type="checkbox" class="checkbox cookie-checkbox" name="analytics">
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Esses cookies nos ajudam a entender como os visitantes usam o site.</p>
                    </div>
                    <div>
                        <label class="flex items-center justify-between">
                            <span>Marketing</span>
                            <input type="checkbox" class="checkbox cookie-checkbox" name="marketing">
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Esses cookies são usados para exibir anúncios relevantes.</p>
                    </div>
                    <div>
                        <label class="flex items-center justify-between">
                            <span>Preferências</span>
                            <input type="checkbox" class="checkbox cookie-checkbox" name="preferences">
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Esses cookies armazenam suas preferências de personalização.</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button @click="savePreferences" class="btn btn-primary">Salvar</button>
                    <button @click="closeSettings" class="btn btn-ghost">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    @livewire('wire-elements-modal')
    <script src="{{ asset('js/cookie-consent.js') }}"></script>
    <script src="{{ asset('js/accessibility.js') }}"></script>

</body>
</html> 