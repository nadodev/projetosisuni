<?php

namespace App\Livewire\Students;

use App\Models\EducationalProfile as ModelsEducationalProfile;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EducationalProfile extends ModalComponent
{
    public User $student;
    public $profile;
    
    // Neurodivergence fields
    public $has_autism = false;
    public $has_adhd = false;
    public $has_dyslexia = false;
    public $other_neurodivergences = [];
    
    // Learning preferences
    public $learning_preferences = [];
    
    // Stimuli to avoid
    public $stimuli_to_avoid = [];
    
    // Support needs
    public $needs_reading_support = false;
    public $needs_extra_time = false;
    public $needs_constant_help = false;
    public $other_support_needs = [];
    
    // Notes
    public $general_observations;
    public $teacher_notes;
    public $support_professional_notes;

    public function mount($student)
    {
        try {
            if (is_array($student)) {
                $student = $student['student'];
            }

            $this->student = User::where('role', 'user_student')
                ->findOrFail($student);

            $this->profile = $this->student->educationalProfile;

            if ($this->profile) {
                $this->has_autism = $this->profile->has_autism ?? false;
                $this->has_adhd = $this->profile->has_adhd ?? false;
                $this->has_dyslexia = $this->profile->has_dyslexia ?? false;
                $this->other_neurodivergences = $this->profile->other_neurodivergences ?? [];
                $this->learning_preferences = $this->profile->learning_preferences ?? [];
                $this->stimuli_to_avoid = $this->profile->stimuli_to_avoid ?? [];
                $this->needs_reading_support = $this->profile->needs_reading_support ?? false;
                $this->needs_extra_time = $this->profile->needs_extra_time ?? false;
                $this->needs_constant_help = $this->profile->needs_constant_help ?? false;
                $this->other_support_needs = $this->profile->other_support_needs ?? [];
                $this->general_observations = $this->profile->general_observations;
                $this->teacher_notes = $this->profile->teacher_notes;
                $this->support_professional_notes = $this->profile->support_professional_notes;
            }
        } catch (\Exception $e) {
            $this->closeModal();
            session()->flash('error', 'Erro ao carregar o perfil educacional. Por favor, tente novamente.');
        }
    }

    public function save()
    {
        $data = [
            'user_id' => $this->student->id,
            'institution_id' => $this->student->institution_id,
            'has_autism' => $this->has_autism,
            'has_adhd' => $this->has_adhd,
            'has_dyslexia' => $this->has_dyslexia,
            'other_neurodivergences' => $this->other_neurodivergences,
            'learning_preferences' => $this->learning_preferences,
            'stimuli_to_avoid' => $this->stimuli_to_avoid,
            'needs_reading_support' => $this->needs_reading_support,
            'needs_extra_time' => $this->needs_extra_time,
            'needs_constant_help' => $this->needs_constant_help,
            'other_support_needs' => $this->other_support_needs,
            'general_observations' => $this->general_observations,
            'teacher_notes' => $this->teacher_notes,
            'support_professional_notes' => $this->support_professional_notes,
            'last_review_date' => now(),
            'last_reviewed_by' => auth()->id(),
        ];

        try {
            if ($this->profile) {
                $this->profile->update($data);
            } else {
                ModelsEducationalProfile::create($data);
            }

            $this->closeModalWithEvents([
                'profileUpdated' => ['student' => $this->student->id]
            ]);

            session()->flash('success', 'Perfil educacional atualizado com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao atualizar o perfil educacional. Por favor, tente novamente.');
        }
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.students.educational-profile');
    }
} 