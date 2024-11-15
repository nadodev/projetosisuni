<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->foreignId('field_id')->constrained('fields')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();

            // Adiciona índice único para evitar duplicatas
            $table->unique(['form_id', 'field_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_fields');
    }
};
