<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-BnevzZkE.css') }}">
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div id="layout"
    class="grid grid-cols-1 md:grid-cols-[16rem,1fr] transition-all duration-300 ease-in-out h-screen">        @auth
            @if(auth()->user()->role === 'user_admin')
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
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            if (submenu) {
                submenu.classList.toggle('hidden');
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
