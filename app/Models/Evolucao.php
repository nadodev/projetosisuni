<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'data_evolucao' => 'datetime',
        'hora_evolucao' => 'datetime'
    ];

    public function setHoraEvolucaoAttribute($value)
    {
        $this->attributes['hora_evolucao'] = $value instanceof Carbon 
            ? $value->format('H:i:s')
            : date('H:i:s', strtotime($value));
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
