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
        return view('admin.institution-invites.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'role' => ['required', 'in:user_teacher,user_student'],
        ]);

        $invite = InstitutionInvite::create([
            'email' => $request->email,
            'role' => $request->role,
            'token' => Str::random(32),
            'instituicoes_id' => auth()->user()->instituicao->id,
            'status' => 'pending',
            'expires_at' => now()->addDays(7),
        ]);

        // Enviar o email
        Mail::to($request->email)->send(new InstitutionInvitation($invite));

        return redirect()->route('institution.invites.index')
            ->with('success', 'Convite enviado com sucesso!');
    }

    public function index()
    {
        $invites = InstitutionInvite::where('instituicoes_id', auth()->user()->instituicao->id)
            ->latest()
            ->paginate(10);

        return view('admin.institution-invites.index', compact('invites'));
    }
}
