<aside id="sidebar"
    class="sidebar flex flex-col bg-[#1C2434] text-white p-4 transition-transform transform -translate-x-full md:translate-x-0">
    <div class="flex items-start mb-[40px] mt-[40px]">
        <h2 class="flex gap-4 text-2xl font-bold">
            <img src="{{ asset('/assets/img/logo.svg') }}" />
            <span class="text-4xl">sisUni</span>
        </h2>
    </div>
    <nav class="flex flex-col mt-4 gap-y-4">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded
          {{ Route::is('admin.dashboard') ? 'bg-gray-600' : '' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600 text-[#DEE4EE] rounded
                {{ Route::is('admin.users.*') ? 'bg-gray-600' : '' }}"
                onclick="toggleSubmenu('userSubmenu')">
                <i class="fa-solid fa-users"></i>
                Usuários
            </a>
            <ul id="userSubmenu" class="ml-4 {{ Route::is('admin.users.*') ? '' : 'hidden' }}">
                <li><a href="{{ route('admin.users.create') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">Criar Usuário</a></li>
                <li><a href="{{ route('admin.users.index') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">Listar Usuários</a></li>
            </ul>
        </div>

        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600 text-[#DEE4EE] rounded
                {{ Route::is('admin.turmas.*') || Route::is('admin.atribuir-turmas.*') ? 'bg-gray-600' : '' }}"
                onclick="toggleSubmenu('turmaSubmenu')">
                <i class="fa-solid fa-chalkboard"></i>
                Turmas
            </a>
            <ul id="turmaSubmenu" class="ml-4 {{ Route::is('admin.turmas.*') || Route::is('admin.atribuir-turmas.*') ? '' : 'hidden' }}">
                <li><a href="{{ route('admin.turmas.create') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">Criar Turma</a></li>
                <li><a href="{{ route('admin.turmas.index') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">Listar Turmas</a></li>
                <li><a href="{{ route('admin.atribuir-turmas.index') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">Atribuir Turmas</a></li>
            </ul>
        </div>

        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600 text-[#DEE4EE] rounded
                {{ Route::is('admin.instituicoes.*') ? 'bg-gray-600' : '' }}"
                onclick="toggleSubmenu('instituicaoSubmenu')">
                <i class="fa-solid fa-building"></i>
                Instituições
            </a>
            <ul id="instituicaoSubmenu" class="ml-4 {{ Route::is('admin.instituicoes.*') ? '' : 'hidden' }}">
                <li><a href="{{ route('admin.instituicoes.create') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">Criar Instituição</a></li>
                <li><a href="{{ route('admin.instituicoes.index') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">Listar Instituições</a></li>
            </ul>
        </div>

        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600 text-[#DEE4EE] rounded
                {{ Route::is('admin.forms.*') || Route::is('admin.fields.*') ? 'bg-gray-600' : '' }}"
                onclick="toggleSubmenu('formSubmenu')">
                <i class="fa-solid fa-wpforms"></i>
                Formulários
            </a>
            <ul id="formSubmenu" class="ml-4 {{ Route::is('admin.forms.*') || Route::is('admin.fields.*') ? '' : 'hidden' }}">
                <li><a href="{{ route('admin.fields.create') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Criar Campo</a></li>
                <li><a href="{{ route('admin.fields.index') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Gerenciar Campos</a></li>
                <li><a href="{{ route('admin.forms.create') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Criar Formulário</a></li>
                <li><a href="{{ route('admin.forms.index') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Administrar Formulários</a></li>
            </ul>
        </div>

        <div class="group">
            <a href="#" class="flex items-center gap-4 py-2 px-4 hover:bg-gray-600 text-[#DEE4EE] rounded"
                onclick="toggleSubmenu('institutionSubmenu')">
                <i class="fa-solid fa-building"></i>
                Instituição
            </a>
            <ul id="institutionSubmenu" class="hidden ml-4">
                <li>
                    <a href="{{ route('institution.invites.index') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">
                        Histórico de Convites
                    </a>
                </li>
                <li>
                    <a href="{{ route('institution.invites.create') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">
                        Novo Convite
                    </a>
                </li>
                <li>
                    <a href="{{ route('plans.index') }}"
                       class="block px-4 py-1 rounded hover:bg-gray-700 text-[#DEE4EE]">
                        Planos
                    </a>
                </li>
            </ul>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 py-2 px-4 text-[#DEE4EE] hover:bg-gray-600 rounded">
                <i class="fa-solid fa-sign-out-alt"></i>
                Sair
            </button>
        </form>
    </nav>
</aside>
