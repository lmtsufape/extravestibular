@extends('layouts.app')
@section('titulo','Detalhes do Edital')
@section('navbar')
    <!-- Home / Detalhes do edital -->
    <li class="nav-item active">
      <a class="nav-link" style="color: black" href="{{ route('home') }}"
         onclick="event.preventDefault();
                       document.getElementById('VerEditais').submit();">
         {{ __('Home') }}
      </a>
      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

      </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
      <a class="nav-link" >
        {{ __('Detalhes do Edital')}}
      </a>

    </li>

@endsection
@section('content')

<style type="text/css">
.btn-primary {
  margin-top: 8%;
}

.h2 {
  font-size: 110%;
}


</style>

<div class="centro-cartao"  style=" height: 110vh; padding-bottom: 5%" >

    <div class="card-deck d-flex justify-content-center">
      <div class="conteudo-central d-flex justify-content-center"  style="width: 100rem; width: 80%;">  <!-- info edital -->
        <div class="card cartao text-top " style="border-radius: 20px; height: 100%" >    <!-- Info -->
         <div class="card-header d-flex justify-content-center" style="margin-top: 0px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 class="h2" style="font-weight: bold; color: white">
            <?php
             $nomeEdital = explode(".pdf", $edital->nome);
             echo ($nomeEdital[0]);
            ?>
          </h2>
         </div>
         <div class="card-body justify-content-center" style="height: 100%">
               <div class="card-body justify-content-center">
                 <a style="padding: 15px">
                  A Pró-Reitora de Ensino de Graduação torna público para conhecimento dos interessados que, no
                  PERÍODO DE 29/05 a 05/06 DE 2019, estarão abertas às inscrições para o Processo Seletivo Extra que
                  visa o preenchimento de vagas para Ingresso via Processo Seletivo Extra nos Cursos de Graduação no 2o
                  semestre de 2019, de acordo com as normas regimentais da UFRPE (Resolução 410/2007; 354/2008;
                  34/2008181/91)
                 </a>

                 @if($erratas->isNotEmpty())
                   <div class="justify-content-center" style="padding-top: 2%">
                     <a style="font-size: 25px; font-weight: bold"> Erratas: </a>

                     <table class="table table-ordered table-hover">

                       @foreach($erratas as $errata)
                         <tr>
                          <td>
                            <a class="row" style="margin-left: 1%;font-weight: bold; font-size: 15px">{{$errata->nome}}</a>
                          </td>
                          <td> <!-- Download -->
                            <a href="{{ route('download', ['file' => $errata->arquivo])}}" target="_new">Baixar Errata</a>
                          </td>
                         </tr>
                       @endforeach
                     </table>
                   </div>
                 @endif

             </div>
         </div>
        </div>
      </div>

      <div class="conteudo-central d-flex justify-content-center" style="width: 97%; padding-top: 1%;">  <!-- opções -->

        <div class="card cartao text-center " style="border-radius: 20px;height: 22.5rem;">    <!-- Isenção -->

          <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
            <h2 class="h2" style="font-weight: bold">Isenção</h2>

          </div>
          <div class="card-header d-flex justify-content-center disabled-lmts">
            <h5>
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
        </div>

        <div class="card cartao text-center " style="border-radius: 20px;height: 22.5rem;"> <!-- Recurso Isenção -->

          <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
            <h2 class="h2" style="font-weight: bold">Recurso Isenção</h2>

          </div>

          <div class="card-header d-flex justify-content-center disabled-lmts">
              <h5>
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

        </div>

        <div class="card cartao text-center " style="border-radius: 20px;height: 22.5rem;">   <!-- Inscrição -->

             <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
                 <h2 class="h2" style="font-weight: bold">Inscrição</h2>

             </div>
             <div class="card-header d-flex justify-content-center disabled-lmts">
                 <h5>
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

        </div>

        <div class="card cartao text-center " style="border-radius: 20px;height: 22.5rem;">   <!-- Recuso Inscrição -->
             <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
                 <h2 class="h2" style="font-weight: bold">Recurso Inscrição</h2>

             </div>

             <div class="card-header d-flex justify-content-center disabled-lmts">
                 <h5>
                  Aberto de: <br>
                    <a style="font-weight: bold;">
                      {{date_format(date_create($edital->inicioRecurso), 'd/m/y')}}
                    </a>
                     até
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->fimRecurso), 'd/m/y')}}
                    </a>
                 </h5>
             </div>

        </div>

        <div class="card cartao text-center " style="border-radius: 20px;height: 22.5rem;">    <!-- Classificação -->
          <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
            <h2 class="h2" style="font-weight: bold">Classificação</h2>
          </div>
          <div class="card-header d-flex justify-content-center">
              <h5>
               Aberto de: <br>
                 <a style="font-weight: bold;">
                   {{date_format(date_create($edital->fimInscricoes), 'd/m/y')}}
                 </a>
                  até
                 <a style="font-weight: bold">
                   {{date_format(date_create($edital->resultado), 'd/m/y')}}
                 </a>
              </h5>
          </div>
          <div class="container justify-content-center" style="height: 13rem; background-color: #F7F7F7; padding: 10px">
            <h4>
              <?php
                $porcentagem = $inscricoesClassificadas * 100;
                if(($inscricoesClassificadas + $inscricoesNaoClassificadas)>0){
                  $porcentagem = $porcentagem / ($inscricoesClassificadas + $inscricoesNaoClassificadas);
                }
                else{
                  $porcentagem = 0;
                }
               ?>
               @if(($inscricoesClassificadas + $inscricoesNaoClassificadas) > 0 )
                <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada.</a>
               @endif
            </h4>
            <h5>

                Total de Inscrições: <a style="font-weight: bold">{{($inscricoesClassificadas + $inscricoesNaoClassificadas)}}.</a>

            </h5>
              <h5>
                Inscrições homologadas: <a style="font-weight: bold">{{$inscricoesClassificadas}}.</a>
              </h5>
              <h5>
                Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoClassificadas}}.</a>
              </h5>
          </div>
         <div class="container justify-content-center" style="margin-top: -10%" >
           <form method="GET" action="{{route('editalEscolhido')}}">

               <input type="hidden" name="editalId" value="{{$edital->id}}">
               <input type="hidden" name="tipo" value="classificarInscricoes">

               @if($edital->inicioInscricoes<= $mytime)

                   <button type="submit" class="btn btn-primary btn-primary-lmts" >
                       {{ __('Classificar Inscrições') }}
                   </button>


               @else
               <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                   {{ __('Classificar Inscrições') }}
               </button>
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
