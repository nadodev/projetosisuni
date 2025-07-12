<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('institution_id')->constrained('instituicoes')->cascadeOnDelete();
            
            // 1. Identificação do Aluno
            $table->string('full_name');
            $table->string('social_name')->nullable();
            $table->enum('gender', ['masculino', 'feminino', 'outro', 'prefiro_nao_dizer'])->nullable();
            $table->date('birth_date');
            $table->string('cpf')->nullable();
            $table->string('school_code')->nullable(); // código interno da escola
            $table->string('registration_number'); // RA/matrícula
            
            // 2. Dados Escolares
            $table->string('grade_year');
            $table->foreignId('class_id')->constrained('turmas');
            $table->enum('shift', ['manha', 'tarde', 'integral', 'noite']);
            $table->string('unit')->nullable(); // unidade (se for rede)
            $table->foreignId('teacher_id')->constrained('users');
            
            // 3. Perfil Neurodivergente
            $table->json('neurodivergence_types'); // TEA, TDAH, etc
            $table->boolean('has_official_diagnosis')->nullable();
            $table->text('pedagogical_observations')->nullable();
            $table->json('specific_needs')->nullable(); // leitura em voz alta, etc
            $table->enum('learning_style', ['visual', 'auditivo', 'cinestesico', 'misto'])->nullable();
            $table->string('sensitivities')->nullable();
            
            // 4. Responsável Principal
            $table->string('guardian_name');
            $table->enum('guardian_kinship', ['pai', 'mae', 'tutor', 'outro']);
            $table->string('guardian_cpf');
            $table->string('guardian_email');
            $table->string('guardian_phone');
            
            // Responsável Secundário (opcional)
            $table->string('secondary_guardian_name')->nullable();
            $table->enum('secondary_guardian_kinship', ['pai', 'mae', 'tutor', 'outro'])->nullable();
            $table->string('secondary_guardian_cpf')->nullable();
            $table->string('secondary_guardian_email')->nullable();
            $table->string('secondary_guardian_phone')->nullable();
            
            // 5. Sistema
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->boolean('guardian_panel_access')->default(false);
            
            // Extras
            $table->string('photo_path')->nullable();
            $table->string('evaluation_file_path')->nullable();
            $table->string('external_support_name')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
}; 