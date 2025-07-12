<?php

namespace App\Http\Livewire\Students;

use App\Models\EducationalProfile as EducationalProfileModel;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EducationalProfile extends Component
{
    public User $student;
    public $profile;
    
    // Neurodivergência
    public $has_autism = false;
    public $has_adhd = false;
    public $has_dyslexia = false;
    public $other_neurodivergences = [];
    
    // Preferências de Aprendizagem
    public $learning_preferences = [];
    
    // Estímulos a Evitar
    public $stimuli_to_avoid = [];
    
    // Apoios Necessários
    public $needs_reading_support = false;
    public $needs_extra_time = false;
    public $needs_constant_help = false;
    public $other_support_needs = [];
    
    // Observações
    public $general_observations;
    public $teacher_notes;
    public $support_professional_notes;
    
    protected $rules = [
        'has_autism' => 'boolean',
        'has_adhd' => 'boolean',
        'has_dyslexia' => 'boolean',
        'other_neurodivergences' => 'nullable|array',
        'learning_preferences' => 'required|array|min:1',
        'stimuli_to_avoid' => 'nullable|array',
        'needs_reading_support' => 'boolean',
        'needs_extra_time' => 'boolean',
        'needs_constant_help' => 'boolean',
        'other_support_needs' => 'nullable|array',
        'general_observations' => 'nullable|string',
        'teacher_notes' => 'nullable|string',
        'support_professional_notes' => 'nullable|string',
    ];

    public function mount(User $student)
    {
        $this->student = $student;
        $this->profile = $student->educationalProfile;
        
        if ($this->profile) {
            $this->has_autism = $this->profile->has_autism;
            $this->has_adhd = $this->profile->has_adhd;
            $this->has_dyslexia = $this->profile->has_dyslexia;
            $this->other_neurodivergences = $this->profile->other_neurodivergences ?? [];
            $this->learning_preferences = $this->profile->learning_preferences ?? [];
            $this->stimuli_to_avoid = $this->profile->stimuli_to_avoid ?? [];
            $this->needs_reading_support = $this->profile->needs_reading_support;
            $this->needs_extra_time = $this->profile->needs_extra_time;
            $this->needs_constant_help = $this->profile->needs_constant_help;
            $this->other_support_needs = $this->profile->other_support_needs ?? [];
            $this->general_observations = $this->profile->general_observations;
            $this->teacher_notes = $this->profile->teacher_notes;
            $this->support_professional_notes = $this->profile->support_professional_notes;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => $this->student->id,
            'institution_id' => Auth::user()->institution_id,
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
            'last_reviewed_by' => Auth::user()->name,
        ];

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            $this->profile = EducationalProfileModel::create($data);
        }

        $this->emit('saved');
        session()->flash('success', 'Perfil educacional atualizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.students.educational-profile', [
            'learningPreferenceOptions' => [
                'visual' => 'Visual',
                'auditivo' => 'Auditivo',
                'cinestesico' => 'Cinestésico',
                'verbal' => 'Verbal/Linguístico',
                'logico' => 'Lógico/Matemático',
                'social' => 'Social/Interpessoal',
                'solitario' => 'Solitário/Intrapessoal',
            ],
            'stimuliOptions' => [
                'luz_forte' => 'Luz forte',
                'sons_altos' => 'Sons altos',
                'multidao' => 'Multidão',
                'mudancas_rotina' => 'Mudanças de rotina',
                'texturas_especificas' => 'Texturas específicas',
                'cheiros_fortes' => 'Cheiros fortes',
                'movimento_excessivo' => 'Movimento excessivo',
            ],
            'supportOptions' => [
                'leitura_voz_alta' => 'Leitura em voz alta',
                'tempo_extra' => 'Tempo extra',
                'ajuda_constante' => 'Ajuda constante',
                'material_adaptado' => 'Material adaptado',
                'lugar_especifico' => 'Lugar específico na sala',
                'intervalos_frequentes' => 'Intervalos frequentes',
                'tecnologia_assistiva' => 'Tecnologia assistiva',
            ],
        ]);
    }
}
