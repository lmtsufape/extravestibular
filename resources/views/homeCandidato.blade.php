@extends('layouts.app')

@section('content')

<style type="text/css">

.hover_img a { position:relative; }
.hover_img a span { position:absolute; display:none; z-index:99; }
.hover_img a:hover span { display:block; height: 100px; width: 300px; overflow: visible;}


/* pagination */
.pagination > .active > li > a
{
    background-color: #2c4e8a;
    color: #1B2E4F;
}

.pagination > li > span
{
    background-color: #1B2E4F;
    color: #1B2E4F;
}

.pagination > li > a:focus,
.pagination > li > a:hover,
.pagination > li > span:focus,
.pagination > li > span:hover
{
    color: white;
    background-color: #2c4e8a;
    border-color: #d3e0e9;
}

.pagination > .active > a
{
    color: white;
    background-color: #1B2E4F;
    border: solid 1px #1B2E4F;
}

.pagination > .active > a:hover
{
    background-color: #1B2E4F;
    border: solid 1px #1B2E4F;
}






/*
<ul class="pagination" role="navigation">
  <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
    <span class="page-link" aria-hidden="true">
      &lsaquo;
    </span>
  </li>
  <li class="page-item active" aria-current="page">
    <span class="page-link">
      1
    </span>
  </li>
  <li class="page-item">
    <a class="page-link" href="http://extravestibular.site/home?page=2">
      2
    </a>
  </li>
  <li class="page-item">
    <a class="page-link" href="http://extravestibular.site/home?page=2" rel="next" aria-label="Next &raquo;">
      &rsaquo;
    </a>
  </li>
</ul> */


</style>

<div class="container" style="width: 100rem; margin-left: -50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 100rem;">
                <div class="card-header">Editais</div>

                <div class="card-body">
                  <table class="table table-ordered table-hover">
                    @foreach ($editais as $edital)
                    <tr>
                      <td   style="width: 45rem"> <!-- time line -->
                        <div class="hover_img">
                             <a>
                               <?php
                                 $nomeEdital = explode(".pdf", $edital->nome);
                                 echo ($nomeEdital[0]);
                                ?>
                               <span>
                                 <img src="<?php
                                  if($edital->inicioIsencao > $mytime){
                                    echo (asset('images/timeline1.png'));
                                  }

                                  if($edital->inicioIsencao <= $mytime){
                                    if($edital->fimIsencao >= $mytime){
                                      echo (asset('images/timeline2.png'));
                                    }
                                  }

                                  if($edital->inicioRecursoIsencao <= $mytime){
                                    if($edital->fimRecursoIsencao >= $mytime){
                                      echo (asset('images/timeline3.png'));
                                    }
                                  }

                                  if($edital->inicioInscricoes <= $mytime){
                                    if($edital->fimInscricoes >= $mytime){
                                      echo (asset('images/timeline4.png'));
                                    }
                                  }
                                  if($edital->inicioRecurso <= $mytime){
                                    if($edital->fimRecurso >= $mytime){
                                      echo (asset('images/timeline5.png'));
                                    }
                                  }
                                  if($edital->fimRecurso <= $mytime){
                                    echo (asset('images/timeline6.png'));
                                  }


                                 ?>" alt="image" height="140"/>
                               </span>
                             </a>

                         </div>
                      </td>

                      <td> <!-- Isenção -->
                        <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Isenção -->
                          @csrf
                          <input type="hidden" name="editalId" value="{{$edital->id}}">
                          <input type="hidden" name="tipo" value="requerimentoDeIsencao">

                          @if($edital->inicioIsencao<= $mytime)
                            @if($edital->fimIsencao >= $mytime)
                              <button type="submit" class="btn btn-primary btn-primary-lmts" >
                                {{ __('Isenção') }}
                              </button>
                          @else
                            <button type="submit" disabled class="btn btn-primary btn-primary-lmts " >
                              {{ __('Isenção') }}
                            </button>
                          @endif
                          @else
                            <button type="submit" disabled class="btn btn-primary btn-primary-lmts " >
                              {{ __('Isenção') }}
                            </button>
                          @endif
                        </form>
                      </td>

                      <td> <!-- Recurso -->
                        <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Recurso -->
                            @csrf
                            <input type="hidden" name="editalId" value="{{$edital->id}}">
                            <input type="hidden" name="tipo" value="requerimentoDeRecurso">
                            <input type="hidden" name="tipoRecurso" value="taxa" >

                            @if($edital->inicioRecursoIsencao <= $mytime)
                              @if($edital->fimRecursoIsencao >= $mytime)
                                <button type="submit" class="btn btn-primary btn-primary-lmts" >
                                    {{ __('Recurso Isenção') }}
                                </button>
                              @else
                              <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                                  {{ __('Recurso Isenção') }}
                              </button>
                              @endif
                            @else
                            <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                                {{ __('Recurso Isenção') }}
                            </button>
                            @endif
                        </form>
                      </td>

                      <td> <!-- Inscrição -->
                        <form method="GET" action="{{route('editalEscolhido')}}">  <!-- Inscrição -->
                            @csrf
                            <input type="hidden" name="editalId" value="{{$edital->id}}">
                            <input type="hidden" name="tipo" value="fazerInscricao">

                            @if($edital->inicioInscricoes <= $mytime)
                              @if($edital->fimInscricoes >= $mytime)
                                <button type="submit" class="btn btn-primary btn-primary-lmts" >
                                    {{ __('Inscrição') }}
                                </button>
                              @else
                              <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                                  {{ __('Inscrição') }}
                              </button>
                              @endif
                            @else
                            <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                                {{ __('Inscrição') }}
                            </button>
                            @endif
                        </form>
                      </td>

                      <td> <!-- Recurso -->
                        <form method="GET" action="{{route('editalEscolhido')}}"> <!-- Recurso -->
                            @csrf
                            <input type="hidden" name="editalId" value="{{$edital->id}}">
                            <input type="hidden" name="tipo" value="requerimentoDeRecurso">
                            <input type="hidden" name="tipoRecurso" value="classificacao" >

                            @if($edital->inicioRecurso <= $mytime)
                              @if($edital->fimRecurso >= $mytime)
                                <button type="submit" class="btn btn-primary btn-primary-lmts" >
                                    {{ __('Recurso Inscrição') }}
                                </button>
                              @else
                              <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                                  {{ __('Recurso Inscrição') }}
                              </button>
                              @endif
                            @else
                            <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                                {{ __('Recurso Inscrição') }}
                            </button>
                            @endif
                        </form>
                      </td>
                      <td> <!-- Download -->
                      <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_new">Download</a>
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
