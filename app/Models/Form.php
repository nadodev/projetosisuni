<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['name'];

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'form_fields')->withPivot('order');
    }
}
