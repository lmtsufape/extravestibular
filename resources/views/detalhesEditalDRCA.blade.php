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


<div class="row justify-content-center" style="width: 97%; padding-top: 1%; margin-bottom:2%;">

  <!-- Isenção -->
  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">

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
  </div><!-- end Isenção -->

  <!-- Recurso Isenção -->
  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">

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

  </div><!-- end Recurso Isenção -->

  <!-- Inscrição -->
  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">

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
  </div><!-- end Inscrição -->

  <!-- Recuso Inscrição -->
  <div class="card text-center " style="border-radius: 20px;height: 22.5rem;">
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

  </div><!-- end Recuso Inscrição -->

  <!-- Classificação -->
  <div id="ultimo-card" class="card text-center " style="border-radius: 20px;height: 22.5rem;">
    <div class="card-header d-flex justify-content-center" style="background-color: white; margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
      <h2 class="h2" style="font-weight: bold">Classificação</h2>
    </div>
    <div class="card-header d-flex justify-content-center disabled-lmts">
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
  </div><!--end Classificação -->

</div><!-- end row CARDS -->


@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif



@endsection
