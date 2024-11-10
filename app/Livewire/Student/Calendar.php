<?php

namespace App\Livewire\Student;

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

        $this->events = Event::where(function($query) use ($user) {
            $query->where('event_type', 'geral')
                  ->orWhere(function($q) use ($user) {
                      $q->where('event_type', 'turma')
                        ->where('turma_id', $user->id_turma);
                  })
                  ->orWhere(function($q) use ($user) {
                      $q->where('event_type', 'aluno')
                        ->where('aluno_id', $user->id);
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
        return view('livewire.student.calendar');
    }
}
