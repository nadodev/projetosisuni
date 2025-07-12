<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('color')->default('#3490dc');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('id_instituicao')->constrained('instituicoes');
            $table->enum('event_type', ['turma', 'aluno', 'geral']);
            $table->foreignId('turma_id')->nullable()->constrained('turmas');
            $table->foreignId('aluno_id')->nullable()->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
