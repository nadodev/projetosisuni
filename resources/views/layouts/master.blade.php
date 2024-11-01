<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-DZ0lIMIZ.css') }}"> --}}
</head>

<body class="h-screen bg-gray-100">
    <div id="layout"
        class="grid grid-cols-1  md:grid-cols-[16rem,1fr] transition-all duration-300 ease-in-out h-screen">
        @include('components.sidebar')
        <div class="flex flex-col">
            @include('components.header')
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        const sidebar = document.getElementById("sidebar");
        const layout = document.getElementById("layout");
        const toggleSidebar = document.getElementById("toggleSidebar");
        const closeSidebar = document.getElementById("closeSidebar");

        function toggleSidebarVisibility() {
            sidebar.classList.add("-translate-x-full");

            if (sidebar.classList.contains("-translate-x-full")) {
                layout.classList.toggle("md:grid-cols-[16rem,1fr]");
                layout.classList.add("grid-cols-1");
                sidebar.classList.toggle("hidden");
                sidebar.classList.remove("-translate-x-full");
                console.log("entrou");

            } else {
                layout.classList.remove("grid-cols-1");
                console.log("saiu");
                sidebar.classList.remove("hidden");

                layout.classList.add("md:grid-cols-[16rem,1fr]");
            }
        }

        toggleSidebar.addEventListener("click", toggleSidebarVisibility);
        closeSidebar?.addEventListener("click", toggleSidebarVisibility);
    </script>
    <script>
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id);
            submenu.classList.toggle('hidden');
        }
    </script>
</body>

</html>
