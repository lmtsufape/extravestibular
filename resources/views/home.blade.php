@extends('layouts.app')
@section('titulo','Home')
@section('navbar')
    Home/
@endsection
@section('content')

  <style type="text/css">

  .hover_img a { position:relative; }
  .hover_img a span { position:absolute; display:none; z-index:99; }
  .hover_img a:hover span { display:block; height: 100px; width: 300px; overflow: visible;}





</style>

<div class="container" style="width: 100rem; margin-left: -50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 80rem;margin-left: 10rem;">
                <div class="card-header">Editais</div>

                <div class="card-body">
                  <table class="table table-ordered table-hover">
                    <?php $editaisAbertos = true;
                          $editaisAbertosFlag = true;
                          $editaisFinalizadosFlag = true; ?>
                    @foreach ($editais as $edital)
                      <?php if($edital->fimRecurso <= $mytime){
                        $editaisAbertos = false;
                      }
                      else{
                        $editaisAbertos = true;
                      }
                      ?>
                      @if($editaisAbertos)
                        @if($editaisAbertosFlag)
                          <tr>
                            <th> Editais Abertos</th><?php $editaisAbertosFlag = false;?>
                            <th> Publicado em </th>
                            <th> Arquivo </th>
                          </tr>
                        @endif
                      @else
                        @if($editaisFinalizadosFlag)
                          <tr>
                            <th> Editais finalizados</th><?php $editaisFinalizadosFlag = false;?>
                            <th> Publicado em </th>
                            <th> Arquivo </th>
                          </tr>
                        @endif
                      @endif
                      <tr>

                        <td style="width: 60rem">
                          <div class="hover_img">   <!-- time line  class="hover_img"-->
                           <a href="detalhes/{{$edital->nome}}" onclick="event.preventDefault(); document.getElementById('detalhesEdital{{$edital->id}}').submit();" >
                             <?php
                               $nomeEdital = explode(".pdf", $edital->nome);
                               echo ($nomeEdital[0]);
                              ?>
                             <span>
                               <img src="<?php
                                if($edital->inicioIsencao > $mytime){
                                  echo (asset('images/timeline1.png'));
                                }

                                elseif(($edital->inicioIsencao <= $mytime) && ($edital->fimIsencao >= $mytime)){
                                    echo (asset('images/timeline2.png'));
                                }

                                elseif(($edital->inicioRecursoIsencao <= $mytime) && ($edital->fimRecursoIsencao >= $mytime)){
                                    echo (asset('images/timeline3.png'));

                                }

                                elseif(($edital->inicioInscricoes <= $mytime) && ($edital->fimInscricoes >= $mytime)){
                                    echo (asset('images/timeline4.png'));

                                }
                                elseif(($edital->inicioRecurso <= $mytime) && ($edital->fimRecurso >= $mytime)){
                                    echo (asset('images/timeline5.png'));
                                }
                                elseif($edital->fimRecurso <= $mytime){
                                  echo (asset('images/timeline6.png'));
                                }


                               ?>" alt="image" height="140"/>
                             </span>
                           </a>
                           <form id="detalhesEdital{{$edital->id}}" action="detalhes/{{$edital->nome}}" method="GET" style="display: none;">
                             <input type="hidden" name="editalId" value="{{$edital->id}}">
                             <input type="hidden" name="mytime" value="{{$mytime}}">

                           </form>
                          </div>
                        </td>
                        <td> <!-- data -->
                        <a>{{date_format($edital->created_at, 'd/m/y')}}</a>
                        </td>
                        <td> <!-- Download -->
                        <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_new">Baixar Edital</a>
                        </td>

                      </tr>
                    @endforeach
                  <!-- Exemplo de botão danger dividido -->
            </div>
        </div>
    </div>
    <div class="col-md-8">
      {{ $editais->links() }}
    </div>
</div>
@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif



@endsection
