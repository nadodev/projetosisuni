<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\InstitutionInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InstitutionInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public InstitutionInvite $invite
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Convite para Instituição',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.institution-invitation',
            with: [
                'registrationUrl' => route('invited.register.form', ['token' => $this->invite->token]),
                'institutionName' => $this->invite->institution->nome,
                'role' => $this->invite->role === 'user_teacher' ? 'Professor' : 'Aluno',
            ],
        );
    }
}
