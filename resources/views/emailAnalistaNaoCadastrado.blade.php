@component('mail::message',['url' => 'http://extrasisu.ufape.edu.br/'])
# Seja Bem-Vindo!

Você foi convidado para ser analista no edital {{$edital}}.

Seus dados de login para que possa completar o cadastro:

E-mail: {{$email}}

Senha temporária: {{$password}}


@component('mail::button', ['url' => 'http://extrasisu.ufape.edu.br/'])
Fazer login
@endcomponent
Atenciosamente,<br><br>
Extra SiSU<br>
Laboratório Multidisciplinar de Tecnologias Sociais<br>
Universidade Federal do Agreste de Pernambuco
@endcomponent
