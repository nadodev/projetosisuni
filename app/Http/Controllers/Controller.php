<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function checkInstitutionAccess()
    {
        try {
            $user = auth()->user();

            if (!$user) {
                Log::warning('Usuário não autenticado tentando acessar recurso protegido');
                return false;
            }

            if (!$user->id_instituicao) {
                Log::warning('Usuário sem instituição', [
                    'user_id' => $user->id
                ]);
                return false;
            }

            $instituicao = $user->getCurrentInstitution();
            if (!$instituicao) {
                Log::warning('Usuário sem instituição atual', [
                    'user_id' => $user->id,
                    'id_instituicao' => $user->id_instituicao
                ]);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao verificar acesso à instituição: ' . $e->getMessage(), [
                'user_id' => $user->id ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}
