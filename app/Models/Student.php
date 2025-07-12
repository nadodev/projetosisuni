<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'neurodivergence',
        'notes',
        'learning_preferences',
        'responsible_id',
        'class_id',
        'institution_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'learning_preferences' => 'array',
    ];

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Turma::class, 'class_id');
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class, 'institution_id');
    }

    public function updates(): HasMany
    {
        return $this->hasMany(StudentUpdate::class);
    }

    public function getAgeAttribute(): int
    {
        return $this->birth_date->age;
    }
} 