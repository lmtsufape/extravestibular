@extends('layouts.app')
@section('titulo','Detalhes do Edital')
@section('navbar')
    <!-- Home / Detalhes do edital
   -->
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

@media screen and (max-width: 576px){
  #finalizarModal{
    margin-top: 40px;
  }
  .card{


  }
  .titulo-tabela-lmts {
    margin-right: 5%;

  }

}
</style>


<div class="container">

  <!-- row titulo -->
  <div class="row justify-content-center">

    <!-- Título do Edital -->
    <div class="titulo-tabela-lmts col-sm-12">
      <h2>
        <?php
         $nomeEdital = explode(".pdf", $edital->nome);
         echo ($nomeEdital[0]);
        ?>
      </h2>
    </div><!--end título edital -->
  </div> <!-- end row-->

  <!-- paragrafo-->
  <div class="row justify-content-center" style="margin-top:20px">

    <p class="col-sm-12">A Pró-Reitora de Ensino de Graduação torna público para conhecimento dos interessados que, no
    PERÍODO DE 29/05 a 05/06 DE 2019, estarão abertas às inscrições para o Processo Seletivo Extra que
    visa o preenchimento de vagas para Ingresso via Processo Seletivo Extra nos Cursos de Graduação no 2o
    semestre de 2019, de acordo com as normas regimentais da UFRPE (Resolução 410/2007; 354/2008;
    34/2008181/91)
    </p>
  </div> <!-- end paragrafo-->

  <!-- row Título erratas -->
  <div class="row justify-content-center">
    <div class="titulo-tabela-lmts col-sm-12">
        <h3>
          Erratas
        </h3>
    </div><!-- end Título erratas -->
  </div><!-- end row Título erratas -->



    @if($erratas->isNotEmpty())
      <div class="justify-content-center">
        <table class="table table-ordered table-hover">

          @foreach($erratas as $errata)
            <tr>
             <td>
               <a class="row" style="margin-left: 1%;font-weight: bold; font-size: 15px">{{$errata->nome}}</a>
               <a class="row" style="margin-left: 1%; font-size: 15px">{{$errata->descricao}}</a>
             </td>
            </tr>
          @endforeach
        </table>
      </div>
    @endif

</div><!-- end container-->

<!-- CARDS -->
<div class="row justify-content-center"  style="margin-bottom:50px;">

<!-- Isenção -->
  <div class="card text-center " style="border-radius: 20px; display:none;"><!-- opacity: 0 -->
    <!-- card-header -->
    <div class="card-header d-flex justify-content-center" style="background-color: white;margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
        <h2 style="font-weight: bold; color:#1E2B4F;">Isenção</h2>
    </div><!-- card-header -->
   <!-- card-body -->
   <div class="card-header d-flex justify-content-center">
       <h5 style="">
        Aberto de: <br>
          <a style="font-weight: bold">
            {{date_format(date_create($edital->inicioIsencao), 'd/m/y')}}
          </a>
           até
          <a style="font-weight: bold">
            {{date_format(date_create($edital->fimIsencao), 'd/m/y')}}
          </a>
       </h5>
   </div><!-- card-body -->


   <div class="container justify-content-center" style="padding: 10px" >  <!-- form Isenção -->

   </div>

  </div><!-- end Isenção -->

 <div class="card text-center "  style="border-radius: 20px;">   <!-- Inscrição -->
   <div class="card-header d-flex justify-content-center" style="background-color: white;margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
       <h2 style="font-weight: bold; color:#1B2E4F">Inscrição</h2>
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
   <div class="container justify-content-center" style="padding: 10px">
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
         <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada.</a>
        @endif
     </h4>
     <h5>

         Total de Inscrições: <a style="font-weight: bold">{{($inscricoesHomologadas + $inscricoesNaoHomologadas)}}.</a>

     </h5>
       <h5>
         Inscrições homologadas: <a style="font-weight: bold">{{$inscricoesHomologadas}}.</a>
       </h5>
       <h5>
         Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoHomologadas}}.</a>
       </h5>
   </div>
      <div class="container justify-content-center" style="padding: 10px" >
        <form method="GET" action="{{route('editalEscolhido')}}">

            <input type="hidden" name="editalId" value="{{$edital->id}}">
            <input type="hidden" name="tipo" value="homologarInscricoesReintegracao">

            @if($edital->inicioInscricoes<= $mytime)
              @if($edital->fimInscricoes >= $mytime)
                <button type="submit" class="btn btn-primary btn-primary-lmts" >
                    {{ __('Homologar Inscrições Reintegração') }}
                </button>
              @else
              <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                  {{ __('Homologar Inscrições Reintegração') }}
              </button>
              @endif
            @else
            <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                {{ __('Homologar Inscrições Reintegração') }}
            </button>
            @endif
        </form>
      </div>
  </div><!-- end inscrição-->

 <div class="card text-center " style="border-radius: 20px; opacity: 100; display:none;">    <!-- Isenção -->

   <div class="card-header d-flex justify-content-center" style="background-color: white;margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
       <h2 style="font-weight: bold; color:#1E2B4F;">Isenção</h2>
   </div><!-- card-header -->
  <!-- card-body -->
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

  <div class="container justify-content-center" style="padding: 10px" >  <!-- form Isenção -->

  </div>

</div><!-- end isenção-->

</div><!-- end CARDS -->



<!--
<div class="tela-servidor ">
  <div class="centro-cartao" >
    <div class="card-deck d-flex justify-content-center">
      <div class="conteudo-central d-flex justify-content-center"  style="width: 100rem">  <!-- info edital -->
<!--
        <div class="card cartao text-top " style="border-radius: 20px; height: 100%" >    <!-- Info -->
<!--
         <div class="card-header d-flex justify-content-center" style="margin-top: 0px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 style="font-weight: bold; color:white">
            <?php
             // $nomeEdital = explode(".pdf", $edital->nome);
             // echo ($nomeEdital[0]);
            ?>
          </h2>
         </div>
         <div class="card-body justify-content-center" style="height: 100%">
               <div class="card-body justify-content-center">
                 <p style="padding: 15px">
                  A Pró-Reitora de Ensino de Graduação torna público para conhecimento dos interessados que, no
                  PERÍODO DE 29/05 a 05/06 DE 2019, estarão abertas às inscrições para o Processo Seletivo Extra que
                  visa o preenchimento de vagas para Ingresso via Processo Seletivo Extra nos Cursos de Graduação no 2o
                  semestre de 2019, de acordo com as normas regimentais da UFRPE (Resolução 410/2007; 354/2008;
                  34/2008181/91)
                </p>

                 @if($erratas->isNotEmpty())
                   <div class="justify-content-center" style="padding-top: 2%">
                     <a style="font-size: 25px; font-weight: bold"> Erratas: </a>

                     <table class="table table-ordered table-hover">

                       @foreach($erratas as $errata)
                         <tr>
                          <td>
                            <a class="row" style="margin-left: 1%;font-weight: bold; font-size: 15px">{{$errata->nome}}</a>
                            <a class="row" style="margin-left: 1%; font-size: 15px">{{$errata->descricao}}</a>
                          </td>
                         </tr>
                       @endforeach
                     </table>
                   </div>
                 @endif
                 <!-- Button trigger modal -->
<!--                  <div  class="form-group row justify-content-center" style="padding-top: 1%;" >
                   <button type="button" class="btn btn-primary btn-primary-lmts" data-toggle="modal" data-target="#exampleModal">
                     Nova Errata
                   </button>
                 </div>
             </div>
         </div>
        </div>
      </div>
      <div class="conteudo-central d-flex justify-content-center" style="margin-top:20px;width: 80rem">  <!-- opções -->
<!--         <div class="card cartao text-center " style="border-radius: 20px; opacity: 0">    <!-- Isenção -->

<!--          <div class="card-body d-flex justify-content-center">
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

         <div class="container justify-content-center" style="padding: 10px" >  <!-- form Isenção -->

<!--        </div>

        </div>

        <div class="card cartao text-center " style="border-radius: 20px; opacity: 0">    <!-- Isenção -->

<!--          <div class="card-body d-flex justify-content-center">
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

         <div class="container justify-content-center" style="padding: 10px" >  <!-- form Isenção -->

<!--          </div>

        </div>

        <div class="card cartao text-center "  style="border-radius: 20px; height: 21rem">   <!-- Inscrição -->
<!--           <div class="card-header d-flex justify-content-center" style="background-color: white;margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
              <h2 style="font-weight: bold">Inscrição</h2>
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
          <div class="container justify-content-center" style="height: 8rem; background-color: #F7F7F7; padding: 10px">
            <h4>
              <?php
                // $porcentagem = $inscricoesHomologadas * 100;
                // if(($inscricoesHomologadas + $inscricoesNaoHomologadas)>0){
                //   $porcentagem = $porcentagem / ($inscricoesHomologadas + $inscricoesNaoHomologadas);
                // }
                // else{
                //   $porcentagem = 0;
                // }
               ?>
               @if(($inscricoesHomologadas + $inscricoesNaoHomologadas) > 0 )
                <a style="font-weight: bold">Etapa {{number_format($porcentagem, 0)}}% finalizada.</a>
               @endif
            </h4>
            <h5>

                Total de Inscrições: <a style="font-weight: bold">{{($inscricoesHomologadas + $inscricoesNaoHomologadas)}}.</a>

            </h5>
              <h5>
                Inscrições homologadas: <a style="font-weight: bold">{{$inscricoesHomologadas}}.</a>
              </h5>
              <h5>
                Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoHomologadas}}.</a>
              </h5>
          </div>
             <div class="container justify-content-center" style="padding: 10px" >
               <form method="GET" action="{{route('editalEscolhido')}}">

                   <input type="hidden" name="editalId" value="{{$edital->id}}">
                   <input type="hidden" name="tipo" value="homologarInscricoesReintegracao">

                   @if($edital->inicioInscricoes<= $mytime)
                     @if($edital->fimInscricoes >= $mytime)
                       <button type="submit" class="btn btn-primary btn-primary-lmts" >
                           {{ __('Homologar Inscrições Reintegração') }}
                       </button>
                     @else
                     <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                         {{ __('Homologar Inscrições Reintegração') }}
                     </button>
                     @endif
                   @else
                   <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                       {{ __('Homologar Inscrições Reintegração') }}
                   </button>
                   @endif
               </form>
             </div>
        </div>


        <div class="card cartao text-center " style="border-radius: 20px; opacity: 0">    <!-- Isenção -->

<!--          <div class="card-body d-flex justify-content-center">
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

         <div class="container justify-content-center" style="padding: 10px" >  <!-- form Isenção -->

<!--          </div>

        </div>
<     </div>
  </div>
</div> -->

@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif



@endsection
