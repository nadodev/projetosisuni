<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MigrateInstitutionUsers extends Command
{
    protected $signature = 'migrate:institution-users';
    protected $description = 'Migra usuários existentes para a nova tabela pivot institution_user';

    public function handle()
    {
        $users = User::whereNotNull('id_instituicao')->get();

        foreach ($users as $user) {
            // Adiciona a instituição atual na tabela pivot
            $user->institutions()->syncWithoutDetaching([$user->id_instituicao]);

            // Define a instituição atual
            $user->update(['current_institution_id' => $user->id_instituicao]);
        }

        $this->info('Migração de usuários concluída com sucesso!');
    }
}
