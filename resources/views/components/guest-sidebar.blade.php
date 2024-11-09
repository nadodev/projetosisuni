<aside id="sidebar"
    class="sidebar flex flex-col bg-[#1C2434] text-white p-4 transition-transform transform -translate-x-full md:translate-x-0">
    <div class="flex items-start mb-[40px] mt-[40px]">
        <h2 class="flex gap-4 text-2xl font-bold">
            <img src="{{ asset('/assets/img/logo.svg') }}" />
            <span class="text-4xl">sisUni</span>
        </h2>
    </div>
    <nav class="flex flex-col mt-4 gap-y-4">
        <a href="{{ route('home') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('home') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-house"></i>
            Página Inicial
        </a>

        <a href="{{ route('login') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('login') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-sign-in-alt"></i>
            Login
        </a>

        <a href="{{ route('register') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('register') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-user-plus"></i>
            Registrar
        </a>

        <a href="{{ route('chat') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('chat') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-comments"></i>
            Chat
        </a>

        <a href="{{ route('calendar') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('calendar') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-calendar"></i>
            Calendário
        </a>
    </nav>
</aside>
