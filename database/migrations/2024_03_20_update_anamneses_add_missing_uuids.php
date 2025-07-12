<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Anamnese;

return new class extends Migration
{
    public function up(): void
    {
        // Atualiza anamneses existentes que não têm UUID
        $anamneses = Anamnese::whereNull('uuid')->get();
        foreach ($anamneses as $anamnese) {
            $anamnese->update(['uuid' => Str::uuid()]);
        }
    }

    public function down(): void
    {
        // Não é necessário fazer nada no down
    }
}; 