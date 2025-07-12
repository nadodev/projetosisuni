<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instituicao;
use App\Models\Plan;
use App\Models\Turma;
use App\Models\Categoria;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Criar um plano
        $plan = Plan::first() ?? Plan::create([
            'name' => 'Básico',
            'invite_limit' => 5
        ]);

        // Criar uma instituição
        $instituicao = Instituicao::create([
            'nome' => 'Instituição Exemplo',
            'plan_id' => $plan->id
        ]);



        // Criar uma turma
        $turma = Turma::create([
            'nome' => 'Turma A',
            'quantidade_vagas' => 30,
            'institution_id' => $instituicao->id
        ]);

        // Criar categoria profissional
        $categoria = Categoria::create([
            'nome' => 'Psicólogo',
            'descricao' => 'Profissional de psicologia'
        ]);

        // Criar Super Admin
        User::create([
            'cpf' => '11111111111',
            'name' => 'Super Admin',
            'data_nascimento' => '1990-01-01',
            'genero' => 'M',
            'email' => 'superadmin@example.com',
            'telefone' => '(11) 99999-9999',
            'cep' => '12345678',
            'endereco' => 'Rua Admin',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '123',
            'categoria_id' => null,
            'institution_id' =>  $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_admin',
            'is_super_admin' => true
        ]);

        // Criar Admin da Instituição
        User::create([
            'cpf' => '22222222222',
            'name' => 'Admin Instituição',
            'data_nascimento' => '1990-01-01',
            'genero' => 'F',
            'email' => 'admin@example.com',
            'telefone' => '(11) 88888-8888',
            'cep' => '12345678',
            'endereco' => 'Rua Admin',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '456',
            'categoria_id' => $categoria->id,
            'institution_id' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_admin'
        ]);

        // Criar Professor
        User::create([
            'cpf' => '33333333333',
            'name' => 'Professor',
            'data_nascimento' => '1985-01-01',
            'genero' => 'M',
            'email' => 'professor@example.com',
            'telefone' => '(11) 77777-7777',
            'cep' => '12345678',
            'endereco' => 'Rua Professor',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '789',
            'categoria_id' => $categoria->id,
            'institution_id' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_teacher'
        ]);

        // Criar Estudante
        User::create([
            'cpf' => '44444444444',
            'name' => 'Estudante',
            'data_nascimento' => '2000-01-01',
            'genero' => 'F',
            'email' => 'estudante@example.com',
            'telefone' => '(11) 66666-6666',
            'cep' => '12345678',
            'endereco' => 'Rua Estudante',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '321',
            'categoria_id' => null,
            'id_turma' => $turma->id,
            'institution_id' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_student'
        ]);
    }
}
