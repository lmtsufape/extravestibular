@component('mail::message',['url' => 'http://extrasisu.ufape.edu.br/'])
# Olá,

você foi convidado para ser analista no edital {{$edital}}.

@component('mail::button', ['url' => 'http://extrasisu.ufape.edu.br/'])
Fazer login
@endcomponent
Atenciosamente,<br><br>
Extra SiSU<br>
Laboratório Multidisciplinar de Tecnologias Sociais<br>
Universidade Federal do Agreste de Pernambuco
@endcomponent
