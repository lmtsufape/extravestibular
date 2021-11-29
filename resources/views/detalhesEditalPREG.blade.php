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
    height: 500px;
  }

  #label{
    margin-left: 3%;
  }
  #card{
    height: 24rem;
  }

  @media screen and (max-width: 576px){
    #finalizarModal{
      margin-top: 40px;
    }
    .card{
      margin-left: 50px;
    }
    #card{
      height: 26rem;
    }
    .titulo-tabela-lmts {
      margin-right: 5%;

    }
    #label{
      margin-left: 4%;
    }

  }

</style>



<!-- Modal Nova Errata -->
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

           <div class="row" style="margin-left: 0.5%;">
             <label for="nome" class="field a-field a-field_a2 page__field" style="width:100%">
               <span class="a-field__label-wrap">
                 <span class="a-field__label">Nome*</span>
               </span>
           </div>
           <div class="row justify-content-center" style="">  <!-- Nome -->
             <div class="col-sm-12">

                 <input id="nome" type="text" name="nome" class="field__input a-field__input orm-control @error('nome') is-invalid @enderror" placeholder="Nome" value="{{ old('nome') }}">
                 @error('nome')
                 <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                   <strong>{{ $message }}</strong>
                 </span>
                 @enderror
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
               <input name="editarEdital" id="editarEdital" type="checkbox" value="sim">
               <input name="editalId" type="hidden" value="{{$editalId}}">
             <label for="editarEdital">{{ __('Marque se existir mudança nas datas') }}</label>
           </div>
           </div>

         </div>

      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 50px;margin-top:40px;">Fechar</button>
        <button onclick="event.preventDefault();confirmarErrata();" id="finalizarModal" class="btn btn-primary btn-primary-lmts">
          {{ __('Enviar') }}
        </button>
      </div>
    </div>
  </div>
  </form>
</div> <!-- End Modal -->


<!-- Modal Nova Errata -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <form method="POST" action="{{ route('modificarErrata') }}" enctype="multipart/form-data" id="formModificarErrata">
    @csrf
    <input type="hidden" name="errataId" value="" id="idModificarErrata">
    <input name="editalId" type="hidden" value="{{$editalId}}">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Modificar Errata</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div>
           <div id="label1" class="row" style="margin-left:0.5%">
             <label  for="arquivo" class="col-form-label text-sm-right">{{ __('Arquivo*') }}</label>
           </div>
          <div class="row justify-content-left" >  <!-- PDF -->
           <div class="col-md-12" style="">
             <div class="custom-file">
               <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="arquivo1">
             </div>
             @error('arquivo1')
             <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
               <strong>{{ $message }}</strong>
             </span>
             @enderror
           </div>
          </div><!-- end PDF -->
         </div>

      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 50px;margin-top:40px;">Fechar</button>
        <button onclick="event.preventDefault();confirmarModificarErrata();" id="finalizarModal1" class="btn btn-primary btn-primary-lmts">
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


        <button id="buttonModal" type="button" class="btn btn-primary btn-primary-lmts" data-toggle="modal" data-target="#exampleModal"
        style="margin-top:-40px; float:right">
          Nova Errata
        </button>
        @if(old('nome') || old('arquivo'))
          <script type="text/javascript" >
            alert('Ocorreu um erro ao cadastrar errata tente novamente.');
          </script>
        @endif
        @if(old('arquivo1'))
          <script type="text/javascript" >
            alert('Ocorreu um erro ao cadastrar errata tente novamente.');
          </script>
        @endif


  </div><!-- end Título erratas -->

  @if($erratas->isNotEmpty())
    <div class="row" style="width: 100%">
      <table class="table table-ordered table-hover" style="margin-left: 1%;width:100%">

        @foreach($erratas as $errata)
          <tr>
           <td align="left">
             <a style="margin-left: 1%;font-weight: bold; font-size: 15px;">{{$errata->nome}}</a>
           </td>
           <td align="right"> <!-- modificar -->
               <a id="buttonModal1" class="" href="" data-toggle="modal" data-target="#exampleModal1" onclick="idErrata({{$errata->id}});">Modificar Arquivo</a>
           </td>
           <td align="right"> <!-- Download -->
             <a href="{{ route('download', ['file' => $errata->arquivo])}}" target="_new">Baixar Errata</a>
           </td>
          </tr>
        @endforeach
      </table>
    </div>
  @endif

</div><!--end lista erratas  -->

</div><!-- end Container-->


<!-- CARDS -->
<div class="row justify-content-center" style="width: 100%; padding-top: 1%;">  <!-- opções -->
  <div id="card" class="card text-center" style="border-radius: 20px;">    <!-- Isenção -->
    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2" style="font-weight: bold">Avaliar solicitações <br>de isenção</h2>

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

        Total de solicitações: <a style="font-weight: bold">{{($isencoesHomologadas + $isencoesNaoHomologadas)}}</a>

      </h5>
        <h5>
          Solicitações homologadas: <a style="font-weight: bold">{{$isencoesHomologadas}}</a>
        </h5>
        <h5>
          Solicitações em espera: <a style="font-weight: bold">{{$isencoesNaoHomologadas}}</a>
        </h5>
    </div>

    <div class="container justify-content-center" style="padding: 13px;border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >  <!-- form Isenção -->
      <form method="GET" action="{{route('editalEscolhido')}}">

        <input type="hidden" name="editalId" value="{{$edital->id}}">
        <input type="hidden" name="tipo" value="homologarIsencao">

            <button type="submit" class="btn btn-primary btn-primary-lmts "  >
              {{ __('Homologar Isenção') }}
            </button>
      </form>
    </div>

  </div> <!-- END Isenção-->

  <div id="card" class="card text-center " style="border-radius: 20px;"> <!-- Recurso Isenção -->

    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2" style="font-weight: bold">Avaliar recursos às <br>solicitações de isenção</h2>

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

        Total de recursos: <a style="font-weight: bold">{{($recursosTaxaHomologados + $recursosTaxaNaoHomologados)}}</a>

      </h5>
        <h5>
          Recursos avaliados: <a style="font-weight: bold">{{$recursosTaxaHomologados}}</a>
        </h5>
        <h5>
          Recursos em espera: <a style="font-weight: bold">{{$recursosTaxaNaoHomologados}}</a>
        </h5>
    </div>


    <div class="container justify-content-center" style="padding: 13px;border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
      <form method="GET" action="{{route('editalEscolhido')}}">

        <input type="hidden" name="editalId" value="{{$edital->id}}">
        <input type="hidden" name="tipo" value="homologarRecursosIsencao">

        <button type="submit" class="btn btn-primary btn-primary-lmts">
          {{ __('Homologar Recursos Isenção') }}
        </button>
      </form>
    </div>
  </div><!-- END Recurso Isenção -->

  <div id="card" class="card text-center " style="border-radius: 20px;">   <!-- Inscrição -->

       <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 class="h2" style="font-weight: bold">Homologar <br>inscrições</h2>

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

          Total de inscrições: <a style="font-weight: bold">{{($inscricoesHomologadas + $inscricoesNaoHomologadas)}}</a>

         </h5>
           <h5>
            Inscrições avaliadas: <a style="font-weight: bold">{{$inscricoesHomologadas}}</a>
           </h5>
           <h5>
            Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoHomologadas}}</a>
           </h5>
       </div>
      <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
         <form method="GET" action="{{route('editalEscolhido')}}">

             <input type="hidden" name="editalId" value="{{$edital->id}}">
             <input type="hidden" name="tipo" value="homologarInscricoes">

            <button type="submit" class="btn btn-primary btn-primary-lmts ">
                {{ __('Homologar Inscrições') }}
            </button>
         </form>
       </div>
  </div> <!-- END Inscrição -->

  <div id="card" class="card text-center " style="border-radius: 20px;">   <!-- Recuso Inscrição -->
       <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 class="h2" style="font-weight: bold">Avaliar recursos às <br>inscrições</h2>

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

          Total de recursos: <a style="font-weight: bold">{{($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados)}}</a>

         </h5>
           <h5>
            Recursos avaliados: <a style="font-weight: bold">{{$recursosClassificacaoHomologados}}</a>
           </h5>
           <h5>
            Recursos em espera: <a style="font-weight: bold">{{$recursosClassificacaoNaoHomologados}}</a>
           </h5>
       </div>
       <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
         <form method="GET" action="{{route('editalEscolhido')}}">

            <input type="hidden" name="editalId" value="{{$edital->id}}">
            <input type="hidden" name="tipo" value="homologarRecursosInscricao">

            <button type="submit" class="btn btn-primary btn-primary-lmts">
            {{ __('Homologar Recursos Inscrição') }}
            </button>
         </form>
       </div>
     </div> <!-- END Recuso Inscrição -->

  <div id="card" class="card text-center " style="border-radius: 20px;">   <!-- Recuso Resultado -->
      <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
          <h2 class="h2" style="font-weight: bold">Avaliar recursos ao <br>resultado parcial</h2>

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

          Total de recursos: <a style="font-weight: bold">{{($recursosResultadoHomologados + $recursosResultadoNaoHomologados)}}</a>

        </h5>
          <h5>
            Recursos avaliados: <a style="font-weight: bold">{{$recursosResultadoHomologados}}</a>
          </h5>
          <h5>
            Recursos em espera: <a style="font-weight: bold">{{$recursosResultadoNaoHomologados}}</a>
          </h5>
      </div>
      <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
        <form method="GET" action="{{route('editalEscolhido')}}">

            <input type="hidden" name="editalId" value="{{$edital->id}}">
            <input type="hidden" name="tipo" value="homologarRecursosResultado">

            <button type="submit" class="btn btn-primary btn-primary-lmts" >
                {{ __('Homologar Recursos Resultado') }}
            </button>
        </form>
      </div>
    </div><!-- END Recuso Resultado -->

  <div id="card" class="card text-center " style="border-radius: 20px;">    <!-- Classificação -->
   <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
     <h2 class="h2" style="font-weight: bold">Gerar <br>resultado <?php if($mytime <= $edital->resultado ){echo('parcial');}else{echo('final');} ?></h2>

   </div>
   @if($mytime <= $edital->resultado )
     <div class="card-header d-flex justify-content-center">
         <h5>
          Aberto de: <br>
            <a style="font-weight: bold;">
              {{date_format(date_create($edital->inicioInscricoes), 'd/m/y')}}
            </a>
             até
            <a style="font-weight: bold">
              {{date_format(date_create($edital->resultado), 'd/m/y')}}
            </a>
         </h5>
     </div>
   @else
     <div class="card-header d-flex justify-content-center">
         <h5>
          Aberto de: <br>
            <a style="font-weight: bold;">
              {{date_format(date_create($edital->fimRecursoResultado), 'd/m/y')}}
            </a>
             até
            <a style="font-weight: bold">
              {{date_format(date_create($edital->resultadoFinal), 'd/m/y')}}
            </a>
         </h5>
     </div>
   @endif
   <div class="container-fluid justify-content-center" style="height: 100%; margin-top: 2%">
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
         <form id="detalhesPorcentagem-form" action="{{ route('detalhesPorcentagem') }}" method="get" style="display: none;">

           <input type="hidden" name="editalId" value="{{$edital->id}}">
         </form>
        @endif
     </h4>
     <h5>

      Total de inscrições: <a style="font-weight: bold">{{($inscricoesClassificadas + $inscricoesNaoClassificadas)}}</a>

     </h5>
       <h5>
        Inscrições classificadas: <a style="font-weight: bold">{{$inscricoesClassificadas}}</a>
       </h5>
       <h5>
        Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoClassificadas}}</a>
       </h5>
   </div>

   <div class="container justify-content-center" style="padding: 13px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"   <!-- form Classificação -->
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

  function confirmarErrata(){
    if(confirm("Tem certeza que deseja finalizar?") == true) {
      document.getElementById("formErrata").submit();
    }
  }

  function confirmarModificarErrata(){
    if(confirm("Tem certeza que deseja finalizar?") == true) {
      document.getElementById("formModificarErrata").submit();
    }
  }

  function idErrata(x){
    document.getElementById("idModificarErrata").value = x;

  }

  function novaErrata() {
    document.getElementById("novaErrata").style.display = "block";
  }
</script>

@endsection
