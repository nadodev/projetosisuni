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
            $table->foreignId('anamnese_id')->constrained()->onDelete('cascade');
            $table->foreignId('professional_id')->constrained('users')->onDelete('cascade');
            $table->text('descricao');
            $table->enum('status', ['em_andamento', 'concluido', 'em_observacao'])->default('em_andamento');
            $table->date('data_evolucao');
            $table->time('hora_evolucao');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evolucoes');
    }
}; 