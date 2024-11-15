<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('institution_invites', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('token')->unique();
            $table->string('role');
            $table->foreignId('id_institution')
                  ->constrained('instituicoes')
                  ->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'expired'])
                  ->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('institution_invites');
    }
};
