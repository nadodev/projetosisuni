<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->string('cnpj')->nullable()->after('nome');
            $table->string('email')->nullable()->after('cnpj');
            $table->string('telefone')->nullable()->after('email');
            $table->string('cep')->nullable()->after('telefone');
            $table->string('endereco')->nullable()->after('cep');
            $table->string('bairro')->nullable()->after('endereco');
            $table->string('cidade')->nullable()->after('bairro');
            $table->string('uf', 2)->nullable()->after('cidade');
            $table->integer('numero')->nullable()->after('uf');
            $table->string('complemento')->nullable()->after('numero');
        });
    }

    public function down(): void
    {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->dropColumn([
                'cnpj',
                'email',
                'telefone',
                'cep',
                'endereco',
                'bairro',
                'cidade',
                'uf',
                'numero',
                'complemento'
            ]);
        });
    }
}; 