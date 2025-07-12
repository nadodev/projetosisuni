<x-slot name="modal.maxWidth">7xl</x-slot>
<div class="p-6 w-full max-w-7xl mx-auto" x-data x-init="setTimeout(() => { 
    const modalContent = document.querySelector('#modal-container .overflow-y-auto');
    if (modalContent) {
        modalContent.scrollTop = 0;
    }
}, 50)">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Termos de Uso</h1>
        <p class="text-gray-600">Última atualização: {{ date('d/m/Y') }}</p>
    </div>

    <div class="prose prose-lg max-w-none max-h-96 overflow-y-auto">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">1. Aceitação dos Termos</h2>
            <p class="text-gray-700 mb-4">
                Ao acessar e usar o SisUni, você concorda em cumprir e estar vinculado a estes Termos de Uso. 
                Se você não concordar com qualquer parte destes termos, não deve usar nosso serviço.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">2. Descrição do Serviço</h2>
            <p class="text-gray-700 mb-4">
                O SisUni é uma plataforma especializada em gerenciar informações de alunos neurodivergentes, 
                fornecendo ferramentas para:
            </p>
            <ul class="list-disc pl-6 text-gray-700 mb-4">
                <li>Cadastro e gestão de alunos</li>
                <li>Organização de documentos educacionais</li>
                <li>Geração de relatórios e acompanhamento</li>
                <li>Comunicação entre educadores e responsáveis</li>
                <li>Ferramentas de acessibilidade</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">3. Uso Aceitável</h2>
            <p class="text-gray-700 mb-4">Você concorda em usar o SisUni apenas para propósitos legais e de acordo com estes termos:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-4">
                <li>Não usar o serviço para atividades ilegais ou fraudulentas</li>
                <li>Não tentar acessar contas de outros usuários</li>
                <li>Não interferir na segurança ou funcionamento do sistema</li>
                <li>Não compartilhar informações pessoais de terceiros sem autorização</li>
                <li>Respeitar a privacidade e direitos de outros usuários</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">4. Conta de Usuário</h2>
            <p class="text-gray-700 mb-4">
                Para usar certos recursos do SisUni, você deve criar uma conta. Você é responsável por:
            </p>
            <ul class="list-disc pl-6 text-gray-700 mb-4">
                <li>Manter a confidencialidade de suas credenciais de login</li>
                <li>Notificar imediatamente sobre uso não autorizado</li>
                <li>Fornecer informações precisas e atualizadas</li>
                <li>Ser responsável por todas as atividades em sua conta</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">5. Privacidade e Proteção de Dados</h2>
            <p class="text-gray-700 mb-4">
                O SisUni está comprometido com a proteção da privacidade e dos dados pessoais. 
                Nossa coleta e uso de informações estão descritos em nossa Política de Privacidade.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">6. Propriedade Intelectual</h2>
            <p class="text-gray-700 mb-4">
                O SisUni e todo seu conteúdo, incluindo mas não limitado a textos, gráficos, 
                logotipos, ícones e software, são propriedade da União Sistemas e estão protegidos 
                por leis de direitos autorais e propriedade intelectual.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">7. Limitação de Responsabilidade</h2>
            <p class="text-gray-700 mb-4">
                O SisUni é fornecido "como está" e "conforme disponível". Não garantimos que o serviço 
                será ininterrupto, livre de erros ou seguro. Em nenhuma circunstância seremos responsáveis 
                por danos indiretos, incidentais ou consequenciais.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">8. Modificações dos Termos</h2>
            <p class="text-gray-700 mb-4">
                Reservamo-nos o direito de modificar estes termos a qualquer momento. 
                As modificações entrarão em vigor imediatamente após sua publicação. 
                O uso continuado do serviço após as modificações constitui aceitação dos novos termos.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">9. Rescisão</h2>
            <p class="text-gray-700 mb-4">
                Podemos suspender ou encerrar sua conta a qualquer momento, com ou sem aviso prévio, 
                por violação destes termos ou por qualquer outro motivo a nosso critério.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">10. Lei Aplicável</h2>
            <p class="text-gray-700 mb-4">
                Estes termos são regidos pelas leis do Brasil. Qualquer disputa será resolvida 
                nos tribunais competentes da jurisdição brasileira.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">11. Contato</h2>
            <p class="text-gray-700 mb-4">
                Se você tiver dúvidas sobre estes Termos de Uso, entre em contato conosco:
            </p>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-700"><strong>União Sistemas</strong></p>
                <p class="text-gray-700">Email: contato@uniaosistemas.com.br</p>
                <p class="text-gray-700">Instagram: <a href="https://www.instagram.com/uniao_sistemas" target="_blank" class="text-purple-600 hover:text-purple-700">@uniao_sistemas</a></p>
                <p class="text-gray-700">LinkedIn: <a href="https://www.linkedin.com/in/uni%C3%A3o-sistemas/" target="_blank" class="text-purple-600 hover:text-purple-700">União Sistemas</a></p>
            </div>
        </section>
    </div>
</div> 