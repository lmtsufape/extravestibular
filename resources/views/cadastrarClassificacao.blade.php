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


<div class="container">
  <form id="formCadastro" method="POST" action="{{ route('cadastroClassificacao') }}" enctype="multipart/form-data">
    @csrf

    <div class="card">
      <div class="card-header">Classificar Inscrição</div>
      <div class="card-body" style="">
        <div class="row justify-content-center">
          <table  class="table table-ordered table-hover">
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
                <label for="historicoEscolar" >{{ __('Histórico Escolar') }}</label>
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
      </div><!-- end row tabela-->

      
      <div class="row justify-content-center" style="margin-top:30px">

        <div class="col-sm-4">
          <label for="coeficienteDeRendimento" class="field a-field a-field_a2 page__field">
              <span class="a-field__label-wrap">
                <span class="a-field__label">Coeficiente de Rendimento</span>
              </span>
          </label>
          <input id="coeficienteDeRendimento" type="text" name="coeficienteDeRendimento" autofocus class="form-control @error('coeficienteDeRendimento') is-invalid @enderror field__input a-field__input" placeholder="EX: 7.5"  value="{{ old('coeficienteDeRendimento') }}">
          @error('coeficienteDeRendimento')
          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="col-sm-4">
          <label for="totalDisciplinas" class="field a-field a-field_a2 page__field" >
              <!-- <input id="totalDisciplinas" type="text" name="totalDisciplinas" autofocus class="form-control @error('totalDisciplinas') is-invalid @enderror field__input a-field__input" placeholder="EX: 12"  value="{{ old('totalDisciplinas') }}"> -->
              <span class="a-field__label-wrap">
                <span class="a-field__label">Total de disciplinas aproveitadas do Curso de origem.</span>
              </span>
          </label>
          <input id="totalDisciplinas" type="text" name="totalDisciplinas" autofocus class="form-control @error('totalDisciplinas') is-invalid @enderror field__input a-field__input" placeholder="Total de disciplinas obrigatórias no Curso de origem."  value="{{ old('totalDisciplinas') }}">
          @error('totalDisciplinas')
          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>


      </div><!-- end row input -->
      </div><!-- end card-body-->
    </div><!-- end card-->

  <div class="row justify-content-center" style="margin-top:20px">
    <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
    <button onclick="event.preventDefault();confirmar();" id="buttonFinalizar" class="btn btn-primary btn-primary-lmts">
      {{ __('Finalizar') }}
    </button>

  </div>

</div><!-- end container-->
</form>


<script type="text/javascript" >
function confirmar(){
    if(confirm("Tem certeza que deseja finalizar?") == true) {
      document.getElementById("formCadastro").submit();
   }
  }

</script>
@endsection
