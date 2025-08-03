<div>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-100 to-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                <div class="space-y-6 md:space-y-8 text-center md:text-left">
                    <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">
                        Facilitando o cuidado e a inclusão no ambiente educacional
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600">
                        Gerencie documentos, cadastre alunos e promova a inclusão de forma simples e humana.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center md:justify-start">
                        <a href="/contato" class="btn btn-primary">
                            Entre em contato
                        </a>
                        <a href="#sobre" class="btn btn-outline">
                            Saiba mais
                        </a>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/hero.png') }}" 
                         alt="Estudantes diversos estudando juntos" 
                         class="w-full rounded-full shadow-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- Sobre Section -->
    <section id="sobre" class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                    Sobre o SisUni
                </h2>
                <p class="mt-4 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    O SisUni é uma plataforma especializada em gerenciar informações de alunos neurodivergentes,
                    tornando o processo de inclusão mais eficiente e humano.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                @foreach([
                    ['icon' => 'fa-brain', 'color' => 'gray', 'title' => 'Gestão Inteligente', 'description' => 'Sistema especializado no gerenciamento de informações de alunos neurodivergentes.'],
                    ['icon' => 'fa-heart', 'color' => 'blue', 'title' => 'Foco na Inclusão', 'description' => 'Interface acolhedora e adaptável às necessidades específicas de cada usuário.'],
                    ['icon' => 'fa-shield-alt', 'color' => 'green', 'title' => 'Segurança Total', 'description' => 'Proteção e privacidade dos dados garantidas em conformidade com a LGPD.']
                ] as $feature)
                <div class="p-6 bg-{{ $feature['color'] }}-50 rounded-lg text-{{ $feature['color'] }}-500">
                    <i class="fas {{ $feature['icon'] }} text-3xl md:text-4xl text-{{ $feature['color'] }}-500 mb-4"></i>
                    <h3 class="text-lg md:text-xl font-semibold mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Funcionalidades Section -->
    <section id="funcionalidades" class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-900 mb-12 md:mb-16">
                Funcionalidades Principais
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach([
                    ['icon' => 'fa-user-plus', 'title' => 'Cadastro Personalizado', 'description' => 'Cadastre alunos com campos adaptados às necessidades específicas.'],
                    ['icon' => 'fa-file-alt', 'title' => 'Gestão de Documentos', 'description' => 'Organize e acesse documentos importantes com segurança.'],
                    ['icon' => 'fa-chart-line', 'title' => 'Relatórios Inteligentes', 'description' => 'Acompanhe o progresso com relatórios detalhados e alertas.'],
                    ['icon' => 'fa-comments', 'title' => 'Comunicação Eficiente', 'description' => 'Mantenha todos conectados com ferramentas de comunicação integradas.'],
                    ['icon' => 'fa-universal-access', 'title' => 'Acessibilidade Total', 'description' => 'Interface adaptável para diferentes necessidades.'],
                    ['icon' => 'fa-mobile-alt', 'title' => 'Multiplataforma', 'description' => 'Acesse de qualquer dispositivo, a qualquer momento.']
                ] as $feature)
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="relative">
                        <i class="fas {{ $feature['icon'] }} text-2xl md:text-3xl text-primary mb-4"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold mb-2 text-gray-500">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Como Funciona Section -->
    <section id="como-funciona" class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-900 mb-12 md:mb-16">
                Como Funciona
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach([
                    ['icon' => 'fa-user-plus', 'title' => '1. Cadastro', 'description' => 'Crie sua conta e configure sua instituição de ensino.'],
                    ['icon' => 'fa-users', 'title' => '2. Equipe', 'description' => 'Convide professores e coordenadores para sua equipe.'],
                    ['icon' => 'fa-file-alt', 'title' => '3. Documentos', 'description' => 'Cadastre alunos e organize documentos importantes.'],
                    ['icon' => 'fa-chart-line', 'title' => '4. Acompanhamento', 'description' => 'Monitore o progresso e gere relatórios detalhados.']
                ] as $step)
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center mb-4">
                            <i class="fas {{ $step['icon'] }} text-xl md:text-2xl text-white"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-semibold mb-2 text-gray-500">{{ $step['title'] }}</h3>
                        <p class="text-gray-600">{{ $step['description'] }}</p>
                    </div>
                    @if(!$loop->last)
                    <div class="hidden md:block absolute top-1/2 right-0 transform translate-x-1/2 -translate-y-1/2">
                        <i class="fas fa-chevron-right text-2xl text-gray-300"></i>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer with Gradient -->
    <footer class="bg-gray-900 text-white py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">SisUni</h3>
                    <p class="text-gray-400">Tecnologia com propósito</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Links Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Início</a></li>
                        <li><a href="#sobre" class="text-gray-400 hover:text-white transition-colors">Sobre</a></li>
                        <li><a href="#funcionalidades" class="text-gray-400 hover:text-white transition-colors">Funcionalidades</a></li>
                        <li><a href="/contato" class="text-gray-400 hover:text-white transition-colors">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="/privacidade" class="text-gray-400 hover:text-white transition-colors">Política de Privacidade</a></li>
                        <li><a href="/termos-uso" class="text-gray-400 hover:text-white transition-colors">Termos de Uso</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Redes Sociais</h4>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/uniao_sistemas" target="_blank" class="text-gray-400 hover:text-white transition-colors transform hover:scale-110">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/uni%C3%A3o-sistemas/" target="_blank" class="text-gray-400 hover:text-white transition-colors transform hover:scale-110">
                            <i class="fab fa-linkedin text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SisUni. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

   

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Accessibility Styles */
        .high-contrast {
            --tw-bg-opacity: 1;
            background-color: rgb(0 0 0 / var(--tw-bg-opacity));
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
        }

        .high-contrast a {
            --tw-text-opacity: 1;
            color: rgb(147 197 253 / var(--tw-text-opacity));
        }

        .keyboard-navigation :focus {
            outline: 2px solid #4f46e5;
            outline-offset: 2px;
        }

        .reduced-motion * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }

        /* Cookie Checkbox Styles */
        .cookie-checkbox {
            @apply w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500;
        }

        .cookie-checkbox:disabled {
            @apply bg-gray-100 cursor-not-allowed;
        }

        /* Hide elements with x-cloak until Alpine.js is loaded */
        [x-cloak] {
            display: none !important;
        }
    </style>

    @push('scripts')
    <script src="{{ asset('js/cookie-consent.js') }}"></script>
    <script src="{{ asset('js/accessibility.js') }}"></script>
    @endpush
</div>