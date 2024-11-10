<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->integer('available_invites')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->dropColumn('available_invites');
        });
    }
};
