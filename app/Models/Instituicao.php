<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'plan_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_instituicao');
    }

    public function currentUsers()
    {
        return $this->hasMany(User::class, 'current_institution_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function invites()
    {
        return $this->hasMany(InstitutionInvite::class, 'id_institution');
    }

    public function canSendInvite()
    {
        // Se não tem plano, não pode enviar convites
        if (!$this->plan) {
            return false;
        }

        // Verifica o limite de convites do plano
        $usedInvites = $this->invites()->count();
        $inviteLimit = $this->plan->invite_limit ?? 0;

        // Retorna true se ainda não atingiu o limite de convites
        return $usedInvites < $inviteLimit;
    }

    public function getRemainingInvites()
    {
        if (!$this->plan) {
            return 0;
        }

        $usedInvites = $this->invites()->count();
        $inviteLimit = $this->plan->invite_limit ?? 0;

        return max(0, $inviteLimit - $usedInvites);
    }
}
