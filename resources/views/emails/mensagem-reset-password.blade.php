@component('mail::message')
Olá {{$user->nome}},<br>
Você solicitou a troca de senha da conta com email {{$user->email}}

@component('mail::button', ['url' => $url])
Alterar senha
@endcomponent

Qualquer dúvida entrar em contato, obrigado!<br>
{{ config('app.name') }}
@endcomponent
