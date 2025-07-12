<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name',
        'type',
        'order'
    ];

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'form_fields')
            ->withPivot('order')
            ->orderBy('form_fields.order');
    }
}
