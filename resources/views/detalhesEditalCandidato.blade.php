@extends('layouts.app')
@section('titulo','Detalhes do Edital')
@section('navbar')
    Home/Detalhes do edital/
@endsection
@section('content')

<style type="text/css">

.hover_img a { position:relative; }
.hover_img a span { position:absolute; display:none; z-index:99; }
.hover_img a:hover span { display:block; overflow: visible; width: 25rem}





</style>

<div class="tela-servidor ">
  <div class="centro-cartao" >
    <div class="card-deck d-flex justify-content-center">
      <div class="conteudo-central d-flex justify-content-center"  style="width: 80rem">  <!-- info edital -->
        <div class="card cartao text-top " style="border-radius: 20px">    <!-- Info -->

         <div class="card-header d-flex justify-content-center" style="background-color: white;margin-top: 10px">
           <h2 style="font-weight: bold">
            <?php
             $nomeEdital = explode(".pdf", $edital->nome);
             echo ($nomeEdital[0]);
            ?>
          </h2>

        </div>
        <a style="padding: 15px">
A Pró-Reitora de Ensino de Graduação torna público para conhecimento dos interessados que, no
PERÍODO DE 29/05 a 05/06 DE 2019, estarão abertas às inscrições para o Processo Seletivo Extra que
visa o preenchimento de vagas para Ingresso via Processo Seletivo Extra nos Cursos de Graduação no 2o
semestre de 2019, de acordo com as normas regimentais da UFRPE (Resolução 410/2007; 354/2008;
34/2008181/91)
        </a>
      </div>
      </div>
      <div class="conteudo-central d-flex justify-content-center" style="width: 80rem">  <!-- opções -->
        <div class="card cartao text-center " style="border-radius: 20px">    <!-- Isenção -->

         <div class="card-body d-flex justify-content-center">
           <h2 style="margin-top: -50px; font-weight: bold">Isenção</h2>
         </div>
         <div class="card-body d-flex justify-content-center">
             <h5 style="margin-top: -50px;">
              Aberto de: <br>
                <a style="font-weight: bold">
                  {{date_format(date_create($edital->inicioIsencao), 'd/m/y')}}
                </a>
                 até
                <a style="font-weight: bold">
                  {{date_format(date_create($edital->fimIsencao), 'd/m/y')}}
                </a>
             </h5>
         </div>
         @if(!is_null($isencao))
          <div class="container justify-content-center" style="margin-top: -15px" >
            <h5>
              Status da Isenção: <br>
              @if($isencao->parecer == 'deferida')
                <a style="font-weight: bold; color: green">Aprovado</a>
              @elseif($isencao->parecer == 'nao')
                <a style="font-weight: bold">Processando</a>
              @else
                <div class="hover_img">
                  <a style="font-weight: bold; color: red">Rejeitado</a>
                  <a style="color:white">
                    <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}" />
                    <span style="background-color: #1B2E4F; color: white; border-radius: 5px; padding: 5px; size: 5rem" >
                        Motivo:
                        <br>
                          {{$isencao->motivoRejeicao}}
                    </span>
                  </a>
                </div>
              @endif
            </h5>
          </div>
         @endif
         <div class="container justify-content-center" style="padding: 10px" >  <!-- form Isenção -->
           <form method="GET" action="{{route('editalEscolhido')}}">

             <input type="hidden" name="editalId" value="{{$edital->id}}">
             <input type="hidden" name="tipo" value="requerimentoDeIsencao">
             @if(is_null($isencao))
               @if($edital->inicioIsencao<= $mytime)
                 @if($edital->fimIsencao >= $mytime)
                   <button type="submit" class="btn btn-primary btn-primary-lmts" >
                     {{ __('Preencher formulário') }}
                   </button>
                 @endif
               @endif
             @endif
          </form>
         </div>

        </div>

        <div class="card cartao text-center " style="border-radius: 20px"> <!-- Recurso Isenção -->

          <div class="card-body d-flex justify-content-center">
            <h2 style="margin-top: -50px; font-weight: bold">Recurso Isenção</h2>
          </div>

          <div class="card-body d-flex justify-content-center">
              <h5 style="margin-top: -50px;">
               Aberto de: <br>
                 <a style="font-weight: bold">
                   {{date_format(date_create($edital->inicioRecursoIsencao), 'd/m/y')}}
                 </a>
                  até
                 <a style="font-weight: bold">
                   {{date_format(date_create($edital->fimRecursoIsencao), 'd/m/y')}}
                 </a>
              </h5>
          </div>
          @if(!is_null($recursoIsencao))
            <div class="container justify-content-center" style="margin-top: -15px" >
              <h5>
                Status do Recurso: <br>
                @if($recursoIsencao->homologado == 'aprovado')
                  <a style="font-weight: bold;color: green">Aprovado</a>
                @elseif($recursoIsencao->homologado == 'nao')
                  <a style="font-weight: bold">Processando</a>
                @else
                <div class="hover_img">
                  <a style="font-weight: bold; color: red">Rejeitado</a>
                  <a style="color:white">
                    <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}"/>
                    <span style="background-color: #1B2E4F; color: white; border-radius: 5px; padding: 5px; size: 5rem" >
                        Motivo:
                        <br>
                          {{$recursoIsencao->motivoRejeicao}}
                    </span>
                  </a>
                </div>
                @endif
              </h5>
            </div>
          @endif

          <div class="container justify-content-center" style="padding: 10px" >
            <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Recurso -->

                <input type="hidden" name="editalId" value="{{$edital->id}}">
                <input type="hidden" name="tipo" value="requerimentoDeRecurso">
                <input type="hidden" name="tipoRecurso" value="taxa" >
                @if(is_null($recursoIsencao))
                  @if($edital->inicioRecursoIsencao <= $mytime)
                    @if($edital->fimRecursoIsencao >= $mytime)
                      <button type="submit" class="btn btn-primary btn-primary-lmts" >
                          {{ __('Preencher formulário') }}
                      </button>
                    @endif
                  @endif
                @endif
            </form>
          </div>
        </div>

        <div class="card cartao text-center " style="border-radius: 20px">   <!-- Inscrição -->
             <div class="card-body d-flex justify-content-center">
                 <h2 style="margin-top: -50px; font-weight: bold">Inscrição</h2>
             </div>
             <div class="card-body d-flex justify-content-center">
                 <h5 style="margin-top: -50px;">
                  Aberto de: <br>
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->inicioInscricoes), 'd/m/y')}}
                    </a>
                     até
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->fimInscricoes), 'd/m/y')}}
                    </a>
                 </h5>
             </div>
             @if(!is_null($inscricao))
              <div class="container justify-content-center" style="margin-top: -15px" >
                <h5>
                  Status da Inscrição: <br>
                  @if($inscricao->homologado == 'aprovado')
                    @if($inscricao->homologadoDrca == 'aprovado')
                      <a style="font-weight: bold;color: green">Aprovado</a>
                    @elseif($inscricao->homologadoDrca == 'nao')
                      <a style="font-weight: bold">Processando</a>
                    @else
                      <div class="hover_img">
                        <a style="font-weight: bold; color: red">Rejeitado</a>
                        <a style="color:white">
                          <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}" />
                          <span style="background-color: #1B2E4F; color: white; border-radius: 5px; padding: 5px; size: 5rem" >
                              Motivo:
                              <br>
                                {{$inscricao->motivoRejeicao}}
                          </span>
                        </a>
                      </div>
                    @endif
                  @elseif($inscricao->homologado == 'nao')
                    <a style="font-weight: bold">Processando</a>
                  @else
                    <div class="hover_img">
                      <a style="font-weight: bold; color: red">Rejeitado</a>
                      <a style="color:white">
                        <img src="{{asset('images/iconAjuda.png')}}" style="width: 20px"/>
                        <span style="background-color: #1B2E4F; color: white; border-radius: 5px; padding: 5px; size: 5rem" >
                            Motivo:
                            <br>
                              {{$inscricao->motivoRejeicao}}
                        </span>
                      </a>
                    </div>
                  @endif
                </h5>
              </div>
             @endif
             <div class="container justify-content-center" style="padding: 10px" >
               <form method="GET" action="{{route('editalEscolhido')}}">  <!-- Inscrição -->

                   <input type="hidden" name="editalId" value="{{$edital->id}}">
                   <input type="hidden" name="tipo" value="fazerInscricao">
                   @if(is_null($inscricao))
                     @if($edital->inicioInscricoes <= $mytime)
                       @if($edital->fimInscricoes >= $mytime)
                         <button type="submit" class="btn btn-primary btn-primary-lmts" >
                             {{ __('Preencher formulário') }}
                         </button>
                       @endif
                     @endif
                  @endif
               </form>
             </div>
        </div>


        <div class="card cartao text-center " style="border-radius: 20px">   <!-- Recuso Inscrição -->
             <div class="card-body d-flex justify-content-center">
                 <h2 style="margin-top: -50px; font-weight: bold">Recurso Inscrição</h2>
             </div>

             <div class="card-body d-flex justify-content-center">
                 <h5 style="margin-top: -50px;">
                  Aberto de: <br>
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->inicioRecurso), 'd/m/y')}}
                    </a>
                     até
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->fimRecurso), 'd/m/y')}}
                    </a>
                 </h5>
             </div>
             @if(!is_null($recursoInscricao))
               <div class="container justify-content-center" style="margin-top: -15px" >
                 <h5>
                   Status da Isenção: <br>
                   @if($recursoInscricao->homologado == 'aprovado')
                     <a style="font-weight: bold;color: green">Aprovado</a>
                   @elseif($recursoInscricao->homologado == 'nao')
                     <a style="font-weight: bold">Processando</a>
                   @else
                     <div class="hover_img">
                       <a style="font-weight: bold; color: red">Rejeitado</a>
                       <a style="color:white">
                         <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}" />
                         <span style="background-color: #1B2E4F; color: white; border-radius: 5px; padding: 5px; size: 5rem" >
                             Motivo:
                             <br>
                               {{$recursoInscricao->motivoRejeicao}}
                         </span>
                       </a>
                     </div>
                   @endif
                 </h5>
               </div>
             @endif

             <div class="container justify-content-center" style="padding: 10px" >
               <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Recurso -->

                   <input type="hidden" name="editalId" value="{{$edital->id}}">
                   <input type="hidden" name="tipo" value="requerimentoDeRecurso">
                   <input type="hidden" name="tipoRecurso" value="classificacao" >
                   @if(is_null($recursoInscricao))
                     @if($edital->inicioRecurso <= $mytime)
                       @if($edital->fimRecurso >= $mytime)
                         <button type="submit" class="btn btn-primary btn-primary-lmts" >
                             {{ __('Preencher formulário') }}
                         </button>
                       @endif
                     @endif
                   @endif
               </form>
             </div>
        </div>

    </div>
  </div>
</div>

@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif



@endsection