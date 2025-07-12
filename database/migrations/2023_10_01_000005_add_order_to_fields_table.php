<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fields', function (Blueprint $table) {
            // $table->integer('order')->default(0)->after('type'); // Adiciona a coluna de ordem após a coluna 'type'
        });
    }

    public function down()
    {
        Schema::table('fields', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
