<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old columns
        Schema::table('turmas', function (Blueprint $table) {
            $columns = [
                'quantidade_vagas',
                'status',
                'data_inicio',
                'data_fim',
                'horario_inicio',
                'horario_fim',
                'dias_semana',
                'carga_horaria',
                'valor_mensalidade',
                'valor_material',
                'valor_desconto',
                'valor_total'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('turmas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        // Add new columns
        Schema::table('turmas', function (Blueprint $table) {
            if (!Schema::hasColumn('turmas', 'serie')) {
                $table->string('serie');
            }
            if (!Schema::hasColumn('turmas', 'turno')) {
                $table->enum('turno', ['manha', 'tarde', 'integral', 'noite']);
            }
            if (!Schema::hasColumn('turmas', 'teacher_id')) {
                $table->foreignId('teacher_id')->constrained('users');
            }
            if (!Schema::hasColumn('turmas', 'capacidade')) {
                $table->integer('capacidade');
            }
            if (!Schema::hasColumn('turmas', 'sala')) {
                $table->string('sala')->nullable();
            }
            if (!Schema::hasColumn('turmas', 'descricao')) {
                $table->text('descricao')->nullable();
            }
            if (!Schema::hasColumn('turmas', 'ano_letivo')) {
                $table->integer('ano_letivo');
            }
        });
    }

    public function down(): void
    {
        // Drop new columns
        Schema::table('turmas', function (Blueprint $table) {
            if (Schema::hasColumn('turmas', 'teacher_id')) {
                $table->dropForeign(['teacher_id']);
            }
            
            $columns = [
                'serie',
                'turno',
                'teacher_id',
                'capacidade',
                'sala',
                'descricao',
                'ano_letivo'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('turmas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        // Add back old columns
        Schema::table('turmas', function (Blueprint $table) {
            $table->integer('quantidade_vagas');
            $table->string('status')->default('active');
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->time('horario_inicio')->nullable();
            $table->time('horario_fim')->nullable();
            $table->string('dias_semana')->nullable();
            $table->integer('carga_horaria')->nullable();
            $table->decimal('valor_mensalidade', 10, 2)->nullable();
            $table->decimal('valor_material', 10, 2)->nullable();
            $table->decimal('valor_desconto', 10, 2)->nullable();
            $table->decimal('valor_total', 10, 2)->nullable();
        });
    }
}; 