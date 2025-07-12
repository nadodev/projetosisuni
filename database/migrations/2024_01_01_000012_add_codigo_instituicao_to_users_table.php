<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'id_instituicao')) {
                $table->foreignId('id_instituicao')
                    ->nullable()
                    ->after('remember_token')
                    ->constrained('instituicoes');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_instituicao']);
            $table->dropColumn('id_instituicao');
        });
    }
};
