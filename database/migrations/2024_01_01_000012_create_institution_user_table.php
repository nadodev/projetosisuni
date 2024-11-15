<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('institution_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('id_instituicao')->constrained('instituicoes')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'id_instituicao']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('institution_user');
    }
}; 