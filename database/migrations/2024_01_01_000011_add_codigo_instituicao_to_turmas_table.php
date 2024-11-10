<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->foreignId('id_instituicao')
                ->nullable()
                ->after('quantidade_vagas')
                ->constrained('instituicoes');
        });
    }

    public function down()
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropForeign(['id_instituicao']);
            $table->dropColumn('id_instituicao');
        });
    }
};
