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

@media screen and (max-width: 576px) {

  .table{
    font-size: 75%;
    height: 100%;
    width: 100%;
  }

}

</style>

<div class="container">

  <!-- div contem as tabelas -->
  <div id="tabelas" class="col-sm-12" style="width: 100%;margin: auto; background-color: #white">
    @if(session('tipo') == 'PREG')
      <div class="row">
        <!-- Título: EDITAIS NÃO PUBLICADOS -->
        <div class="titulo-tabela-lmts">
          <h2>Editais Não Publicados</h2>
        </div>
        <table class="table table-ordered table-hover">
          <tr style="background-color: #F7F7F7">
            <th style="width: 60%"> Nome</th>
            <th style="width: 10%">  </th>
            <th style="width: 10%">  </th>
            <th style="width: 10%">  </th>
            <th style="width: 10%">  </th>
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
                <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_new">Baixar</a>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    @endif
    <div class="row">
      <!-- Título: EDITAIS ABERTOS -->
        <div class="titulo-tabela-lmts">
          <h2>Editais Abertos</h2>
        </div>
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
                    <th style="width: 55%"> Nome</th><?php $editaisAbertosFlag = false;?>
                    <th style="width: 15%"> Publicação </th>
                    <th style="width: 15%"> Arquivo </th>
                    <th style="width: 15%"> Erratas </th>
                  </tr>
                @endif
              @else
                @if($editaisFinalizadosFlag)
                </table>
                <div class="titulo-tabela-lmts">
                  <h2>Editais Finalizados</h2>
                </div>
                <table class="table table-ordered table-hover">
                  <tr style="background-color: #F7F7F7">
                    <th style="width: 55%"> Nome</th><?php $editaisFinalizadosFlag = false;?>
                    <th style="width: 15%"> Publicação </th>
                    <th style="width: 15%"> Arquivo </th>
                    <th style="width: 15%"> Erratas </th>
                  </tr>
                @endif
              @endif
              <tr>
                <td>
                   <a href="detalhes/{{$edital->nome}}" onclick="event.preventDefault(); document.getElementById('detalhesEdital{{$edital->id}}').submit();" >
                     <?php
                       $nomeEdital = explode(".pdf", $edital->nome);
                       echo ($nomeEdital[0]);
                      ?>
                   </a>
                 @if(Auth::check())
                   <form id="detalhesEdital{{$edital->id}}" action="{{route('detalhesEdital')}}" method="GET" style="display: none;">
                 @else
                   <form id="detalhesEdital{{$edital->id}}" action="{{route('detalhesEditalServidor')}}" method="GET" style="display: none;">
                 @endif
                     <input type="hidden" name="editalId" value="{{$edital->id}}">
                     <input type="hidden" name="mytime" value="{{$mytime}}">

                   </form>
                </td>
                <td> <!-- data -->
                  <?php
                    $date = date_create($edital->dataPublicacao);
                   ?>
                  <a>{{ date_format($date , 'd/m/y')  }}</a>
                </td>
                <td> <!-- Download -->
                  <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_new">Baixar</a>
                </td>
                <td style="overflow: auto;"> <!-- Download Errata -->
                  <?php $erratas = $edital->errata; ?>
                  @foreach($erratas as $key)
                    <a href="{{ route('download', ['file' => $key->arquivo])}}" target="_new">{{$key->nome}};</a>
                  @endforeach
                </td>
              </tr>
            @endforeach

          </table>
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
