<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\InstitutionInvite;
use App\Models\User;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;

class InvitedRegisterController extends Controller
{
    public function showRegistrationForm(string $token)
    {
        $invite = InstitutionInvite::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        return view('auth.invited-register', compact('invite'));
    }

    public function register(Request $request, string $token)
    {
        Log::info('Iniciando processo de registro', ['token' => $token]);

        $invite = InstitutionInvite::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        Log::info('Convite encontrado', ['invite' => $invite->toArray()]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'cpf' => ['required', 'string', 'size:11', 'unique:users'],
            'telefone' => ['required', 'string', 'max:20'],
            'data_nascimento' => ['required', 'date'],
            'genero' => ['required', 'in:M,F,O'],
            'cep' => ['nullable', 'string', 'size:8'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'uf' => ['nullable', 'string', 'size:2'],
            'numero' => ['nullable', 'integer'],
            'complemento' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $invite->email,
                'password' => Hash::make($request->password),
                'role' => $invite->role,
                'institution_id' => $invite->instituicoes_id,
                'email_verified_at' => now(),
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'data_nascimento' => $request->data_nascimento,
                'genero' => $request->genero,
                'cep' => $request->cep,
                'endereco' => $request->endereco,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
            ]);

            Log::info('Usuário criado', ['user' => $user->toArray()]);

            $invite->update([
                'status' => 'accepted',
                'user_id' => $user->id
            ]);

            $instituicao = Instituicao::find($invite->instituicoes_id);

            if ($instituicao) {
                $instituicao->invites_used += 1;
                $instituicao->save();
            }

            DB::commit();
            Log::info('Transação commitada com sucesso');

            auth()->login($user);
            Log::info('Usuário logado com sucesso');

            return redirect()->route('dashboard')
                ->with('success', 'Conta criada com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar conta', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Erro ao criar conta: ' . $e->getMessage());
        }
    }
}
