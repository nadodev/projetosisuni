<?php

namespace App\Observers;

use App\Models\Anamnese;
use Illuminate\Support\Str;

class AnamneseObserver
{
    public function creating(Anamnese $anamnese)
    {
        if (empty($anamnese->uuid)) {
            $anamnese->uuid = Str::uuid();
        }
    }
} 