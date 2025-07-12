<?php

namespace Tests;

use App\Models\Instituicao;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getDefaultInstitution()
    {
        return Instituicao::firstOrCreate(
            ['nome' => 'Instituição de Teste'],
            [
                'cidade' => 'São Paulo',
                'uf' => 'SP',
                'plan_id' => null
            ]
        );
    }
}
