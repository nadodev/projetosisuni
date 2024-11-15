<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evolucoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anamnese_id')->constrained('anamneses')->onDelete('cascade');
            $table->foreignId('professional_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_institution')->constrained('instituicoes')->onDelete('cascade');
            $table->datetime('data_evolucao');
            $table->datetime('hora_evolucao');
            $table->text('descricao');
            $table->enum('status', ['em_andamento', 'em_observacao', 'concluido'])->default('em_andamento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evolucoes');
    }
};
