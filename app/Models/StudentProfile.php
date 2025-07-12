<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student_profiles';

    protected $fillable = [
        'user_id',
        'institution_id',
        'full_name',
        'social_name',
        'gender',
        'birth_date',
        'cpf',
        'school_code',
        'registration_number',
        'grade_year',
        'class_id',
        'shift',
        'unit',
        'teacher_id',
        'neurodivergence_types',
        'has_official_diagnosis',
        'pedagogical_observations',
        'specific_needs',
        'learning_style',
        'sensitivities',
        'guardian_name',
        'guardian_kinship',
        'guardian_cpf',
        'guardian_email',
        'guardian_phone',
        'secondary_guardian_name',
        'secondary_guardian_kinship',
        'secondary_guardian_cpf',
        'secondary_guardian_email',
        'secondary_guardian_phone',
        'status',
        'guardian_panel_access',
        'photo_path',
        'evaluation_file_path',
        'external_support_name',
        'notes'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'neurodivergence_types' => 'array',
        'specific_needs' => 'array',
        'has_official_diagnosis' => 'boolean',
        'guardian_panel_access' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Turma::class, 'class_id');
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
} 