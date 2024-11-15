<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div id="layout"
        class="grid grid-cols-1 md:grid-cols-[16rem,1fr] transition-all duration-300 ease-in-out h-screen"> @auth
            @if (auth()->user()->role === 'user_admin')
                <x-admin-sidebar />
            @elseif(auth()->user()->role === 'user_teacher')
                <x-teacher-sidebar />
            @else
                <x-student-sidebar />
            @endif
        @else
            <x-guest-sidebar />
        @endauth

        <div class="flex flex-col">
            @include('components.header')
            <main class="p-4">
                @auth
                    <div class="mb-4 text-sm text-gray-600">
                        Instituição: {{ auth()->user()->instituicao->nome }}
                    </div>
                @endauth
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js"
        integrity="sha512-DEcSaL0BWApJ//v7ZfqAI04nvK+NQcUVwrrx/l1x7OJgU0Cwbq7e459NBMzLPrm8eLPzAwBtiJJS4AvLZDZ8xA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Garante que o token CSRF está disponível globalmente
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    </script>
    <script>
        $(function() {
            $("#sortable").sortable();
        });
    </script>
</body>

</html>
