<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;

class Show extends Component
{
    public Student $student;

    public function mount(Student $student)
    {
        $this->student = $student;
    }

    public function __invoke()
    {
        return $this->render();
    }

    public function render()
    {
        return view('livewire.students.show', [
            'student' => $this->student->load(['class', 'responsible', 'updates']),
        ]);
    }
} 