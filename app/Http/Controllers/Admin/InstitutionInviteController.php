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
        $institution = auth()->user()->institution;

        if (!$institution->canSendInvite()) {
            return redirect()->route('institution.invites.index')
                ->with('error', 'Você não tem mais convites disponíveis. Por favor, atualize seu plano.');
        }

        return view('admin.institution-invites.create');
    }

    public function store(Request $request)
    {
        $institution = auth()->user()->institution;

        if (!$institution->canSendInvite()) {
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
            'instituicoes_id' => $institution->id,
            'status' => 'pending',
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($request->email)->send(new InstitutionInvitation($invite));

        return redirect()->route('institution.invites.index')
            ->with('success', 'Convite enviado com sucesso! Convites restantes: ' . $institution->remaining_invites);
    }

    public function index()
    {
        $institution = auth()->user()->institution;
        $invites = InstitutionInvite::where('instituicoes_id', $institution->id)
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('admin.invites.index', compact('invites', 'institution'));
    }

    public function resend(InstitutionInvite $invite)
    {
        $institution = auth()->user()->institution;
        // ... existing code ...
    }
}
