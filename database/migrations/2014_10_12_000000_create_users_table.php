<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cpf')->unique();
            $table->date('data_nascimento');
            $table->string('genero');
            $table->string('telefone')->nullable();
            $table->string('cep');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf', 2);
            $table->integer('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->foreignId('id_turma')->nullable()->constrained('turmas');
            $table->foreignId('id_instituicao')->constrained('instituicoes');
            $table->foreignId('current_institution_id')
            ->nullable()
            ->constrained('instituicoes')
            ->nullOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
