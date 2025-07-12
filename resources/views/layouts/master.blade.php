<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>[x-cloak] { display: none !important; }</style>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full bg-gray-50">
    <div x-data="{ open: false }" class="min-h-screen">
        <!-- Botão Toggle Mobile -->
        <button 
            type="button"
            @click="open = !open" 
            class="lg:hidden fixed z-50 top-4 left-4 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-[#0A0F1A] text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white transition-colors duration-200">
            <span class="sr-only">Abrir menu</span>
            <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
        </button>

        <!-- Overlay -->
        <template x-if="open">
            <div 
                class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden"
                @click="open = false">
            </div>
        </template>

        <div class="flex">
            <!-- Sidebar Desktop -->
            <div class="hidden lg:block w-64 flex-shrink-0">
                <x-admin-sidebar />
            </div>

            <!-- Main Content -->
            <main class="flex-1">
                <header class="bg-white shadow-sm sticky top-0 z-30">
                    <div class="max-w-full mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <!-- Pode adicionar um título da página aqui se desejar -->
                            </div>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                    <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="">
                                </button>
                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50" x-cloak>
                                    <div class="px-4 py-2 border-b">
                                        <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); this.closest('form').submit();"
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Sair
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="p-6">
                    <!-- Mensagens de Sessão -->
                @if(session('success'))
                    <div class="alert alert-success m-4">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error m-4">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning m-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        {{ session('warning') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info m-4">
                        <i class="fas fa-info-circle mr-2"></i>
                        {{ session('info') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <wireui:scripts />
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    @livewire('wire-elements-modal')
    @stack('scripts')
</body>

</html>
