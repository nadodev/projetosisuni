<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model
{
    protected $table = 'evolucoes';

    protected $fillable = [
        'anamnese_id',
        'professional_id',
        'descricao',
        'status',
        'data_evolucao',
        'hora_evolucao'
    ];

    protected $casts = [
        'data_evolucao' => 'date',
        'hora_evolucao' => 'datetime:H:i'
    ];

    public function anamnese()
    {
        return $this->belongsTo(Anamnese::class);
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }
} 