<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instituicao;
use App\Models\Turma;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar uma instituição padrão
        $instituicao = Instituicao::create([
            'nome' => 'Instituição Padrão'
        ]);

        // Criar uma turma padrão
        $turma = Turma::create([
            'nome' => 'Turma A',
            'quantidade_vagas' => 30
        ]);

        // Criar usuário admin
        User::create([
            'cpf' => '12345678901',
            'name' => 'Administrador',
            'data_nascimento' => '1990-01-01',
            'genero' => 'M',
            'email' => 'admin@example.com',
            'telefone' => '(11) 99999-9999',
            'cep' => '12345678',
            'endereco' => 'Rua Admin',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo 2',
            'uf' => 'SP',
            'numero' => '123',
            'categoria' => 'admin',
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_admin'
        ]);

        // Criar usuário professor
        User::create([
            'cpf' => '23456789012',
            'name' => 'Professor',
            'data_nascimento' => '1985-01-01',
            'genero' => 'M',
            'email' => 'professor@example.com',
            'telefone' => '(11) 88888-8888',
            'cep' => '12345678',
            'endereco' => 'Rua Professor',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo 1',
            'uf' => 'SP',
            'numero' => '456',
            'categoria' => 'professor',
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_teacher'
        ]);

        // Criar usuário estudante
        User::create([
            'cpf' => '34567890123',
            'name' => 'Estudante',
            'data_nascimento' => '2000-01-01',
            'genero' => 'F',
            'email' => 'estudante@example.com',
            'telefone' => '(11) 77777-7777',
            'cep' => '12345678',
            'endereco' => 'Rua Estudante',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo 3',
            'uf' => 'SP',
            'numero' => '789',
            'categoria' => 'aluno',
            'id_turma' => $turma->id,
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_student'
        ]);
    }
}
