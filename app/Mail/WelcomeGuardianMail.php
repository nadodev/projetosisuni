<?php

namespace App\Mail;

use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeGuardianMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public StudentProfile $student
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem-vindo(a) ao Portal do Responsável - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.welcome-guardian',
            with: [
                'user' => $this->user,
                'student' => $this->student,
                'loginUrl' => route('login'),
            ],
        );
    }
} 