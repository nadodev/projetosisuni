<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table = 'instituicoes';

    protected $fillable = [
        'nome'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_instituicao');
    }
}
