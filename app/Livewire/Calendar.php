<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use Livewire\Attributes\Layout;

class Calendar extends Component
{
    public $events = [];
    public $title = '';
    public $start = '';
    public $end = '';
    public $selectedEventId = null;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = Event::all()->map(function($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end
            ];
        })->toArray();
    }

    public function createEvent()
    {
        $this->validate([
            'title' => 'required|min:3',
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ]);

        Event::create([
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end
        ]);

        $this->reset(['title', 'start', 'end']);
        $this->loadEvents();
        $this->dispatch('refresh-calendar');
    }

    public function confirmDelete($eventId)
    {
        $this->selectedEventId = $eventId;
        $this->showDeleteModal = true;
    }

    public function deleteEvent()
    {
        if ($this->selectedEventId) {
            Event::destroy($this->selectedEventId);
            $this->selectedEventId = null;
            $this->showDeleteModal = false;
            $this->loadEvents();
            $this->dispatch('refresh-calendar');
        }
    }

    public function cancelDelete()
    {
        $this->selectedEventId = null;
        $this->showDeleteModal = false;
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.calendar');
    }
}
