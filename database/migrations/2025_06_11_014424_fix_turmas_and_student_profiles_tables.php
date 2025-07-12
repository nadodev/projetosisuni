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
        // First, let's fix the turmas table
        Schema::table('turmas', function (Blueprint $table) {
            // Drop old columns if they exist
            $columns = [
                'professor_id',
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

        Schema::table('turmas', function (Blueprint $table) {
            // Add new columns if they don't exist
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

        // Now, let's fix the student_profiles table
        Schema::table('student_profiles', function (Blueprint $table) {
            // Drop the existing foreign key if it exists
            $foreignKeys = Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableForeignKeys('student_profiles');
            
            $hasClassForeignKey = collect($foreignKeys)
                ->contains(function ($foreignKey) {
                    return $foreignKey->getName() === 'student_profiles_class_id_foreign';
                });

            if ($hasClassForeignKey) {
                $table->dropForeign(['class_id']);
            }

            // Drop the column if it exists
            if (Schema::hasColumn('student_profiles', 'class_id')) {
                $table->dropColumn('class_id');
            }
        });

        Schema::table('student_profiles', function (Blueprint $table) {
            // Add the column back with the desired properties
            $table->foreignId('class_id')->nullable()->constrained('turmas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert student_profiles changes
        Schema::table('student_profiles', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });

        // Revert turmas changes
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropColumn([
                'serie',
                'turno',
                'teacher_id',
                'capacidade',
                'sala',
                'descricao',
                'ano_letivo'
            ]);
        });

        Schema::table('turmas', function (Blueprint $table) {
            $table->foreignId('professor_id')->nullable()->constrained('users');
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
