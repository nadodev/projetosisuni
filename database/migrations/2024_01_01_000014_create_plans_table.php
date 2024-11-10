<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('invite_limit');
            $table->timestamps();
        });

        // Adicionar coluna de plano na tabela de instituições
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->foreignId('plan_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('invites_used')->default(0);
        });
    }

    public function down()
    {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn(['plan_id', 'invites_used']);
        });
        Schema::dropIfExists('plans');
    }
};
