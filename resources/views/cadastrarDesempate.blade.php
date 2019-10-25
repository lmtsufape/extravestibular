@extends('layouts.app')
@section('titulo','Desempate')
@section('navbar')
    <!-- Home / Detalhes do edital / Desempate-->
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
      <a class="nav-link" href="detalhes" style="color: black" onclick="event.preventDefault(); document.getElementById('detalhesEdital').submit();" >
        {{ __('Detalhes do Edital')}}
      </a>
      @if(Auth::check())
        <form id="detalhesEdital" action="{{route('detalhesEdital')}}" method="GET" style="display: none;">
      @else
        <form id="detalhesEdital" action="{{route('detalhesEditalServidor')}}" method="GET" style="display: none;">
      @endif
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input type="hidden" name="mytime" value="{{$mytime}}">

        </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">Desempate</a>
    </li>
@endsection
@section('content')

<div class="container" >
  <form method="POST" action="{{route('cadastroDesempate')}}">
    @csrf
  <div class="column">
    <div class="card" style="width: 90rem; margin-left: -10rem;margin-top: 1rem"> <!-- head -->
      <div class="card-header">{{ __('Desempate') }}</div>
      <div class="card-body" >
          <div class="container" style="width: 70%;">
            @if($inscricoesManha->count() > 0)
              <div class="card" style=" margin-top: 1%;"> <!-- card manha -->
                  <div class="card-header">{{ __('Manhã') }}</div>
                  <div class="card-body">
                    @php $i = 0 @endphp
                    @foreach($inscricoesManha as $key)
                      <div class="container" style="width: 70%;">
                        <div class="form-check" style="margin-left: -25%; margin-top: 5%; font-size: 100%">
                          <input id="aprovadoManha" onclick="checkRadios(); changeHeaderColor('{{ 'Manha' . $i}}');" class="form-check-input" name="aprovadoManha" type="radio" value="{{$key->id}}" style="transform: scale(1.5%)">
                          <label class="form-check-label" for="exampleRadios1">
                            Aprovar Candidato
                          </label>
                        </div>
                        <div class="card" style="width: 100%;margin-top: -5%;"> <!-- inscricao1 -->
                          <div id="headerManha{{$i}}" class="card-header disabled-lmts">{{ $key->user->id }}</div>
                          <div class="titulo-tabela-lmts" style="width: 93%">
                            <h2>Dados do Candidato</h2>
                          </div>
                          <div class="card-body">
                              <table class="table table-ordered table-hover">
                                <tr>
                                  <th>Nome</th>
                                  <th>Download</th>
                                </tr>
                                <tr <?php if($key->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->historicoEscolar == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->curriculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="curriculo" >{{ __('Curriculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->curriculo ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->enem == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="enem" >{{ __('ENEM') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->enem ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                              </table>
                          </div>
                        </div>
                      </div>
                      @php $i++; @endphp
                    @endforeach
                  </div>
              </div>
            @endif
            @if($inscricoesTarde->count() > 0)
              <div class="card" style=" margin-top: 1%;"> <!-- card tarde -->
                  <div class="card-header">{{ __('Tarde') }}</div>
                  <div class="card-body">
                    @php $i = 0 @endphp
                    @foreach($inscricoesTarde as $key)
                      <div class="container" style="width: 70%;">
                        <div class="form-check" style="margin-left: -25%; margin-top: 5%; font-size: 100%">
                          <input class="form-check-input" name="aprovadoTarde" type="radio" value="{{$key->id}}" style="transform: scale(1.5%)">
                          <label class="form-check-label" for="exampleRadios1">
                            Aprovar Candidato
                          </label>
                        </div>
                        <div class="card" style="width: 100%;margin-top: -5%;"> <!-- inscricao1 -->
                          <div id="headerTarde{{$i}}" class="card-header disabled-lmts">{{ $key->user->id }}</div>
                          <div class="titulo-tabela-lmts" style="width: 93%">
                            <h2>Dados do Candidato</h2>
                          </div>
                          <div class="card-body">
                              <table class="table table-ordered table-hover">
                                <tr>
                                  <th>Nome</th>
                                  <th>Download</th>
                                </tr>
                                <tr <?php if($key->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->historicoEscolar == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->curriculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="curriculo" >{{ __('Curriculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->curriculo ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->enem == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="enem" >{{ __('ENEM') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->enem ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                              </table>
                          </div>
                        </div>
                      </div>
                      @php $i++; @endphp
                    @endforeach
                  </div>
              </div>
            @endif
            @if($inscricoesNoite->count() > 0)
              <div class="card" style=" margin-top: 1%;"> <!-- card noite -->
                  <div class="card-header">{{ __('Noite') }}</div>
                  <div class="card-body">
                    @php $i = 0 @endphp
                    @foreach($inscricoesNoite as $key)
                      <div class="container" style="width: 70%;">
                        <div class="form-check" style="margin-left: -25%; margin-top: 5%; font-size: 100%">
                          <input class="form-check-input" name="aprovadoNoite" type="radio" value="{{$key->id}}" style="transform: scale(1.5%)">
                          <label class="form-check-label" for="exampleRadios1">
                            Aprovar Candidato
                          </label>
                        </div>
                        <div class="card" style="width: 100%;margin-top: -5%;"> <!-- inscricao1 -->
                          <div id="headerNoite{{$i}}" class="card-header disabled-lmts">{{ $key->user->id }}</div>
                          <div class="titulo-tabela-lmts" style="width: 93%">
                            <h2>Dados do Candidato</h2>
                          </div>
                          <div class="card-body">
                              <table class="table table-ordered table-hover">
                                <tr>
                                  <th>Nome</th>
                                  <th>Download</th>
                                </tr>
                                <tr <?php if($key->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->historicoEscolar == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->curriculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="curriculo" >{{ __('Curriculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->curriculo ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->enem == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="enem" >{{ __('ENEM') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->enem ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                              </table>
                          </div>
                        </div>
                      </div>
                      @php $i++; @endphp
                    @endforeach
                  </div>
              </div>
            @endif
            @if($inscricoesIntegral->count() > 0)
              <div class="card" style=" margin-top: 1%;"> <!-- card integral -->
                  <div class="card-header">{{ __('Integral') }}</div>
                  <div class="card-body">
                    @php $i = 0 @endphp
                    @foreach($inscricoesIntegral as $key)
                      <div class="container" style="width: 70%;">
                        <div class="form-check" style="margin-left: -25%; margin-top: 5%; font-size: 100%">
                          <input class="form-check-input" name="aprovadoIntegral" type="radio" value="{{$key->id}}" style="transform: scale(1.5%)">
                          <label class="form-check-label" for="exampleRadios1">
                            Aprovar Candidato
                          </label>
                        </div>
                        <div class="card" style="width: 100%;margin-top: -5%;"> <!-- inscricao1 -->
                          <div id="headerIntegral{{$i}}" class="card-header disabled-lmts">{{ $key->user->id }}</div>
                          <div class="titulo-tabela-lmts" style="width: 93%">
                            <h2>Dados do Candidato</h2>
                          </div>
                          <div class="card-body">
                              <table class="table table-ordered table-hover">
                                <tr>
                                  <th>Nome</th>
                                  <th>Download</th>
                                </tr>
                                <tr <?php if($key->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->historicoEscolar == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->curriculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="curriculo" >{{ __('Curriculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->curriculo ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->enem == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="enem" >{{ __('ENEM') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->enem ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                              </table>
                          </div>
                        </div>
                      </div>
                      @php $i++; @endphp
                    @endforeach
                  </div>
              </div>
            @endif
            @if($inscricoesEspecial->count() > 0)
              <div class="card" style=" margin-top: 1%;"> <!-- card especial -->
                  <div class="card-header">{{ __('Especial') }}</div>
                  <div class="card-body">
                    @php $i = 0 @endphp
                    @foreach($inscricoesEspecial as $key)
                      <div class="container" style="width: 70%;">
                        <div class="form-check" style="margin-left: -25%; margin-top: 5%; font-size: 100%">
                          <input class="form-check-input" name="aprovadoEspecial" type="radio" value="{{$key->id}}" style="transform: scale(1.5%)">
                          <label class="form-check-label" for="exampleRadios1">
                            Aprovar Candidato
                          </label>
                        </div>
                        <div class="card" style="width: 100%;margin-top: -5%;"> <!-- inscricao1 -->
                          <div id="headerEspecial{{$i}}" class="card-header disabled-lmts">{{ $key->user->id }}</div>
                          <div class="titulo-tabela-lmts" style="width: 93%">
                            <h2>Dados do Candidato</h2>
                          </div>
                          <div class="card-body">
                              <table class="table table-ordered table-hover">
                                <tr>
                                  <th>Nome</th>
                                  <th>Download</th>
                                </tr>
                                <tr <?php if($key->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->historicoEscolar == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->curriculo == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="curriculo" >{{ __('Curriculo') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->curriculo ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                                <tr <?php if($key->enem == ''){echo('style="display: none"');} ?> >
                                  <td>
                                    <label for="enem" >{{ __('ENEM') }}</label>
                                  </td>
                                  <td>
                                    <a href="{{ route('download', ['file' => $key->enem ])}}" target="_blank">Abrir arquivo</a>
                                  </td>
                                </tr>
                              </table>
                          </div>
                        </div>
                      </div>
                      @php $i++; @endphp
                    @endforeach
                  </div>
              </div>
            @endif
          </div>
      </div>
    </div>
  </div>
  <div class="form-group row mb-0 justify-content-center">
    <div class="row" style="margin-top: 10px; padding-bottom: 5rem">

      <input type="hidden" name="idsEmpatados" value="">
      <button id="buttonFinalizar" disabled type="submit" class="btn btn-primary btn-primary-lmts">
        {{ __('Finalizar') }}
      </button>

    </div>
  </div>
</div>
  </form>

@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif

<script type="text/javascript" >
  function checkRadios(){
    if(document.getElementById("aprovadoManha").checked == true){
      document.getElementById("buttonFinalizar").disabled = false;
    }
  }
  function changeHeaderColor(x){
    var str = "header";
    str = str.concat(x);
    document.getElementById(str).class = "card-header";
  }
</script>

@endsection
