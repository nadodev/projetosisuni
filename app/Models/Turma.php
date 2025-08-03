<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'serie',
        'turno',
        'professor_id',
        'capacidade',
        'sala',
        'descricao',
        'ano_letivo',
        'institution_id',
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'id_turma');
    }

    public function getCountStudentAtTurma() {
       return $this->students()->count();
    }

    public function getStudentCountAttribute(): int
    {
        return $this->students()->count();
    }

    public function isFullAttribute(): bool
    {
        return $this->student_count >= $this->capacidade;
    }

    protected $casts = [
        'dias_semana' => 'array',
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'horario_inicio' => 'datetime',
        'horario_fim' => 'datetime',
        'valor_mensalidade' => 'decimal:2',
        'valor_material' => 'decimal:2',
        'valor_desconto' => 'decimal:2',
        'valor_total' => 'decimal:2'
    ];
}
