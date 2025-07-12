<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Primeiro, dropar a tabela student_updates que tem a foreign key
        Schema::dropIfExists('student_updates');

        // Agora podemos dropar e recriar a tabela students
        Schema::dropIfExists('students');

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date');
            $table->string('neurodivergence')->nullable();
            $table->text('notes')->nullable();
            $table->json('learning_preferences')->nullable();
            $table->foreignId('responsible_id')->constrained('users');
            $table->foreignId('class_id')->constrained('turmas');
            $table->foreignId('institution_id')->constrained('instituicoes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
}; 