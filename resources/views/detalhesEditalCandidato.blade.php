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

.hover-popup-lmts a:hover span { width: 25rem}

.btn-primary {
  margin-top: 8%;
}


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

}

</style>


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

  <div class="card text-center " style="border-radius: 20px">    <!-- Isenção -->

    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2"style="font-weight: bold">Isenção</h2>

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
   @if(!is_null($isencao))
    <div class="container justify-content-center card-lmts-options">
      <h5>
        Status da Isenção: <br>
        @if($isencao != 'processando')
          @if($isencao->parecer == 'deferida')
            <a style="font-weight: bold; color: green">Aprovado</a>
          @elseif($isencao->parecer == 'nao')
            <a style="font-weight: bold">Processando</a>
          @else
            <div class="hover-popup-lmts">
              <a style="font-weight: bold; color: red">Indeferido</a> <br>
              <a style="font-weight: bold">Justificativa:</a> <br>
              <a> {{$isencao->motivoRejeicao}} </a>
              <!-- <a style="color:white">
                <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}" />
                <span style="background-color: lightgray; color: black; border-radius: 5px; padding: 5px; size: 5rem" >
                    <b style="font-weight: bold">Motivo</b>
                    <br>
                      {{$isencao->motivoRejeicao}}
                </span>
              </a> -->
            </div>
          @endif
        @else
          <a style="font-weight: bold">Processando</a>
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
  </div><!-- END Isenção -->

  <div class="card text-center " style="border-radius: 20px"> <!-- Recurso Isenção -->

    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2"style="font-weight: bold">Recurso Isenção</h2>

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
    @if(!is_null($recursoIsencao))
      <div class="container justify-content-center card-lmts-options">
        <h5>
          Status do Recurso: <br>
          @if($recursoIsencao != 'processando')
            @if($recursoIsencao->homologado == 'aprovado')
              <a style="font-weight: bold;color: green">Aprovado</a>
            @elseif($recursoIsencao->homologado == 'nao')
              <a style="font-weight: bold">Processando</a>
            @else
            <div class="hover-popup-lmts">
              <a style="font-weight: bold; color: red">Indeferido</a> <br>
              <a style="font-weight: bold">Justificativa:</a> <br>
              <a> {{$recursoIsencao->motivoRejeicao}} </a>
              <!-- <a style="color:white">
                <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}"/>
                <span style="background-color: lightgray; color: black; border-radius: 5px; padding: 5px; size: 5rem" >
                    <b style="font-weight: bold">Motivo</b>
                    <br>
                      {{$recursoIsencao->motivoRejeicao}}
                </span>
              </a> -->
            </div>
            @endif
          @else
            <a style="font-weight: bold">Processando</a>
          @endif
        </h5>
      </div>
    @endif

    <div class="container justify-content-center" style="padding: 10px" >
      <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Recurso -->

          <input type="hidden" name="editalId" value="{{$edital->id}}">
          <input type="hidden" name="tipo" value="requerimentoDeRecurso">
          <input type="hidden" name="tipoRecurso" value="taxa" >
          @if(is_null($recursoIsencao) && !is_null($isencao))
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
  </div> <!-- END Recurso Isenção -->

  <div class="card text-center " style="border-radius: 20px;">   <!-- Inscrição -->
      <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
          <h2 class="h2"style="font-weight: bold">Inscrição</h2>

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
       @if(!is_null($inscricao))
        <div class="container justify-content-center card-lmts-options">
          <h5>
            Status da Inscrição: <br>
            @if($inscricao != 'processando')
              @if($inscricao->homologado == 'aprovado')
                @if($inscricao->homologadoDrca == 'aprovado')
                  <a style="font-weight: bold;color: green">Aprovado</a>
                @elseif($inscricao->homologadoDrca == 'nao')
                  <a style="font-weight: bold">Processando</a>
                @else
                  <div>
                    <a style="font-weight: bold; color: red">Indeferido</a> <br>
                    <a style="font-weight: bold">Justificativa:</a> <br>
                    <a> {{$inscricao->motivoRejeicao}} </a>
                    <!-- <a style="color:white">
                      <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}" />
                      <span style="background-color: lightgray; color: black; border-radius: 5px; padding: 5px; size: 5rem" >
                          <b style="font-weight: bold">Motivo</b>
                          <br>
                          
                            {{$inscricao->motivoRejeicao}}
                      </span>
                    </a> -->
                  </div>
                @endif
              @elseif($inscricao->homologado == 'nao')
                <a style="font-weight: bold">Processando</a>
              @else
                <div class="hover-popup-lmts">
                  <a style="font-weight: bold; color: red">Indeferido</a> <br>
                  
                  <a style="font-weight: bold">Justificativa:</a> <br>
                  <div class="justify-content-center" style="display:flex;"> {{$inscricao->motivoRejeicao}} </div>

                  <!-- <a style="color:white">
                    <img src="{{asset('images/iconAjuda.png')}}" style="width: 20px"/>
                    <span style="background-color: lightgray; color: black; border-radius: 5px; padding: 5px; size: 5rem" >
                        <b style="font-weight: bold">Motivo</b>
                        <br>
                          {{$inscricao->motivoRejeicao}}
                    </span>
                  </a> -->
                </div>
              @endif
            @else
              <a style="font-weight: bold">Processando</a>
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
  </div><!-- END Inscrição -->

  <div class="card text-center " style="border-radius: 20px">   <!-- Recuso Inscrição -->

       <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 class="h2"style="font-weight: bold">Recurso Inscrição</h2>

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
       @if(!is_null($recursoInscricao))
         <div class="container justify-content-center card-lmts-options">
           <h5>
             Status do Recurso: <br>
             @if($recursoInscricao != 'processando')
               @if($recursoInscricao->homologado == 'aprovado')
                 <a style="font-weight: bold;color: green">Aprovado</a>
               @elseif($recursoInscricao->homologado == 'nao')
                 <a style="font-weight: bold">Processando</a>
               @else
                 <div class="hover-popup-lmts">
                   <a style="font-weight: bold; color: red">Indeferido</a> <br>
                   <a style="font-weight: bold">Justificativa:</a> <br>
                   <a> {{$inscricao->motivoRejeicao}} </a>
                   <!-- <a style="color:white">
                     <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}" />
                     <span style="background-color: lightgray; color: black; border-radius: 5px; padding: 5px; size: 5rem" >
                         <b style="font-weight: bold">Motivo</b>
                         <br>
                           {{$recursoInscricao->motivoRejeicao}}
                     </span>
                   </a> -->
                 </div>
               @endif
              @else
                <a style="font-weight: bold">Processando</a>
              @endif
           </h5>
         </div>
       @endif

       <div class="container justify-content-center" style="padding: 10px" >
         <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Recurso -->

             <input type="hidden" name="editalId" value="{{$edital->id}}">
             <input type="hidden" name="tipo" value="requerimentoDeRecurso">
             <input type="hidden" name="tipoRecurso" value="classificacao" >
             @if(is_null($recursoInscricao) && !is_null($inscricao))
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
  </div><!-- END Recuso Inscrição -->

  <div class="card text-center " style="border-radius: 20px"> <!-- Recurso Resultado -->

    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2"style="font-weight: bold">Recurso Resultado</h2>

    </div>

    <div class="card-header d-flex justify-content-center">
        <h5>
         Aberto de: <br>
           <a style="font-weight: bold">
             {{date_format(date_create($edital->inicioRecursoResultado), 'd/m/y')}}
           </a>
            até
           <a style="font-weight: bold">
             {{date_format(date_create($edital->fimRecursoResultado), 'd/m/y')}}
           </a>
        </h5>
    </div>
    @if(!is_null($recursoResultado))
      <div class="container justify-content-center card-lmts-options">
        <h5>
          Status do Recurso: <br>
          @if($recursoResultado != 'processando')
            @if($recursoResultado->homologado == 'aprovado')
              <a style="font-weight: bold;color: green">Aprovado</a>
            @elseif($recursoResultado->homologado == 'nao')
              <a style="font-weight: bold">Processando</a>
            @else
            <div class="hover-popup-lmts">
              <a style="font-weight: bold; color: red">Indeferido</a> <br>
              <a style="font-weight: bold">Justificativa:</a> <br>
              <a> {{$recursoResultado->motivoRejeicao}} </a>
              <!-- <a style="color:white">
                <img class="ajuda-lmts" src="{{asset('images/iconAjuda.png')}}"/>
                <span style="background-color: lightgray; color: black; border-radius: 5px; padding: 5px; size: 5rem" >
                    <b style="font-weight: bold">Motivo</b>
                    <br>
                      {{$recursoIsencao->motivoRejeicao}}
                </span>
              </a> -->
            </div>
            @endif
          @else
            <a style="font-weight: bold">Processando</a>
          @endif
        </h5>
      </div>
    @endif

    <div class="container justify-content-center" style="padding: 10px" >
      <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Recurso -->

          <input type="hidden" name="editalId" value="{{$edital->id}}">
          <input type="hidden" name="tipo" value="requerimentoDeRecurso">
          <input type="hidden" name="tipoRecurso" value="resultado" >
          @if(is_null($recursoResultado))
            @if($edital->inicioRecursoResultado <= $mytime)
              @if($edital->fimRecursoResultado >= $mytime)
                <button type="submit" class="btn btn-primary btn-primary-lmts" >
                    {{ __('Preencher formulário') }}
                </button>
              @endif
            @endif
          @endif
      </form>
    </div>
  </div><!--END Recurso Resultado -->

</div><!-- END CARDS -->

<!-- Quebra de linha para footer -->
<br>
<br>
<br>


@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif



@endsection
