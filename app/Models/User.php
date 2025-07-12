<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'institution_id',
        'id_turma',
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'data_nascimento' => 'date'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma', 'id');
    }

    public function turmas(): HasMany
    {
        return $this->hasMany(Turma::class, 'professor_id');
    }

    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'institution_id');
    }

    public function educationalProfile()
    {
        return $this->hasOne(EducationalProfile::class);
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
        return $this->role === 'user_admin' && $this->institution_id !== null;
    }

    public function scopeFromSameInstituicao($query)
    {
        if (!$this->is_super_admin) {
            return $query->where('institution_id', $this->institution_id);
        }
        return $query;
    }

    public function canAccessInstituicao($instituicaoId)
    {
        return $this->institution_id === $instituicaoId;
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

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }
}
