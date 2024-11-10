@component('mail::message')
# Convite para Instituição

Você foi convidado para se juntar à instituição {{ $institutionName }} como {{ $role }}.

Para completar seu cadastro, clique no botão abaixo:

@component('mail::button', ['url' => $registrationUrl])
Completar Cadastro
@endcomponent

Este convite expira em 7 dias.

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
