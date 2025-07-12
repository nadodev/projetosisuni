<aside id="sidebar"
    class="sidebar flex flex-col bg-[#1C2434] text-white p-4 transition-transform transform -translate-x-full md:translate-x-0">
    <div class="flex items-start mb-[40px] mt-[40px]">
        <h2 class="flex gap-4 text-2xl font-bold">
            <img src="{{ asset('/assets/img/logo.svg') }}" />
            <span class="text-4xl">sisUni</span>
        </h2>
    </div>
    <nav class="flex flex-col mt-4 gap-y-4">
        <a href="{{ route('student.dashboard') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('student.dashboard') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="{{ route('student.forms.index') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('student.forms.*') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-wpforms"></i>
            Formulários
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

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded">
                <i class="fa-solid fa-sign-out-alt"></i>
                Sair
            </button>
        </form>
    </nav>
</aside>
