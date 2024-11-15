<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToInstitution;

class Form extends Model
{
    use BelongsToInstitution;

    protected $fillable = [
        'name',
        'user_id'
    ];

    /**
     * Relacionamento com os campos do formulário
     */
    public function fields()
    {
        return $this->belongsToMany(Field::class, 'form_fields')
            ->withPivot('order')
            ->orderBy('form_fields.order');
    }

    /**
     * Relacionamento com as anamneses
     */
    public function anamneses()
    {
        return $this->hasMany(Anamnese::class);
    }

    /**
     * Relacionamento com o usuário que criou o formulário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
