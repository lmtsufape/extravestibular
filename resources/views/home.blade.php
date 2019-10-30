@extends('layouts.app')
@section('titulo','Home')
@section('navbar')
  <li class="nav-item active">
    <a class="nav-link" style="color: black" href="{{ route('home') }}"
       onclick="event.preventDefault();
                     document.getElementById('VerEditais').submit();">
       {{ __('Home') }}
    </a>
    <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

    </form>
  </li>

@endsection
@section('content')

<style type="text/css">
</style>

<div class="container" style="width: 100%; background-color: ">
    <div class="row justify-content-center">
        <div class="col-md-0">
            <div class="card" style="width: 100vh;margin-left: 0%;">
                @if(session('tipo') == 'PREG')
                  <div class="titulo-tabela-lmts" style="width: 95vh">
                    <h2>Editais Não Publicados</h2>
                  </div>
                  <div class="card-body">
                    <table class="table table-ordered table-hover">
                      <tr style="background-color: #F7F7F7">
                        <th style="width: 50%"> Nome</th><?php $editaisAbertosFlag = false;?>
                        <th> Excluir </th>
                        <th> Publicar </th>
                        <th> Editar </th>
                        <th style="width: 8rem"> Arquivo </th>
                      </tr>
                      @foreach($editaisNaoPublicados as $edital)
                        <tr>
                          <td style="width: 50%">
                            <?php
                              $nomeEdital = explode(".pdf", $edital->nome);
                              echo ($nomeEdital[0]);
                             ?>
                          </td>
                          <td>
                            <a href="{{ route('apagarEdital') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('apagarEdital-form').submit();">
                               {{ __('Excluir') }}
                            </a>
                            <form id="apagarEdital-form" action="{{ route('apagarEdital') }}" method="post" style="display: none;">
                              @csrf
                              <input type="hidden" name="editalId" value="{{$edital->id}}">
                            </form>

                          </td>
                          <td>
                            <a href="{{ route('publicarEdital') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('publicarEdital-form').submit();">
                               {{ __('Publicar') }}
                            </a>
                            <form id="publicarEdital-form" action="{{ route('publicarEdital') }}" method="post" style="display: none;">
                              @csrf
                              <input type="hidden" name="editalId" value="{{$edital->id}}">
                            </form>

                          </td>
                          <td>
                            <a href="/editarEdital/{{$edital->nome}}"
                               onclick="event.preventDefault();
                                             document.getElementById('editarEdital-form').submit();">
                               {{ __('Editar') }}
                            </a>
                            <form id="editarEdital-form" action="{{route('editarEdital')}}" method="GET" style="display: none;">

                              <input type="hidden" name="editalId" value="{{$edital->id}}">
                            </form>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_new">Baixar Edital</a>
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                @endif
                <div class="titulo-tabela-lmts" style="width: 95vh">
                  <h2>Editais Abertos</h2>
                </div>
                <div class="card-body">
                  <table class="table table-ordered table-hover">
                    <?php $editaisAbertos = true;
                          $editaisAbertosFlag = true;
                          $editaisFinalizadosFlag = true; ?>
                    @foreach ($editais as $edital)
                      <?php if($edital->resultadoFinal <= $mytime){
                        $editaisAbertos = false;
                      }
                      else{
                        $editaisAbertos = true;
                      }
                      ?>
                      @if($editaisAbertos)
                        @if($editaisAbertosFlag)
                          <tr style="background-color: #F7F7F7">
                            <th> Nome</th><?php $editaisAbertosFlag = false;?>
                            <th> Publicado em </th>
                            <th> Arquivo </th>
                          </tr>
                        @endif
                      @else
                        @if($editaisFinalizadosFlag)
                        </table>
                        </div>
                        <div class="titulo-tabela-lmts">
                          <h2>Editais Finalizados</h2>
                        </div>
                        <div class="card-body">
                        <table class="table table-ordered table-hover">
                          <tr style="background-color: #F7F7F7">
                            <th> Nome</th><?php $editaisFinalizadosFlag = false;?>
                            <th> Publicado em </th>
                            <th> Arquivo </th>
                          </tr>
                        @endif
                      @endif
                      <tr>

                        <td style="width: 60rem">
                          <div class="hover-popup-lmts">   <!-- time line  class="hover-popup-lmts"-->
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

                                elseif($edital->resultado <= $mytime){
                                  echo (asset('images/timeline6.png'));
                                }


                               ?>" alt="image" height="140"/>
                             </span>
                           </a>
                         @if(Auth::check())
                           <form id="detalhesEdital{{$edital->id}}" action="{{route('detalhesEdital')}}" method="GET" style="display: none;">
                         @else
                           <form id="detalhesEdital{{$edital->id}}" action="{{route('detalhesEditalServidor')}}" method="GET" style="display: none;">
                         @endif
                             <input type="hidden" name="editalId" value="{{$edital->id}}">
                             <input type="hidden" name="mytime" value="{{$mytime}}">

                           </form>
                          </div>
                        </td>
                        <td> <!-- data -->
                          <?php
                            $date = date_create($edital->dataPublicacao);
                           ?>
                          <a>{{ date_format($date , 'd/m/y')  }}</a>
                        </td>
                        <td> <!-- Download -->
                          <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_new">Baixar Edital</a>
                        </td>

                      </tr>
                    @endforeach

                  </table>
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
