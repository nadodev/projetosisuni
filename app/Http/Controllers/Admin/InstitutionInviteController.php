<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstitutionInvitation;
use App\Models\InstitutionInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InstitutionInviteController extends Controller
{
    public function create()
    {
        $instituicao = auth()->user()->instituicao;

        if (!$instituicao->canSendInvite()) {
            return redirect()->route('institution.invites.index')
                ->with('error', 'Você não tem mais convites disponíveis. Por favor, atualize seu plano.');
        }

        return view('admin.institution-invites.create');
    }

    public function store(Request $request)
    {
        $instituicao = auth()->user()->instituicao;

        if (!$instituicao->canSendInvite()) {
            return redirect()->route('institution.invites.index')
                ->with('error', 'Você não tem mais convites disponíveis. Por favor, atualize seu plano.');
        }

        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'role' => ['required', 'in:user_teacher,user_student'],
        ]);

        $invite = InstitutionInvite::create([
            'email' => $request->email,
            'role' => $request->role,
            'token' => Str::random(32),
            'instituicoes_id' => $instituicao->id,
            'status' => 'pending',
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($request->email)->send(new InstitutionInvitation($invite));

        return redirect()->route('institution.invites.index')
            ->with('success', 'Convite enviado com sucesso! Convites restantes: ' . $instituicao->remaining_invites);
    }

    public function index()
    {
        $instituicao = auth()->user()->instituicao;
        $invites = InstitutionInvite::where('instituicoes_id', $instituicao->id)
            ->latest()
            ->paginate(10);

        return view('admin.institution-invites.index', [
            'invites' => $invites,
            'remainingInvites' => $instituicao->remaining_invites
        ]);
    }
}
