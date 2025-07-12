<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Calendar extends Component
{
    public $events = [];
    public $selectedUserId;
    public $users;

    public function mount()
    {
        $user = Auth::user();
        $this->users = User::where('instituicoes_id', $user->instituicoes_id)->get();
        $this->selectedUserId = $user->id;
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $user = Auth::user();
        $query = Event::query();

        if ($this->selectedUserId) {
            $query->where('created_by', $this->selectedUserId);
        }

        $this->events = $query->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_date->format('Y-m-d H:i:s'),
                'end' => $event->end_date->format('Y-m-d H:i:s'),
                'color' => $event->color,
            ];
        })->toArray();

        $this->dispatch('calendar-update', ['events' => $this->events]);
    }

    public function updatedSelectedUserId()
    {
        $this->loadEvents();
    }

    public function render()
    {
        return view('livewire.admin.calendar');
    }
}
