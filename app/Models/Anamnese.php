<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anamnese extends Model
{
    protected $fillable = [
        'form_id',
        'student_id',
        'professional_id',
        'respostas',
        'status'
    ];

    protected $casts = [
        'respostas' => 'array'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function evolucoes()
    {
        return $this->hasMany(Evolucao::class)->orderBy('data_evolucao', 'desc')->orderBy('hora_evolucao', 'desc');
    }

    public function ultimaEvolucao()
    {
        return $this->hasOne(Evolucao::class)->latest();
    }
}
