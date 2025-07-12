<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Verifica se a coluna uuid já existe
        $columns = DB::getSchemaBuilder()->getColumnListing('anamneses');
        
        if (!in_array('uuid', $columns)) {
            Schema::table('anamneses', function (Blueprint $table) {
                $table->uuid('uuid')->after('id')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Não fazemos nada no down pois não queremos remover a coluna
    }
}; 