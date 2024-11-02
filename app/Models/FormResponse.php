<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{
    protected $fillable = ['form_id', 'responses'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
