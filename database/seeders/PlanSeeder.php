<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run()
    {
        Plan::create([
            'name' => 'Básico',
            'invite_limit' => 5
        ]);

        Plan::create([
            'name' => 'Profissional',
            'invite_limit' => 20
        ]);

        Plan::create([
            'name' => 'Enterprise',
            'invite_limit' => 100
        ]);
    }
}
