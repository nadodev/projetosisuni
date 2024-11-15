<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class UserInstitutionController extends Controller
{
    public function edit(User $user)
    {
        $userInstitutions = $user->institutions->pluck('id')->toArray();
        $allInstitutions = Instituicao::orderBy('nome')->get();

        return view('admin.users.institutions', compact('user', 'userInstitutions', 'allInstitutions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'institutions' => 'required|array',
            'institutions.*' => 'exists:instituicoes,id'
        ]);

        $user->institutions()->sync($validated['institutions']);

        // Se a instituição atual não está mais na lista, atualiza para a primeira da nova lista
        if (!in_array($user->current_institution_id, $validated['institutions'])) {
            $user->update([
                'current_institution_id' => $validated['institutions'][0] ?? null
            ]);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Instituições do usuário atualizadas com sucesso!');
    }
}
