@extends('layouts.app')
@section('titulo','Classificar Inscrição')
@section('navbar')
    Classificar Inscrição
@endsection
@section('content')

<div class="container">
<div class="row justify-content-center">
  <form method="POST" action={{ route('cadastroClassificacao') }} enctype="multipart/form-data">
    @csrf
  <div class="col-md-8">
    <div class="card" style="width: 50rem">
      <div class="card-header">{{ __('Classificar Inscrição') }}</div>
      <div class="card-body">
        <div class="form-group row" >
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
        </div>
        <div >
        <label for="coeficienteDeRendimento" class="field a-field a-field_a2 page__field">
            <input id="coeficienteDeRendimento" type="text" name="coeficienteDeRendimento" autofocus class="field__input a-field__input" placeholder="Coeficiente de Rendimento" >
            <span class="a-field__label-wrap">
              <span class="a-field__label">Coeficiente de Rendimento</span>
            </span>
        </label>
        <label for="materias" class="field a-field a-field_a2 page__field">
            <input id="materias" type="text" name="materias" autofocus class="field__input a-field__input" placeholder="Materias Necessarias">
            <span class="a-field__label-wrap">
              <span class="a-field__label">Materias Necessarias</span>
            </span>
        </label>
        <label for="completadas" class="field a-field a-field_a2 page__field">
            <input id="completadas" type="text" name="completadas" autofocus class="field__input a-field__input" placeholder="Materias Completas">
            <span class="a-field__label-wrap">
              <span class="a-field__label">Materias Completas</span>
            </span>
        </label>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-4">
            <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
            <button id="buttonFinalizar" type="submit" class="btn btn-primary btn-primary-lmts">
              {{ __('Finalizar') }}
            </button>

          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>


<script type="text/javascript" >
</script>
@endsection
