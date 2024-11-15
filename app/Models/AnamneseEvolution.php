<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AnamneseEvolution extends Model
{
    protected $fillable = [
        'date',
        'description',
        'anamnese_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function anamnese()
    {
        return $this->belongsTo(Anamnese::class);
    }
}
