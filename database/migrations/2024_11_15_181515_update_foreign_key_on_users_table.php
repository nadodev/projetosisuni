<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Primeiro, remove a chave estrangeira existente
            $table->dropForeign(['id_turma']);

            // Agora, recria a chave estrangeira com o comportamento desejado
            $table->foreign('id_turma')
                ->references('id')
                ->on('turmas')
                ->onDelete('cascade'); // Altere para 'set null' se preferir
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a chave estrangeira atual
            $table->dropForeign(['id_turma']);

            // Recria a chave estrangeira original sem o comportamento customizado
            $table->foreign('id_turma')
                ->references('id')
                ->on('turmas')
                ->onDelete('restrict'); // Alterar para o comportamento original, se conhecido
        });
    }
}
