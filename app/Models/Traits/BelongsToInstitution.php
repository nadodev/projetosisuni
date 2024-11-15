<?php

namespace App\Models\Traits;

use App\Models\Scopes\InstitutionScope;

trait BelongsToInstitution
{
    protected static function bootBelongsToInstitution()
    {
        static::addGlobalScope(new InstitutionScope);
    }

    public function instituicao()
    {
        return $this->belongsTo('App\Models\Instituicao', 'instituicao_id');
    }
}
