<?php

namespace App\Livewire\Students;

use App\Models\Student;
use App\Models\Turma;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Create extends Component
{
    #[Rule('required|min:3')]
    public string $name = '';

    #[Rule('required|date')]
    public string $birth_date = '';

    #[Rule('nullable|string')]
    public ?string $neurodivergence = null;

    #[Rule('nullable|string')]
    public ?string $notes = null;

    #[Rule('required|exists:users,id')]
    public ?int $responsible_id = null;

    #[Rule('required|exists:turmas,id')]
    public ?int $class_id = null;

    #[Rule('array')]
    public array $learning_preferences = [];

    public function __invoke()
    {
        return $this->render();
    }

    public function mount()
    {
        $this->birth_date = now()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate();

        $student = Student::create([
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'neurodivergence' => $this->neurodivergence,
            'notes' => $this->notes,
            'responsible_id' => $this->responsible_id,
            'class_id' => $this->class_id,
            'learning_preferences' => $this->learning_preferences,
            'institution_id' => auth()->user()->institution_id,
        ]);

        $student->updates()->create([
            'user_id' => auth()->id(),
            'type' => 'created',
            'description' => 'Aluno cadastrado',
        ]);

        session()->flash('success', 'Aluno cadastrado com sucesso!');
        return redirect()->route('students.index');
    }

    public function render()
    {
        return view('livewire.students.create', [
            'responsibles' => User::where('institution_id', auth()->user()->institution_id)
                ->where('role', 'responsible')
                ->get(),
            'classes' => Turma::where('institution_id', auth()->user()->institution_id)->get(),
        ]);
    }
} 