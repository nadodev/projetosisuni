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

    public function setHoraEvolucaoAttribute($value)
    {
        $this->attributes['hora_evolucao'] = date('H:i:s', strtotime($value));
    }

    public function getHoraEvolucaoAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    public function anamnese()
    {
        return $this->belongsTo(Anamnese::class);
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }
}
