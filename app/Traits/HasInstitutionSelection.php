<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait HasInstitutionSelection
{
    public function getCurrentInstitution()
    {
        try {
            // Se o usuário tem id_instituicao mas não tem current_institution_id
            if ($this->id_instituicao && !$this->current_institution_id) {
                $this->update([
                    'current_institution_id' => $this->id_instituicao
                ]);
                $this->refresh();
            }

            return $this->instituicao;
        } catch (\Exception $e) {
            Log::error('Erro ao obter instituição atual: ' . $e->getMessage(), [
                'user_id' => $this->id,
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    public function switchInstitution($newInstitutionId)
    {
        try {
            if ($this->id_instituicao == $newInstitutionId) {
                $this->update([
                    'current_institution_id' => $newInstitutionId,
                    'id_instituicao' => $newInstitutionId
                ]);
                $this->refresh();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Erro ao trocar instituição: ' . $e->getMessage(), [
                'user_id' => $this->id,
                'new_institution_id' => $newInstitutionId,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    public function canAccessInstitution($institutionId)
    {
        return $this->id_instituicao == $institutionId;
    }
}
