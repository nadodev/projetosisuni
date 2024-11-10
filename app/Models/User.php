<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'id_instituicao',
        'email_verified_at',
        'cpf',
        'telefone',
        'data_nascimento',
        'genero',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'numero',
        'complemento',
        'photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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

    public function isSuperAdmin()
    {
        return $this->is_super_admin ?? false;
    }

    public function isAdminOfInstitution()
    {
        return $this->role === 'user_admin' && $this->id_instituicao !== null;
    }

    public function scopeFromSameInstituicao($query)
    {
        if (!$this->is_super_admin) {
            return $query->where('id_instituicao', $this->id_instituicao);
        }
        return $query;
    }

    public function canAccessInstituicao($instituicaoId)
    {
        return $this->id_instituicao === $instituicaoId;
    }

    public function hasCompleteAddress(): bool
    {
        return !empty($this->cep) &&
               !empty($this->endereco) &&
               !empty($this->bairro) &&
               !empty($this->cidade) &&
               !empty($this->uf);
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }
        return null;
    }
}
