<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class InstitutionScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check() && auth()->user()->current_institution_id) {
            $builder->where(function($query) {
                $query->where('instituicao_id', auth()->user()->current_institution_id)
                      ->orWhereHas('instituicao', function($q) {
                          $q->where('id', auth()->user()->current_institution_id);
                      });
            });
        }
    }
}
