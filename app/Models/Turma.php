<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'nome',
        'quantidade_vagas'
    ];

    public function alunos()
    {
        return $this->hasMany(User::class, 'id_turma');
    }
}
