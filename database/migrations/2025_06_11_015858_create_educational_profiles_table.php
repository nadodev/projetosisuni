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
        Schema::create('educational_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('institution_id')->constrained('instituicoes')->onDelete('cascade');
            
            // Neurodivergência
            $table->boolean('has_autism')->default(false)->comment('TEA - Transtorno do Espectro Autista');
            $table->boolean('has_adhd')->default(false)->comment('TDAH - Transtorno do Déficit de Atenção com Hiperatividade');
            $table->boolean('has_dyslexia')->default(false)->comment('Dislexia');
            $table->json('other_neurodivergences')->nullable()->comment('Outras neurodivergências');
            
            // Preferências de Aprendizagem
            $table->json('learning_preferences')->comment('Preferências: auditivo, visual, cinestésico, etc');
            
            // Estímulos a Evitar
            $table->json('stimuli_to_avoid')->nullable()->comment('Estímulos a serem evitados');
            
            // Apoios Necessários
            $table->boolean('needs_reading_support')->default(false)->comment('Necessita de leitura em voz alta');
            $table->boolean('needs_extra_time')->default(false)->comment('Necessita de tempo extra');
            $table->boolean('needs_constant_help')->default(false)->comment('Necessita de ajuda constante');
            $table->json('other_support_needs')->nullable()->comment('Outros apoios necessários');
            
            // Observações
            $table->text('general_observations')->nullable()->comment('Observações gerais');
            $table->text('teacher_notes')->nullable()->comment('Notas específicas para professores');
            $table->text('support_professional_notes')->nullable()->comment('Notas de profissionais de apoio');
            
            // Campos de Controle
            $table->timestamp('last_review_date')->nullable();
            $table->string('last_reviewed_by')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index(['user_id', 'institution_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_profiles');
    }
};
