<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{

    protected $table = 'instituicoes';

    protected $fillable = [
        'nome',
        'plan_id',
        'invites_used'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getInviteLimitAttribute()
    {
        return $this->plan ? $this->plan->invite_limit : 0;
    }

    public function getRemainingInvitesAttribute()
    {
        return $this->invite_limit - $this->invites_used;
    }

    public function canSendInvites()
    {
        return $this->remaining_invites > 0;
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_instituicao');
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class, 'id_instituicao');
    }

    public function anamneses()
    {
        return $this->hasManyThrough(
            Anamnese::class,
            User::class,
            'id_instituicao', // Chave estrangeira em users
            'student_id', // Chave estrangeira em anamneses
            'id', // Chave local em instituicoes
            'id' // Chave local em users
        );
    }
}
