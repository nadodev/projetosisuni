<div class="flex h-[calc(100vh-5rem)] max-w-[95vw] mx-auto">
    {{-- Lista de Usuários --}}
    <div class="flex flex-col bg-white border-r ">
        <div class="p-4 border-b bg-gray-50">
            <h3 class="font-semibold text-gray-700">Usuários Online</h3>
        </div>
        <div class="flex-1 p-2 space-y-1 overflow-y-auto w-80">
            @foreach($availableUsers as $user)
                <button
                    wire:click="selectUser('{{ $user['name'] }}')"
                    class="w-full flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 transition-colors {{ $selectedUser === $user['name'] ? 'bg-blue-50' : '' }}"
                >
                    <div class="relative">
                        <img src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}" class="w-10 h-10 rounded-full">
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                    </div>
                    <div class="flex-1 text-left">
                        <div class="font-medium text-gray-900">{{ $user['name'] }}</div>
                        <div class="text-xs text-gray-500">{{ $user['status'] }}</div>
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    {{-- Área do Chat --}}
    <div class="flex flex-col flex-1 w-full min-w-0 bg-white">
        {{-- Header do Chat --}}
        <div class="flex items-center gap-4 p-4 bg-white border-b shadow-sm">
            @if($selectedUser)
                <img src="{{ collect($availableUsers)->firstWhere('name', $selectedUser)['avatar'] }}"
                     alt="{{ $selectedUser }}"
                     class="w-10 h-10 rounded-full">
                <div>
                    <h2 class="font-semibold text-gray-800">{{ $selectedUser }}</h2>
                    <div class="text-xs text-green-500">Online</div>
                </div>
            @else
                <h2 class="font-semibold text-gray-800">Chat Geral</h2>
            @endif
        </div>

        {{-- Área de Mensagens --}}
        <div class="flex-1 p-4 space-y-4 overflow-y-auto bg-gray-50" id="chat-messages">
            @foreach($messages as $message)
                <div class="flex gap-3 {{ $message->sender_name === $userName ? 'justify-end' : 'justify-start' }}">
                    @if($message->sender_name !== $userName)
                        <img src="{{ collect($availableUsers)->firstWhere('name', $message->sender_name)['avatar'] ?? 'https://ui-avatars.com/api/?name='.$message->sender_name }}"
                             alt="{{ $message->sender_name }}"
                             class="self-end w-8 h-8 rounded-full">
                    @endif
                    <div class="{{ $message->sender_name === $userName ? 'bg-blue-500 text-white' : 'bg-white' }} rounded-lg p-3 max-w-[70%] shadow-sm">
                        @if($message->sender_name !== $userName)
                            <div class="mb-1 text-xs font-semibold text-gray-600">
                                {{ $message->sender_name }}
                            </div>
                        @endif
                        <div class="text-sm">
                            {{ $message->content }}
                        </div>
                        <div class="text-xs mt-1 {{ $message->sender_name === $userName ? 'text-blue-100' : 'text-gray-400' }}">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                    @if($message->sender_name === $userName)
                        <img src="{{ collect($availableUsers)->firstWhere('name', $userName)['avatar'] ?? 'https://ui-avatars.com/api/?name='.$userName }}"
                             alt="{{ $userName }}"
                             class="self-end w-8 h-8 rounded-full">
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Área de Input --}}
        <div class="p-4 bg-white border-t">
            <div class="mb-3">
                <input
                    type="text"
                    wire:model.live="userName"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Seu nome"
                >
            </div>
            <form wire:submit.prevent="sendMessage" class="flex gap-2 mt-4">
                <input
                    type="text"
                    wire:model="message"
                    class="flex-1 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Digite sua mensagem..."
                >
                <button type="submit" class="flex items-center gap-2 p-2 px-6 py-2 text-white transition-colors duration-200 bg-blue-500 rounded-lg hover:bg-blue-600">
                    <span>Enviar</span>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@script
<script>
    $wire.on('message-sent', () => {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });

    document.addEventListener('DOMContentLoaded', () => {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });
</script>
@endscript
