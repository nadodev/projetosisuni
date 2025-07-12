<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-[#1C2434] to-[#0F172A] text-white shadow-lg">
    <div class="flex items-center justify-center h-20 border-b border-gray-700">
        <div class="flex items-center gap-3">
            <img src="{{ asset('/assets/img/logo.svg') }}" class="h-8 w-8" />
            <span class="text-2xl font-bold">sisUni</span>
        </div>
    </div>
    
    <nav class="flex flex-col p-4 space-y-2 mt-4">
        <a href="{{ route('landing') }}"
            class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200
            {{ Route::is('landing') ? 'bg-gray-700/50 text-white' : '' }}">
            <i class="fa-solid fa-house w-5 text-center"></i>
            <span>Página Inicial</span>
        </a>

        <a href="{{ route('login') }}"
            class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200
            {{ Route::is('login') ? 'bg-gray-700/50 text-white' : '' }}">
            <i class="fa-solid fa-sign-in-alt w-5 text-center"></i>
            <span>Login</span>
        </a>

       

        <a href="{{ route('chat') }}"
            class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200
            {{ Route::is('chat') ? 'bg-gray-700/50 text-white' : '' }}">
            <i class="fa-solid fa-comments w-5 text-center"></i>
            <span>Chat</span>
        </a>

        <a href="{{ route('calendar') }}"
            class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200
            {{ Route::is('calendar') ? 'bg-gray-700/50 text-white' : '' }}">
            <i class="fa-solid fa-calendar w-5 text-center"></i>
            <span>Calendário</span>
        </a>
    </nav>
</aside>
