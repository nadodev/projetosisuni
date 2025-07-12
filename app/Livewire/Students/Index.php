<?php

namespace App\Livewire\Students;

use App\Models\Student;
use App\Models\Turma;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public ?string $search = null;

    #[Url]
    public ?string $class = null;

    #[Url]
    public ?string $neurodivergence = null;

    public function __invoke()
    {
        return $this->render();
    }

    public function render()
    {
        $query = Student::query()
            ->with(['class', 'responsible'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->when($this->class, function ($query) {
                $query->where('class_id', $this->class);
            })
            ->when($this->neurodivergence, function ($query) {
                $query->where('neurodivergence', $this->neurodivergence);
            });

        return view('livewire.students.index', [
            'students' => $query->paginate(10),
            'classes' => Turma::all(),
            'neurodivergences' => Student::distinct()->pluck('neurodivergence')->filter(),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingClass()
    {
        $this->resetPage();
    }

    public function updatingNeurodivergence()
    {
        $this->resetPage();
    }
} 