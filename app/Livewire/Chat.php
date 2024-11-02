<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

class Chat extends Component
{
    public $message = '';
    public $messages = [];
    public $userName = 'Usuário Anônimo';
    public $selectedUser = null;
    public $availableUsers = [];

    public function mount()
    {
        $this->refreshMessages();
        $this->availableUsers = [
            [
                'name' => 'João Silva',
                'avatar' => 'https://ui-avatars.com/api/?name=João+Silva&background=random',
                'status' => 'Online'
            ],
            [
                'name' => 'Maria Santos',
                'avatar' => 'https://ui-avatars.com/api/?name=Maria+Santos&background=random',
                'status' => 'Online'
            ],
            [
                'name' => 'Pedro Oliveira',
                'avatar' => 'https://ui-avatars.com/api/?name=Pedro+Oliveira&background=random',
                'status' => 'Ausente'
            ],
            [
                'name' => 'Ana Costa',
                'avatar' => 'https://ui-avatars.com/api/?name=Ana+Costa&background=random',
                'status' => 'Online'
            ],
            [
                'name' => 'Lucas Ferreira',
                'avatar' => 'https://ui-avatars.com/api/?name=Lucas+Ferreira&background=random',
                'status' => 'Online'
            ],
            [
                'name' => 'Julia Martins',
                'avatar' => 'https://ui-avatars.com/api/?name=Julia+Martins&background=random',
                'status' => 'Ocupado'
            ],
            [
                'name' => 'Rafael Souza',
                'avatar' => 'https://ui-avatars.com/api/?name=Rafael+Souza&background=random',
                'status' => 'Online'
            ],
        ];
    }

    public function selectUser($userName)
    {
        $this->selectedUser = $userName;
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|min:1'
        ]);

        Message::create([
            'user_id' => 1, // ID fixo para mensagens anônimas
            'content' => $this->message,
            'sender_name' => $this->userName
        ]);

        $this->dispatch('message-sent');
        $this->message = '';
        $this->refreshMessages();
    }

    #[On('message-sent')]
    public function refreshMessages()
    {
        $this->messages = Message::latest()->take(50)->get()->reverse();
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.chat');
    }
}
