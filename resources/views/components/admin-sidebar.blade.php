<aside x-data="{ openMenu: null }" class="bg-[#0A0F1A] w-64 text-white shadow-2xl h-screen fixed top-0 left-0 flex flex-col z-40">
    <div class="flex items-center justify-center h-20 border-b border-gray-700/50 flex-shrink-0">
        <div class="flex items-center gap-3">
            <img src="{{ asset('/assets/img/logo.svg') }}" class="h-8 w-8" />
            <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-transparent">sisUni</span>
        </div>
    </div>
    
    <nav class="flex-1 flex flex-col p-4 space-y-2 overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:bg-gray-800/40 [&::-webkit-scrollbar-thumb]:bg-gray-600 hover:[&::-webkit-scrollbar-thumb]:bg-gray-500 [&::-webkit-scrollbar-thumb]:rounded-full">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 py-3 px-4 text-gray-100 hover:bg-gray-900/90 rounded-xl transition-all duration-200 group
            {{ Route::is('admin.dashboard') ? 'bg-gray-900/90 text-white' : '' }}">
            <i class="fa-solid fa-house w-5 text-center group-hover:text-blue-400 transition-colors duration-200"></i>
            <span class="font-semibold text-lg group-hover:text-blue-400 transition-colors duration-200">Dashboard</span>
        </a>

        @php
            $navItems = [
                'users' => ['icon' => 'fa-users', 'label' => 'Usuários', 'routes' => ['admin.users.create', 'admin.users.index'], 'subItems' => [
                    ['route' => 'admin.users.create', 'label' => 'Criar Usuário'],
                    ['route' => 'admin.users.index', 'label' => 'Listar Usuários'],
                ]],
                'turmas' => ['icon' => 'fa-chalkboard', 'label' => 'Turmas', 'routes' => ['admin.turmas.create', 'admin.turmas.index', 'admin.atribuir-turmas.index'], 'subItems' => [
                    ['route' => 'admin.turmas.create', 'label' => 'Criar Turma'],
                    ['route' => 'admin.turmas.index', 'label' => 'Listar Turmas'],
                    ['route' => 'admin.atribuir-turmas.index', 'label' => 'Atribuir Turmas'],
                ]],
                'students' => ['icon' => 'fa-graduation-cap', 'label' => 'Alunos', 'routes' => ['admin.students.create', 'admin.students.index'], 'subItems' => [
                    ['route' => 'admin.students.create', 'label' => 'Cadastrar Aluno'],
                    ['route' => 'admin.students.index', 'label' => 'Listar Alunos'],
                ]],
                'forms' => ['icon' => 'fa-wpforms', 'label' => 'Formulários', 'routes' => ['admin.fields.create', 'admin.fields.index', 'admin.forms.create', 'admin.forms.index'], 'subItems' => [
                    ['route' => 'admin.fields.create', 'label' => 'Criar Campo'],
                    ['route' => 'admin.fields.index', 'label' => 'Gerenciar Campos'],
                    ['route' => 'admin.forms.create', 'label' => 'Criar Formulário'],
                    ['route' => 'admin.forms.index', 'label' => 'Administrar Formulários'],
                ]],
                'anamneses' => ['icon' => 'fa-file-medical', 'label' => 'Anamneses', 'routes' => ['admin.anamneses.index'], 'subItems' => [
                    ['route' => 'admin.anamneses.index', 'label' => 'Gerenciar Anamneses'],
                ]],
            ];
        @endphp

        @foreach ($navItems as $key => $item)
            <div class="group" x-data="{ open: {{ json_encode(collect($item['routes'])->some(fn($route) => Route::is($route))) }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between gap-3 py-3 px-4 text-gray-100 hover:bg-gray-900/90 rounded-xl transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid {{ $item['icon'] }} w-5 text-center group-hover:text-blue-400 transition-colors duration-200"></i>
                        <span class="font-semibold text-lg group-hover:text-blue-400 transition-colors duration-200">{{ $item['label'] }}</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-sm transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                </button>
                <ul x-show="open" x-collapse class="ml-4 mt-2 space-y-2">
                    @foreach ($item['subItems'] as $subItem)
                        <li>
                            <a href="{{ route($subItem['route']) }}" class="flex items-center gap-2 px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ Route::is($subItem['route']) ? 'text-blue-400' : 'text-gray-200 hover:text-blue-400' }}">
                                <i class="fa-solid fa-circle text-[6px]"></i>
                                <span>{{ $subItem['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        <div class="mt-auto pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="w-full flex items-center gap-3 py-3 px-4 text-gray-100 hover:bg-gray-900/90 rounded-xl transition-all duration-200 group">
                    <i class="fa-solid fa-sign-out-alt w-5 text-center group-hover:text-red-400 transition-colors duration-200"></i>
                    <span class="font-semibold text-lg group-hover:text-red-400 transition-colors duration-200">Sair</span>
                </button>
            </form>
        </div>
    </nav>
</aside>