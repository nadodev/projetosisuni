<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instituicao extends Model
{
    protected $table = 'instituicoes';

    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'telefone',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'numero',
        'complemento',
        'plan_id',
        'available_invites'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'institution_id');
    }

    public function turmas(): HasMany
    {
        return $this->hasMany(Turma::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function invites(): HasMany
    {
        return $this->hasMany(InstitutionInvite::class, 'instituicoes_id');
    }

    // Método para calcular convites restantes
    public function getRemainingInvitesAttribute(): int
    {
        $totalInvites = $this->plan->invite_limit ?? 0;
        $usedInvites = $this->invites()
            ->whereIn('status', ['pending', 'accepted'])
            ->count();

        return max(0, $totalInvites - $usedInvites);
    }

    // Método para verificar se ainda tem convites disponíveis
    public function hasAvailableInvites(): bool
    {
        return $this->remaining_invites > 0;
    }

    // Método para verificar se pode enviar convite
    public function canSendInvite(): bool
    {
        if (!$this->plan) {
            return false;
        }

        return $this->remaining_invites > 0;
    }
}
