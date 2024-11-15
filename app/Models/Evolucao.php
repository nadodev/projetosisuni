<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model
{
    protected $table = 'evolucoes';

    protected $fillable = [
        'anamnese_id',
        'professional_id',
        'id_institution',
        'data_evolucao',
        'hora_evolucao',
        'descricao',
        'status'
    ];

    protected $casts = [
        'data_evolucao' => 'datetime',
        'hora_evolucao' => 'datetime'
    ];

    public function anamnese()
    {
        return $this->belongsTo(Anamnese::class);
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function institution()
    {
        return $this->belongsTo(Instituicao::class, 'id_institution');
    }
}
