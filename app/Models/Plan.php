<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'invite_limit',
        'features'
    ];

    protected $casts = [
        'features' => 'array'
    ];

    public function instituicoes()
    {
        return $this->hasMany(Instituicao::class);
    }
}
