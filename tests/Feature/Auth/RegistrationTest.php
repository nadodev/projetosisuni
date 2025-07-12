<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $institution = $this->getDefaultInstitution();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'institution_id' => $institution->id,
            'cpf' => '123.456.789-00',
            'data_nascimento' => '1990-01-01',
            'genero' => 'masculino',
            'telefone' => '(11) 99999-9999',
            'cep' => '12345-678',
            'endereco' => 'Rua Teste',
            'bairro' => 'Bairro Teste',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '123'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
