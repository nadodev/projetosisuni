<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'color',
        'created_by',
        'instituicoes_id',
        'event_type',
        'turma_id',
        'aluno_id',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class, 'instituicoes_id');
    }

    public function turma(): BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function scopeForUser($query, User $user)
    {
        if ($user->isStudent()) {
            return $query->where(function ($q) use ($user) {
                $q->where('event_type', 'geral')
                  ->orWhere(function ($q) use ($user) {
                      $q->where('event_type', 'turma')
                        ->where('turma_id', $user->id_turma);
                  })
                  ->orWhere(function ($q) use ($user) {
                      $q->where('event_type', 'aluno')
                        ->where('aluno_id', $user->id);
                  });
            });
        }

        return $query->where('instituicoes_id', $user->institution->id);
    }

    public function scopeFromInstitution($query, $user)
    {
        return $query->where('instituicoes_id', $user->institution->id);
    }
}
