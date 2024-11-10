<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'cpf',
        'name',
        'data_nascimento',
        'genero',
        'email',
        'telefone',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'numero',
        'complemento',
        'id_turma',
        'categoria_id',
        'id_instituicao',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao');
    }

    public function isAdmin()
    {
        return $this->role === 'user_admin';
    }

    public function isTeacher()
    {
        return $this->role === 'user_teacher';
    }

    public function isStudent()
    {
        return $this->role === 'user_student';
    }
}
