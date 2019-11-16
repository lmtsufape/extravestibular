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
  color: #1B2E4F;
  font-size: 110%;
}
.card{
  margin: 10px;

}

#label{
  margin-left: 3%;
}

@media screen and (max-width: 576px){
  #finalizarModal{
    margin-top: 40px;
  }
  .card{
    margin-left: 50px;

  }
  .titulo-tabela-lmts {
    margin-right: 5%;

  }
  #label{
    margin-left: 4%;
  }

}

</style>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="{{ route('cadastroErrata') }}" enctype="multipart/form-data" id="formErrata">
    @csrf
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova Errata</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div>
           <input type="hidden" name="editalId" value="{{$edital->id}}" />

           <div class="row" style="margin-left: 0.5%;">
             <label for="nome" class="field a-field a-field_a2 page__field" style="width:100%">
               <span class="a-field__label-wrap">
                 <span class="a-field__label">Nome*</span>
               </span>
           </div>
           <div class="row justify-content-center" style="">  <!-- Nome -->
             <div class="col-sm-12">

                 <input id="nome" type="text" name="nome" class="field__input a-field__input" placeholder="Nome">
               </label>
              </div>
            </div><!--end Nome -->


             <div id="label" class="row" style="margin-left:0.5%">
               <label  for="arquivo" class="col-form-label text-sm-right">{{ __('Arquivo*') }}</label>
             </div>
             <div  class="row justify-content-left" >  <!-- PDF -->

               <div class="col-md-12" style="">
                 <div class="custom-file">
                   <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="arquivo">
                 </div>
                 @error('arquivo')
                 <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                   <strong>{{ $message }}</strong>
                 </span>
                 @enderror
               </div>
          </div><!-- end PDF -->

           <div  class="row" style="margin-top:10px;">
             <div class="col-sm-10">
               <input name="editarEdital" type="checkbox" value="sim">
             <label for="editarEdital">{{ __('Marque se existir mudança nas datas') }}</label>
           </div>
           </div>

         </div>

      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 50px;margin-top:40px;">Fechar</button>
        <button type="submit" id="finalizarModal" class="btn btn-primary btn-primary-lmts">
          {{ __('Enviar') }}
        </button>
      </div>
    </div>
  </div>
  </form>
</div> <!-- End Modal -->

<div class="container">


  <div class="row justify-content-center">

    <!-- Título do Edital -->
    <div class="titulo-tabela-lmts col-sm-12">
      <h2>
        <?php
         $nomeEdital = explode(".pdf", $edital->nome);
         echo ($nomeEdital[0]);
        ?>
      </h2>
    </div>
  </div> <!--end título edital -->

  <div class="row justify-content-center" style="margin-top:20px">

    <p class="col-sm-12">
      {{$edital->descricao}}
    </p>
  </div> <!-- end paragrafo-->



<div class="row justify-content-center">

  <div class="titulo-tabela-lmts col-sm-12">
      <h3>
        Erratas
      </h3>


        <button type="button" class="btn btn-primary btn-primary-lmts" data-toggle="modal" data-target="#exampleModal"
        style="margin-top:-40px; float:right">
          Nova Errata
        </button>

  </div><!-- end Título erratas -->

  @if($erratas->isNotEmpty())
      <table class="table table-ordered table-hover" style="margin-left: 1%;width:100%">

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
  @endif

</div><!--end lista erratas  -->

</div><!-- end Container-->


<!-- CARDS -->
<div class="row justify-content-center" style="width: 97%; padding-top: 1%;">  <!-- opções -->
  <div class="card text-center" style="border-radius: 20px;height: 22.5rem;">    <!-- Isenção -->
    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2" style="font-weight: bold">Isenção</h2>

    </div>
    <div class="card-header d-flex justify-content-center">
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
    <div class="container justify-content-center" style="height: 100%; margin-top: 2%">
      <h4>
        <?php
          $porcentagem = $isencoesHomologadas * 100;
          if(($isencoesHomologadas + $isencoesNaoHomologadas)>0){
            $porcentagem = $porcentagem / ($isencoesHomologadas + $isencoesNaoHomologadas);
          }
          else{
            $porcentagem = 0;
          }
         ?>
         @if(($isencoesHomologadas + $isencoesNaoHomologadas) > 0 )
          <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada.</a>
         @endif
      </h4>
      <h5>

          Total de Inscrições: <a style="font-weight: bold">{{($isencoesHomologadas + $isencoesNaoHomologadas)}}</a>

      </h5>
        <h5>
          Inscrições homologadas: <a style="font-weight: bold">{{$isencoesHomologadas}}</a>
        </h5>
        <h5>
          Inscrições em espera: <a style="font-weight: bold">{{$isencoesNaoHomologadas}}</a>
        </h5>
    </div>

    <div class="container justify-content-center" style="padding: 13px;border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >  <!-- form Isenção -->
      <form method="GET" action="{{route('editalEscolhido')}}">

        <input type="hidden" name="editalId" value="{{$edital->id}}">
        <input type="hidden" name="tipo" value="homologarIsencao">

        @if($edital->inicioIsencao<= $mytime)
          @if($edital->fimIsencao >= $mytime)
            <button type="submit" class="btn btn-primary btn-primary-lmts "  >
              {{ __('Homologar Isenção') }}
            </button>
          @else
            <button type="submit" disabled class="btn btn-primary btn-primary-lmts ">
              {{ __('Homologar Isenção') }}
            </button>
          @endif
        @else
          <button type="submit" disabled class="btn btn-primary btn-primary-lmts "  >
            {{ __('Homologar Isenção') }}
          </button>
        @endif
      </form>
    </div>

  </div> <!-- END Isenção-->

  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;"> <!-- Recurso Isenção -->

    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2" style="font-weight: bold">Recurso Isenção</h2>

    </div>

    <div class="card-header d-flex justify-content-center">
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
    <div class="container justify-content-center" style="height: 100%;  margin-top: 2%">
      <h4>
        <?php
          $porcentagem = $recursosTaxaHomologados * 100;
          if(($recursosTaxaHomologados + $recursosTaxaNaoHomologados)>0){
            $porcentagem = $porcentagem / ($recursosTaxaHomologados + $recursosTaxaNaoHomologados);
          }
          else{
            $porcentagem = 0;
          }
         ?>
         @if(($recursosTaxaHomologados + $recursosTaxaNaoHomologados) > 0 )
          <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada</a>
         @endif
      </h4>
      <h5>

          Total de Inscrições: <a style="font-weight: bold">{{($recursosTaxaHomologados + $recursosTaxaNaoHomologados)}}</a>

      </h5>
        <h5>
          Inscrições homologadas: <a style="font-weight: bold">{{$recursosTaxaHomologados}}</a>
        </h5>
        <h5>
          Inscrições em espera: <a style="font-weight: bold">{{$recursosTaxaNaoHomologados}}</a>
        </h5>
    </div>


    <div class="container justify-content-center" style="padding: 13px;border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
      <form method="GET" action="{{route('editalEscolhido')}}">

        <input type="hidden" name="editalId" value="{{$edital->id}}">
        <input type="hidden" name="tipo" value="homologarRecursos">

        @if($edital->inicioRecursoIsencao <= $mytime)
        @if($edital->fimRecursoIsencao >= $mytime)
        <button type="submit" class="btn btn-primary btn-primary-lmts" >
          {{ __('Homologar Recursos Isenção') }}
        </button>
        @else
        <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
          {{ __('Homologar Recursos Isenção') }}
        </button>
        @endif
        @else
        <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
          {{ __('Homologar Recursos Isenção') }}
        </button>
        @endif

      </form>
    </div>
  </div><!-- END Recurso Isenção -->

  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">   <!-- Inscrição -->

       <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 class="h2" style="font-weight: bold">Inscrição</h2>

       </div>
       <div class="card-header d-flex justify-content-center">
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
       <div class="container justify-content-center" style="height: 100%; margin-top: 2%">
         <h4>
           <?php
             $porcentagem = $inscricoesHomologadas * 100;
             if(($inscricoesHomologadas + $inscricoesNaoHomologadas)>0){
               $porcentagem = $porcentagem / ($inscricoesHomologadas + $inscricoesNaoHomologadas);
             }
             else{
               $porcentagem = 0;
             }
            ?>
            @if(($inscricoesHomologadas + $inscricoesNaoHomologadas) > 0 )
             <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada</a>
            @endif
         </h4>
         <h5>

             Total de Inscrições: <a style="font-weight: bold">{{($inscricoesHomologadas + $inscricoesNaoHomologadas)}}</a>

         </h5>
           <h5>
             Inscrições homologadas: <a style="font-weight: bold">{{$inscricoesHomologadas}}</a>
           </h5>
           <h5>
             Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoHomologadas}}</a>
           </h5>
       </div>
      <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
         <form method="GET" action="{{route('editalEscolhido')}}">

             <input type="hidden" name="editalId" value="{{$edital->id}}">
             <input type="hidden" name="tipo" value="homologarInscricoes">

             @if($edital->inicioInscricoes <= $mytime)
               @if($edital->fimInscricoes >= $mytime)
                 <button type="submit" class="btn btn-primary btn-primary-lmts ">
                     {{ __('Homologar Inscrições') }}
                 </button>
               @else
               <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                   {{ __('Homologar Inscrições') }}
               </button>
               @endif
             @else
             <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                 {{ __('Homologar Inscrições') }}
             </button>
             @endif
         </form>
       </div>
  </div> <!-- END Inscrição -->

  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">   <!-- Recuso Inscrição -->
       <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 class="h2" style="font-weight: bold">Recurso Inscrição</h2>

       </div>

       <div class="card-header d-flex justify-content-center">
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
       <div class="container justify-content-center" style="height: 100%;  margin-top: 2%">
         <h4>
           <?php
             $porcentagem = $recursosClassificacaoHomologados * 100;
             if(($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados)>0){
               $porcentagem = $porcentagem / ($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados);
             }
             else{
               $porcentagem = 0;
             }
            ?>
            @if(($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados) > 0 )
             <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada</a>
            @endif
         </h4>
         <h5>

             Total de Inscrições: <a style="font-weight: bold">{{($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados)}}</a>

         </h5>
           <h5>
             Inscrições homologadas: <a style="font-weight: bold">{{$recursosClassificacaoHomologados}}</a>
           </h5>
           <h5>
             Inscrições em espera: <a style="font-weight: bold">{{$recursosClassificacaoNaoHomologados}}</a>
           </h5>
       </div>
       <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
         <form method="GET" action="{{route('editalEscolhido')}}">

             <input type="hidden" name="editalId" value="{{$edital->id}}">
             <input type="hidden" name="tipo" value="homologarRecursos">

             @if($edital->inicioRecurso <= $mytime)
               @if($edital->fimRecurso >= $mytime)
                 <button type="submit" class="btn btn-primary btn-primary-lmts" >
                     {{ __('Homologar Recursos Inscrição') }}
                 </button>
               @else
               <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                   {{ __('Homologar Recursos Inscrição') }}
               </button>
               @endif
             @else
             <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                 {{ __('Homologar Recursos Inscrição') }}
             </button>
             @endif

         </form>
       </div>
     </div> <!-- END Recuso Inscrição -->

  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">   <!-- Recuso Resultado -->
      <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
          <h2 class="h2" style="font-weight: bold">Recurso Resultado</h2>

      </div>

      <div class="card-header d-flex justify-content-center">
          <h5>
           Aberto de: <br>
             <a style="font-weight: bold;">
               {{date_format(date_create($edital->inicioRecursoResultado), 'd/m/y')}}
             </a>
              até
             <a style="font-weight: bold">
               {{date_format(date_create($edital->fimRecursoResultado), 'd/m/y')}}
             </a>
          </h5>
      </div>
      <div class="container justify-content-center" style="height: 100%; margin-top: 2%">
        <h4>
          <?php

            $porcentagem = $recursosResultadoHomologados * 100;
            if(($recursosResultadoHomologados + $recursosResultadoNaoHomologados)>0){
              $porcentagem = $porcentagem / ($recursosResultadoHomologados + $recursosResultadoNaoHomologados);
            }
            else{
              $porcentagem = 0;
            }
           ?>
           @if(($recursosResultadoHomologados + $recursosResultadoNaoHomologados) > 0 )
            <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada</a>
           @endif
        </h4>
        <h5>

            Total de Inscrições: <a style="font-weight: bold">{{($recursosResultadoHomologados + $recursosResultadoNaoHomologados)}}</a>

        </h5>
          <h5>
            Inscrições homologadas: <a style="font-weight: bold">{{$recursosResultadoHomologados}}</a>
          </h5>
          <h5>
            Inscrições em espera: <a style="font-weight: bold">{{$recursosResultadoNaoHomologados}}</a>
          </h5>
      </div>
      <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
        <form method="GET" action="{{route('editalEscolhido')}}">

            <input type="hidden" name="editalId" value="{{$edital->id}}">
            <input type="hidden" name="tipo" value="homologarRecursos">

            @if($edital->inicioRecursoResultado <= $mytime)
              @if($edital->fimRecursoResultado >= $mytime)
                <button type="submit" class="btn btn-primary btn-primary-lmts" >
                    {{ __('Homologar Recursos Resultado') }}
                </button>
              @else
              <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                  {{ __('Homologar Recursos Resultado') }}
              </button>
              @endif
            @else
            <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                {{ __('Homologar Recursos Resultado') }}
            </button>
            @endif

        </form>
      </div>
    </div><!-- END Recuso Resultado -->

  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">    <!-- Classificação -->
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
   <div class="container justify-content-center" style="height: 100%; margin-top: 2%">
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
         <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada</a>
         <a href="{{ route('detalhesPorcentagem') }}"
            onclick="event.preventDefault();
                          document.getElementById('detalhesPorcentagem-form').submit();">
              <img src="{{asset('images/eye.png')}}" alt="">
         </a>
         <form id="detalhesPorcentagem-form" target="_blank" action="{{ route('detalhesPorcentagem') }}" method="get" style="display: none;">

           <input type="hidden" name="editalId" value="{{$edital->id}}">
         </form>
        @endif
     </h4>
     <h5>

         Total de Inscrições: <a style="font-weight: bold">{{($inscricoesClassificadas + $inscricoesNaoClassificadas)}}</a>

     </h5>
       <h5>
         Inscrições homologadas: <a style="font-weight: bold">{{$inscricoesClassificadas}}</a>
       </h5>
       <h5>
         Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoClassificadas}}</a>
       </h5>
   </div>

   <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px"   <!-- form Classificação -->
     <form method="POST" action="{{route('gerarClassificacao')}}" target="_blank" enctype="multipart/form-data">
       @csrf
       <input type="hidden" name="editalId" value="{{$edital->id}}">
       <input type="hidden" name="tipo" value="homologarIsencao">

       @if(($edital->resultado <= $mytime) && ($porcentagem == 100))
         <button type="submit" class="btn btn-primary btn-primary-lmts" >
           {{ __('Gerar Resultado') }}
         </button>
       @else
         <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
           {{ __('Gerar Resultado') }}
         </button>
       @endif
     </form>
   </div>
 </div><!-- END Classificação -->

</div>

<!-- quebra de linha para o footer não cobrir os botões -->
<br>
<br>
<br>

@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif

<script type="text/javascript" >
  function novaErrata() {
    document.getElementById("novaErrata").style.display = "block";
  }
</script>

@endsection
