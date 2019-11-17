@extends('layouts.app')
@section('titulo','Classificar Inscrição')
@section('navbar')
    <!-- Home / Detalhes do edital / Classificar Inscrição / {{$inscricao->user->dadosUsuario->cpf}} -->
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
      <a class="nav-link" style="color: black" href="classificar"
         onclick="event.preventDefault();
                       document.getElementById('classificar').submit();">
         {{ __('Classificar Inscrições') }}
      </a>
      <form id="classificar" method="GET" action="{{route('editalEscolhido')}}">
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input type="hidden" name="tipo" value="classificarInscricoes">
      </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">{{$inscricao->user->dadosUsuario->cpf}}</a>
    </li>


@endsection
@section('content')
<style>
  .card{
    width: 100%;
  }
</style>
<div class="container">
  <div class="row justify-content-center">
    <!-- titulo editais Abertos -->
    <div class="titulo-tabela-lmts">
      <h2>{{ __('Classificar Inscrição') }}</h2>
    </div><!-- end titulo editais Abertos -->
  </div>


  <form id="formCadastro" method="POST" action="{{ route('cadastroClassificacao') }}" enctype="multipart/form-data">
    @csrf

    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">Requisitos</div>
        <div class="card-body">
          <div class="row justify-content-center">
              <table class="table table-ordered table-hover">
                  <tr>
                    <th>Requisito</th>
                    <th>Dados</th>
                  </tr>
                  <tr <?php if($inscricao->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                    <div class="form-group row" >
                        <td>
                          <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                        </td>
                        <div class="col-md-6">
                            <td>
                              <a href="{{ route('download', ['file' => $inscricao->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                            </td>
                        </div>
                    </div>
                  </tr>
                  <tr <?php if($inscricao->historicoEscolar == ''){echo('style="display: none"');} ?> >
                    <div class="form-group row" >
                      <td>
                        <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                      </td>
                        <div class="col-md-6">
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                          </td>
                        </div>
                    </div>
                  </tr>
                  <tr <?php if($inscricao->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                    <div class="form-group row" >
                      <td>
                        <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                      </td>
                        <div class="col-md-6">
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                          </td>
                        </div>
                    </div>
                  </tr>
                  <tr <?php if($inscricao->curriculo == ''){echo('style="display: none"');} ?> >
                    <div class="form-group row" >
                      <td>
                        <label for="curriculo" >{{ __('Curriculo') }}</label>
                      </td>
                        <div class="col-md-6">
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->curriculo ])}}" target="_blank">Abrir arquivo</a>
                          </td>
                        </div>
                    </div>
                  </tr>
                  <tr <?php if($inscricao->enem == ''){echo('style="display: none"');} ?> >
                    <div class="form-group row" >
                      <td>
                        <label for="enem" >{{ __('ENEM') }}</label>
                      </td>
                        <div class="col-md-6">
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->enem ])}}" target="_blank">Abrir arquivo</a>
                          </td>
                        </div>
                    </div>
                  </tr >
                </table>
          </div><!-- end row -->
        </div><!-- end card-body -->
      </div><!-- end card -->
    </div><!-- end row-->

    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">Notas</div>
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-sm-4">
                <label for="nota" class="field a-field a-field_a2 page__field">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Antiga Nota</span>
                  </span>
                </label>
                <input disabled id="nota" type="text" name="nota" autofocus class="form-control @error('nota') is-invalid @enderror field__input a-field__input" placeholder="Antiga Nota"  value="{{ $inscricao->nota }}">
            </div>
          </div><!-- end row -->

          <div class="row justify-content-center">
              <div class="col-sm-4">
                  <label for="coeficienteDeRendimento" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Coeficiente de Rendimento</span>
                    </span>
                  </label>
                  <input id="coeficienteDeRendimento" type="text" name="coeficienteDeRendimento" autofocus class="form-control @error('coeficienteDeRendimento') is-invalid @enderror field__input a-field__input" placeholder="Coeficiente de Rendimento"  value="{{ old('coeficienteDeRendimento') }}">
                  @error('coeficienteDeRendimento')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              <div class="col-sm-4">
                <label for="materias" class="field a-field a-field_a2 page__field" style="margin-left: 20px">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nº Disciplinas Obrigatórias</span>
                    </span>
                  </label>
                  <input id="materias" type="text" name="materias" autofocus class="form-control @error('materias') is-invalid @enderror field__input a-field__input" placeholder="Nº Disciplinas Obrigatórias"  value="{{ old('materias') }}">
                @error('materias')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-sm-4">
                <label for="completadas" class="field a-field a-field_a2 page__field" style="margin-left: 20px">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nº Disciplinas Cursadas</span>
                    </span>
                  </label>
                  <input id="completadas" type="text" name="completadas" autofocus class="form-control @error('completadas') is-invalid @enderror field__input a-field__input" placeholder="Nº Disciplinas Cursadas" value="{{ old('completadas') }}">
                @error('completadas')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

          </div><!-- end row -->



        </div><!-- card-body -->
      </div><!-- end card-->
      <div class="row justify-content-center" style="margin-top:20px">
          <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
          <button id="buttonFinalizar" onclick="event.preventDefault();confirmar();" class="btn btn-primary btn-primary-lmts">
            {{ __('Finalizar') }}
          </button>
      </div>
    </div>
  </form>
</div><!-- end container -->




<script type="text/javascript" >
function confirmar(){
  if(confirm("Tem certeza que deseja finalizar?") == true) {
    document.getElementById("formCadastro").submit();
 }
}
</script>
@endsection
