<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institution_id',
        'has_autism',
        'has_adhd',
        'has_dyslexia',
        'other_neurodivergences',
        'learning_preferences',
        'stimuli_to_avoid',
        'needs_reading_support',
        'needs_extra_time',
        'needs_constant_help',
        'other_support_needs',
        'general_observations',
        'teacher_notes',
        'support_professional_notes',
        'last_review_date',
        'last_reviewed_by'
    ];

    protected $casts = [
        'has_autism' => 'boolean',
        'has_adhd' => 'boolean',
        'has_dyslexia' => 'boolean',
        'other_neurodivergences' => 'array',
        'learning_preferences' => 'array',
        'stimuli_to_avoid' => 'array',
        'needs_reading_support' => 'boolean',
        'needs_extra_time' => 'boolean',
        'needs_constant_help' => 'boolean',
        'other_support_needs' => 'array',
        'last_review_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

    // Helper methods
    public function hasAnyNeurodivergence(): bool
    {
        return $this->has_autism || 
               $this->has_adhd || 
               $this->has_dyslexia || 
               !empty($this->other_neurodivergences);
    }

    public function needsAnySupport(): bool
    {
        return $this->needs_reading_support || 
               $this->needs_extra_time || 
               $this->needs_constant_help || 
               !empty($this->other_support_needs);
    }

    public function getLearningPreferencesListAttribute(): string
    {
        return implode(', ', $this->learning_preferences ?? []);
    }

    public function getStimuliToAvoidListAttribute(): string
    {
        return implode(', ', $this->stimuli_to_avoid ?? []);
    }
}
