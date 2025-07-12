<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('form_fields')) {
            Schema::create('form_fields', function (Blueprint $table) {
                $table->id();
                $table->foreignId('form_id')->constrained()->onDelete('cascade');
                $table->foreignId('field_id')->constrained()->onDelete('cascade');
                $table->integer('order')->default(0);
                $table->timestamps();

                // Índices
                $table->unique(['form_id', 'field_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('form_fields');
    }
};
