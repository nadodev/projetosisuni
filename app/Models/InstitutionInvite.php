<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstitutionInvite extends Model
{
    protected $fillable = [
        'email',
        'token',
        'status',
        'role',
        'instituicoes_id',
        'user_id',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class, 'instituicoes_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
