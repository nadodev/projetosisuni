<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('anamneses', function (Blueprint $table) {
            $table->foreignId('instituicao_id')
                  ->nullable()
                  ->after('professional_id')
                  ->constrained('instituicoes')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('anamneses', function (Blueprint $table) {
            $table->dropForeign(['instituicao_id']);
            $table->dropColumn('instituicao_id');
        });
    }
};
