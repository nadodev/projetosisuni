<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = ['form_id', 'field_id', 'order'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
