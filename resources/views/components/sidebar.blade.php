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

        <div class="group">
            <a href="#"
                class="
                flex
                items-center
                gap-4
                py-2
                px-4
                hover:bg-gray-600
                text-[#DEE4EE]
                rounded
            {{ Route::is('plano.index') || Route::is('plano.listar') ? 'bg-gray-600' : '' }}
            "
                onclick="toggleSubmenu('cadastroSubmenu')">
                <i class="fa-solid fa-pen-to-square"></i>
                Cadastro
            </a>
            <ul id="cadastroSubmenu" class="{{ Request::segment(1) == 'plano-de-ensino' ? ' ' : 'hidden' }} ml-4">
                <li><a href="{{ route('plano.index') }}"
                        class="flex items-center gap-2 px-4 py-1 rounded hover:bg-gray-700 {{ Route::is('plano.index') ? 'text-white' : 'text-gray-500' }} ">
                        <i class="fa-solid fa-circle text-[8px]  {{ Route::is('plano.index') ? 'text-white' : 'text-gray-500' }}"></i>
                        Novo Cadastro
                    </a>
                </li>
                <li><a href="{{ route('plano.listar') }}"
                        class="flex items-center gap-2 px-4 py-1 rounded hover:bg-gray-700 {{ Route::is('plano.listar') ? 'text-white' : 'text-gray-500' }}">
                        <i class="fa-solid fa-circle text-[8px] {{ Route::is('plano.listar') ? 'text-white' : 'text-gray-500' }}"></i>
                        Listar
                    </a>
                </li>
            </ul>
        </div>

        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600  text-[#DEE4EE]   rounded"
                onclick="toggleSubmenu('relatoriosSubmenu')">
                <i class="fa-solid fa-file-lines"></i>
                Relatórios
            </a>
            <ul id="relatoriosSubmenu" class="hidden ml-4">
                <li><a href="#" class="block px-4 py-1 rounded hover:bg-gray-700">Relatório Mensal</a></li>
                <li><a href="#" class="block px-4 py-1 rounded hover:bg-gray-700">Relatório Anual</a></li>
            </ul>
        </div>

        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600  text-[#DEE4EE]   rounded"
                onclick="toggleSubmenu('formSubmenu')">
                <i class="fa-solid fa-wpforms"></i>
                Formulários
            </a>
            <ul id="formSubmenu" class="hidden ml-4">
                <li><a href="{{ route('fields.create') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Criar Campo</a></li>
                <li><a href="{{ route('fields.index') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Gerenciar Campos</a></li>
                <li><a href="{{ route('forms.create') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Criar Formulário</a></li>
                <li><a href="{{ route('forms.index') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Listar Formulários</a></li>
            </ul>
        </div>

        <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600  text-[#DEE4EE]   rounded">
            <i class="fa-solid fa-gear"></i>
            Configurações
        </a>
    </nav>
</aside>
