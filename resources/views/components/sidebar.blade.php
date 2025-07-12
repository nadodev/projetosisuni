<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-[#1C2434] to-[#0F172A] text-white shadow-lg">
    <div class="flex items-center justify-center h-20 border-b border-gray-700">
        <div class="flex items-center gap-3">
            <img src="{{ asset('/assets/img/logo.svg') }}" class="h-8 w-8" />
            <span class="text-2xl font-bold">sisUni</span>
        </div>
    </div>
    
    <nav class="flex flex-col p-4 space-y-2 mt-4">
        @auth
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200
                {{ Route::is('home') ? 'bg-gray-700/50 text-white' : '' }}">
                <i class="fa-solid fa-house w-5 text-center"></i>
                <span>Página Inicial</span>
            </a>

            @if(auth()->user()->isAdmin())
                <div class="group">
                    <a href="#" class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                        <i class="fa-solid fa-users w-5 text-center"></i>
                        <span>Usuários</span>
                    </a>
                    <ul class="ml-8 mt-1 space-y-1">
                        <li>
                            <a href="{{ route('admin.users.create') }}"
                               class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                                <i class="fa-solid fa-circle text-[6px]"></i>
                                Criar Usuário
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                               class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                                <i class="fa-solid fa-circle text-[6px]"></i>
                                Listar Usuários
                            </a>
                        </li>
                    </ul>
                </div>
            @endif

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

            <div class="group">
                <a href="#"
                    class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200
                    {{ Route::is('admin.plano.index') || Route::is('plano.listar') ? 'bg-gray-700/50 text-white' : '' }}">
                    <i class="fa-solid fa-pen-to-square w-5 text-center"></i>
                    <span>Cadastro</span>
                </a>
                <ul class="ml-8 mt-1 space-y-1">
                    <li>
                        <a href="{{ route('admin.plano.index') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Novo Cadastro
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.plano.listar') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Listar
                        </a>
                    </li>
                </ul>
            </div>

            <div class="group">
                <a href="#" class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                    <i class="fa-solid fa-file-lines w-5 text-center"></i>
                    <span>Relatórios</span>
                </a>
                <ul class="ml-8 mt-1 space-y-1">
                    <li>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Relatório Mensal
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Relatório Anual
                        </a>
                    </li>
                </ul>
            </div>

            <div class="group">
                <a href="#" class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                    <i class="fa-solid fa-wpforms w-5 text-center"></i>
                    <span>Formulários</span>
                </a>
                <ul class="ml-8 mt-1 space-y-1">
                    <li>
                        <a href="{{ route('admin.fields.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Criar Campo
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.fields.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Gerenciar Campos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.forms.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Criar Formulário
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.forms.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-400 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            Listar Formulários
                        </a>
                    </li>
                </ul>
            </div>

            <a href="#" class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                <i class="fa-solid fa-gear w-5 text-center"></i>
                <span>Configurações</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                    <i class="fa-solid fa-sign-out-alt w-5 text-center"></i>
                    <span>Sair</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                <i class="fa-solid fa-sign-in-alt w-5 text-center"></i>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}"
                class="flex items-center gap-3 py-3 px-4 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors duration-200">
                <i class="fa-solid fa-user-plus w-5 text-center"></i>
                <span>Registrar</span>
            </a>
        @endauth
    </nav>
</aside>
