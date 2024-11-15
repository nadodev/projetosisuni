<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Turma extends Model
{
    protected $fillable = [
        'nome',
        'id_instituicao',
        'professor_id',
        'quantidade_vagas',
        // ... outros campos
    ];

    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function alunos(): HasMany
    {
        return $this->hasMany(User::class, 'id_turma');
    }

    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao');
    }
}
