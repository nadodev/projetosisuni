<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Form;
use App\Models\Field;
use App\Models\Anamnese;
use App\Models\Categoria;
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

        // Criar categorias
        $categoriaPsicologo = Categoria::create([
            'nome' => 'Psicólogo',
            'descricao' => 'Profissional de psicologia'
        ]);

        // Criar usuário admin
        $admin = User::create([
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
            'categoria_id' => $categoriaPsicologo->id,
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_admin'
        ]);

        // Criar usuário professor
        $professor = User::create([
            'cpf' => '23456789012',
            'name' => 'Professor',
            'data_nascimento' => '1985-01-01',
            'genero' => 'M',
            'email' => 'professor@example.com',
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

        // Criar usuário estudante
        $student = User::create([
            'cpf' => '34567890123',
            'name' => 'Estudante',
            'data_nascimento' => '2000-01-01',
            'genero' => 'F',
            'email' => 'estudante@example.com',
            'telefone' => '(11) 77777-7777',
            'cep' => '12345678',
            'endereco' => 'Rua Estudante',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => '789',
            'id_turma' => $turma->id,
            'id_instituicao' => $instituicao->id,
            'password' => Hash::make('password'),
            'role' => 'user_student'
        ]);

        // Criar campos para o formulário
        $field1 = Field::create([
            'name' => 'Queixa Principal',
            'type' => 'textarea'
        ]);

        $field2 = Field::create([
            'name' => 'História da Doença Atual',
            'type' => 'textarea'
        ]);

        $field3 = Field::create([
            'name' => 'Antecedentes',
            'type' => 'textarea'
        ]);

        // Criar formulário
        $form = Form::create([
            'name' => 'Anamnese Padrão',
            'user_id' => $admin->id
        ]);

        // Anexar campos ao formulário
        $form->fields()->attach([
            $field1->id => ['order' => 0],
            $field2->id => ['order' => 1],
            $field3->id => ['order' => 2]
        ]);

        // Criar uma anamnese de exemplo
        $anamnese = Anamnese::create([
            'form_id' => $form->id,
            'student_id' => $student->id,
            'professional_id' => $professor->id,
            'status' => 'em_andamento'
        ]);

        // Criar algumas evoluções
        $anamnese->evolucoes()->create([
            'professional_id' => $professor->id,
            'descricao' => 'Primeira consulta realizada',
            'status' => 'em_andamento',
            'data_evolucao' => now(),
            'hora_evolucao' => now()
        ]);
    }
}
