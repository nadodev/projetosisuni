<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Turma;
use App\Models\Categoria;
use App\Models\Instituicao;
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

        // Criar categorias padrão
        $categoriaPsicologo = Categoria::create([
            'nome' => 'Psicólogo',
            'descricao' => 'Profissional de psicologia'
        ]);

        $categoriaMedico = Categoria::create([
            'nome' => 'Médico',
            'descricao' => 'Profissional de medicina'
        ]);

        $categoriaFisioterapeuta = Categoria::create([
            'nome' => 'Fisioterapeuta',
            'descricao' => 'Profissional de fisioterapia'
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
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '123',
            'categoria_id' => null, // Admin não precisa de categoria
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_admin'
        ]);

        // Criar usuário professor (psicólogo)
        User::create([
            'cpf' => '23456789012',
            'name' => 'Professor Psicólogo',
            'data_nascimento' => '1985-01-01',
            'genero' => 'M',
            'email' => 'professor.psicologo@example.com',
            'telefone' => '(11) 88888-8888',
            'cep' => '12345678',
            'endereco' => 'Rua Professor',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '456',
            'categoria_id' => $categoriaPsicologo->id,
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_teacher'
        ]);

        // Criar usuário professor (médico)
        User::create([
            'cpf' => '34567890123',
            'name' => 'Professor Médico',
            'data_nascimento' => '1982-01-01',
            'genero' => 'F',
            'email' => 'professor.medico@example.com',
            'telefone' => '(11) 77777-7777',
            'cep' => '12345678',
            'endereco' => 'Rua Professor',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '789',
            'categoria_id' => $categoriaMedico->id,
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_teacher'
        ]);

        // Criar usuário estudante
        User::create([
            'cpf' => '45678901234',
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
            'categoria_id' => null, // Estudante não tem categoria
            'id_turma' => $turma->id,
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_student'
        ]);
    }
}
