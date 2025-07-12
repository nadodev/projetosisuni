<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Turma;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Calendar extends Component
{
    public $events = [];
    public $showEventModal = false;
    public $title;
    public $description;
    public $startDate;
    public $endDate;
    public $color = '#3490dc';
    public $eventType = 'geral';
    public $turmaId;
    public $alunoId;
    public $selectedUserId;
    public $users;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
        'color' => 'required|string|max:7',
        'eventType' => 'required|in:geral,turma,aluno',
        'turmaId' => 'required_if:eventType,turma',
        'alunoId' => 'required_if:eventType,aluno',
    ];

    public function mount()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $this->users = User::all();
            $this->selectedUserId = $user->id;
        }

        $this->loadEvents();
    }

    public function loadEvents()
    {
        $user = Auth::user();
        $query = Event::query();

        if ($user->isSuperAdmin() && $this->selectedUserId) {
            $query->where('created_by', $this->selectedUserId);
        } else {
            $query->where('created_by', $user->id);
        }

        $events = $query->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_date->format('Y-m-d H:i:s'),
                'end' => $event->end_date->format('Y-m-d H:i:s'),
                'color' => $event->color,
            ];
        })->toArray();

        $this->events = $events;
    }

    public function filterEvents()
    {
        $this->loadEvents();
        $this->dispatch('updateCalendar', events: $this->events);
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
