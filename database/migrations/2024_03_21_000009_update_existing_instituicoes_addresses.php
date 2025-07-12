<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Atualizar instituições existentes com dados padrão
        DB::table('instituicoes')
            ->whereNull('cidade')
            ->orWhereNull('uf')
            ->update([
                'cidade' => 'Não informada',
                'uf' => 'SP'
            ]);
    }

    public function down(): void
    {
        // Não é necessário reverter esta migração
    }
}; 