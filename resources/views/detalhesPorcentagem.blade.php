@extends('layouts.app')
@section('titulo','Detalhes porcentagem')
@section('navbar')
    Home / Detalhes do edital / Detalhes porcentagem
@endsection
@section('content')

<style type="text/css">

</style>

<div class="tela-servidor ">
  <div class="centro-cartao" >
    <div class="card-deck d-flex justify-content-center">
      <div class="conteudo-central d-flex justify-content-center"  style="width: 100rem; display: ; padding-top: 1rem; padding-bottom: 1rem">  <!-- info porcentagem -->
  <div class="card cartao text-top " >    <!-- Info -->

   <div class="card-header d-flex justify-content-center" style="background-color: white;margin-top: 10px;">
     <h2 style="font-weight: bold">
      Detalhes
    </h2>

   </div>
   <table class="table table-ordered table-hover" style=" overflow: auto;">
     <tr style="background-color: #F7F7F7">
       <th> Curso </th>
       <th> Unidade </th>
       <th> Progresso </th>
       <th> Completas </th>
       <th> Pendentes </th>
     </tr>
     @for($i = 0; $i < sizeof($vagasInscricoesPorCurso); $i++)
      <tr>
        <td>{{$vagasInscricoesPorCurso[$i]['curso']}}</td>
        <td>{{$vagasInscricoesPorCurso[$i]['unidade']}}</td>
        <td>
          <?php
            $porcentagem = $vagasInscricoesPorCurso[$i]['classificadas'] * 100;
            if(($vagasInscricoesPorCurso[$i]['classificadas'] + $vagasInscricoesPorCurso[$i]['naoClassificadas'])>0){
              $porcentagem = $porcentagem / ($vagasInscricoesPorCurso[$i]['classificadas'] + $vagasInscricoesPorCurso[$i]['naoClassificadas']);
            }
            else{
              $porcentagem = 0;
            }
           ?>
           {{$porcentagem}}%
        </td>
        <td>{{$vagasInscricoesPorCurso[$i]['classificadas']}}</td>
        <td>{{$vagasInscricoesPorCurso[$i]['naoClassificadas']}}</td>
      </tr>
     @endfor
   </table>

  </div>
</div>
    </div>
  </div>
</div>




@endsection
