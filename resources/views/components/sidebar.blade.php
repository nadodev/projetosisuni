<style>
    @media (max-width: 767px) {
        .sidebar {
            display: none;
        }
    }
</style>

<aside id="sidebar"
    class="sidebar flex flex-col bg-[#1C2434] text-white p-4 transition-transform transform -translate-x-full md:translate-x-0">
    <div class="flex items-start mb-[40px] mt-[40px]">
        <h2 class="text-2xl font-bold flex gap-4">
            <img src="{{ asset('/assets/img/logo.svg') }}" />
            <span class="text-4xl	">sisUni</span>
        </h2>
    </div>
    <nav class="mt-4 gap-y-4 flex flex-col">
        <a href="#"
            class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600 bg-gray-600 text-[#DEE4EE]   rounded">
            <i class="fa-solid fa-house"></i>
            Página Inicial</a>

        <!-- Item com Submenu -->
        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600 text-[#DEE4EE]   rounded"
                onclick="toggleSubmenu('cadastroSubmenu')">
                <i class="fa-solid fa-pen-to-square"></i>
                Cadastro
            </a>
            <ul id="cadastroSubmenu" class="ml-4 hidden">
                <li><a href="#" class="block py-1 px-4 hover:bg-gray-700 rounded">Novo Cadastro</a></li>
                <li><a href="#" class="block py-1 px-4 hover:bg-gray-700 rounded">Listar Cadastros</a></li>
            </ul>
        </div>

        <!-- Outro Item com Submenu -->
        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600  text-[#DEE4EE]   rounded"
                onclick="toggleSubmenu('relatoriosSubmenu')">
                <i class="fa-solid fa-file-lines"></i>
                Relatórios
            </a>
            <ul id="relatoriosSubmenu" class="ml-4 hidden">
                <li><a href="#" class="block py-1 px-4 hover:bg-gray-700 rounded">Relatório Mensal</a></li>
                <li><a href="#" class="block py-1 px-4 hover:bg-gray-700 rounded">Relatório Anual</a></li>
            </ul>
        </div>

        <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600  text-[#DEE4EE]   rounded">
            <i class="fa-solid fa-gear"></i>
            Configurações
        </a>
    </nav>
</aside>
