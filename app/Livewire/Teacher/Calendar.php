<?php

namespace App\Livewire\Teacher;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Calendar extends Component
{
    public $events = [];

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $user = Auth::user();
        $turmas = $user->turmas->pluck('id')->toArray();

        $this->events = Event::where(function($query) use ($user, $turmas) {
            $query->where('created_by', $user->id)
                  ->orWhere(function($q) use ($turmas) {
                      $q->where('event_type', 'turma')
                        ->whereIn('turma_id', $turmas);
                  });
        })->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_date->format('Y-m-d H:i:s'),
                'end' => $event->end_date->format('Y-m-d H:i:s'),
                'color' => $event->color,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.teacher.calendar');
    }
}
