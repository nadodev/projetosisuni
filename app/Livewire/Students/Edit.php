<?php

namespace App\Livewire\Students;

use App\Models\Student;
use App\Models\Turma;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    public Student $student;

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

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->name = $student->name;
        $this->birth_date = $student->birth_date->format('Y-m-d');
        $this->neurodivergence = $student->neurodivergence;
        $this->notes = $student->notes;
        $this->responsible_id = $student->responsible_id;
        $this->class_id = $student->class_id;
        $this->learning_preferences = $student->learning_preferences;
    }

    public function __invoke()
    {
        return $this->render();
    }

    public function save()
    {
        $this->validate();

        $oldData = $this->student->toArray();

        $this->student->update([
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'neurodivergence' => $this->neurodivergence,
            'notes' => $this->notes,
            'responsible_id' => $this->responsible_id,
            'class_id' => $this->class_id,
            'learning_preferences' => $this->learning_preferences,
        ]);

        $this->student->updates()->create([
            'user_id' => auth()->id(),
            'type' => 'updated',
            'description' => 'Student updated',
            'changes' => [
                'old' => $oldData,
                'new' => $this->student->fresh()->toArray(),
            ],
        ]);

        session()->flash('success', 'Student updated successfully.');

        return redirect()->route('students.index');
    }

    public function render()
    {
        return view('livewire.students.edit', [
            'responsibles' => User::where('institution_id', auth()->user()->institution_id)->get(),
            'classes' => Turma::where('institution_id', auth()->user()->institution_id)->get(),
        ]);
    }
} 