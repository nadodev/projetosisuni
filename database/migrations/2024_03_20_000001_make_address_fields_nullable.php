<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cep')->nullable()->change();
            $table->string('endereco')->nullable()->change();
            $table->string('bairro')->nullable()->change();
            $table->string('cidade')->nullable()->change();
            $table->string('uf', 2)->nullable()->change();
            $table->integer('numero')->nullable()->change();
            $table->string('complemento')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cep')->nullable(false)->change();
            $table->string('endereco')->nullable(false)->change();
            $table->string('bairro')->nullable(false)->change();
            $table->string('cidade')->nullable(false)->change();
            $table->string('uf', 2)->nullable(false)->change();
            $table->integer('numero')->nullable(false)->change();
            $table->string('complemento')->nullable(false)->change();
        });
    }
};
