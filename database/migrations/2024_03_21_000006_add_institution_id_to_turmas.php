<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->foreignId('institution_id')->nullable()->after('id');
        });

        // Copiar dados da coluna antiga para a nova
        DB::table('turmas')->update([
            'institution_id' => DB::raw('id_instituicao')
        ]);

        // Remover a foreign key antiga
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropForeign(['id_instituicao']);
            $table->dropColumn('id_instituicao');
        });

        // Tornar a nova coluna não nula e adicionar a foreign key
        Schema::table('turmas', function (Blueprint $table) {
            $table->foreignId('institution_id')->nullable(false)->change();
            $table->foreign('institution_id')
                  ->references('id')
                  ->on('instituicoes')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->foreignId('id_instituicao')->nullable()->after('id');
        });

        // Copiar dados da coluna nova para a antiga
        DB::table('turmas')->update([
            'id_instituicao' => DB::raw('institution_id')
        ]);

        // Remover a foreign key nova
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
            $table->dropColumn('institution_id');
        });

        // Tornar a coluna antiga não nula e adicionar a foreign key
        Schema::table('turmas', function (Blueprint $table) {
            $table->foreignId('id_instituicao')->nullable(false)->change();
            $table->foreign('id_instituicao')
                  ->references('id')
                  ->on('instituicoes')
                  ->cascadeOnDelete();
        });
    }
}; 