<x-mail::message>
# Bem-vindo(a) ao {{ config('app.name') }}!

Olá {{ $user->name }},

Seja bem-vindo(a) ao Portal do Responsável do {{ config('app.name') }}! Estamos felizes em ter você conosco.

O cadastro do(a) estudante **{{ $student->full_name }}** foi realizado com sucesso. Você poderá acompanhar todo o desenvolvimento e as atividades do(a) estudante através do nosso portal.

## Dados de Acesso

Para acessar o portal, utilize as seguintes credenciais:

- **E-mail:** {{ $user->email }}
- **Senha:** Uma senha temporária foi enviada para seu e-mail. Por favor, altere-a no primeiro acesso.

<x-mail::button :url="$loginUrl">
Acessar o Portal
</x-mail::button>

## Próximos Passos

1. Acesse o portal com suas credenciais
2. Altere sua senha temporária
3. Complete seu perfil com informações adicionais
4. Explore as funcionalidades disponíveis

## Precisa de Ajuda?

Se tiver alguma dúvida ou precisar de suporte, entre em contato com a secretaria da instituição.

Atenciosamente,<br>
Equipe {{ config('app.name') }}

<x-mail::subcopy>
Este é um e-mail automático. Por favor, não responda.
</x-mail::subcopy>
</x-mail::message> 