<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name',
        'type',
        'order',
        'form_id'
    ];

    protected static function boot()
    {
        parent::boot();

        // Atribui ordem ao criar novo campo
        static::creating(function ($field) {
            if (!$field->order) {
                $field->order = static::max('order') + 1;
            }
        });
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'form_fields')
            ->withPivot('order')
            ->orderBy('form_fields.order');
    }

    // Scope para ordenar campos
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Método para atualizar ordem
    public static function updateFieldsOrder($orderedFields)
    {
        foreach ($orderedFields as $field) {
            Field::where('id', $field['id'])
                ->update(['order' => $field['order']]);
        }
    }
}
