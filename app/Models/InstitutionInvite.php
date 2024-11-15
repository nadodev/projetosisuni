<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InstitutionInvite extends Model
{
    protected $fillable = [
        'email',
        'token',
        'role',
        'id_institution',
        'status',
        'expires_at'
    ];

    protected $dates = [
        'expires_at'
    ];

    public static function createInvite($email, $role, $institutionId)
    {
        return self::create([
            'email' => $email,
            'token' => Str::random(60),
            'role' => $role,
            'id_institution' => $institutionId,
            'status' => 'pending',
            'expires_at' => Carbon::now()->addDays(7)
        ]);
    }

    public function institution()
    {
        return $this->belongsTo(Instituicao::class, 'id_institution');
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
