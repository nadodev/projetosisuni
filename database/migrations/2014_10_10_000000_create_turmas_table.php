<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('quantidade_vagas');
            $table->timestamps();

            $table->unique(['nome']); // Garantindo que o nome seja único
        });
    }

    public function down()
    {
        Schema::dropIfExists('turmas');
    }
};
