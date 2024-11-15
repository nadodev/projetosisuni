<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('anamnese_evolutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anamnese_id')->constrained()->onDelete('cascade');
            $table->timestamp('date');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anamnese_evolutions');
    }
};
