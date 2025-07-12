<?php

namespace Database\Factories;

use App\Models\Instituicao;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $institution = Instituicao::firstOrCreate(
            ['nome' => 'Instituição de Teste'],
            [
                'cidade' => 'São Paulo',
                'uf' => 'SP',
                'plan_id' => null
            ]
        );

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'institution_id' => $institution->id,
            'cpf' => fake()->numerify('###.###.###-##'),
            'data_nascimento' => fake()->date(),
            'genero' => fake()->randomElement(['masculino', 'feminino', 'outro']),
            'telefone' => fake()->phoneNumber(),
            'cep' => fake()->numerify('#####-###'),
            'endereco' => fake()->streetAddress(),
            'bairro' => fake()->word(),
            'cidade' => fake()->city(),
            'uf' => fake()->randomElement(['SP', 'RJ', 'MG', 'ES', 'PR', 'SC', 'RS']),
            'numero' => fake()->buildingNumber(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
