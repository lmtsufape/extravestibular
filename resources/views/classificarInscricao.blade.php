@extends('layouts.app')
@section('titulo','Classificar Inscrição')
@section('navbar')
    Classificar Inscrição
@endsection
@section('content')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 5px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div class="container">
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">{{ __('Classificar Inscrição') }}</div>
      <div class="card-body">
        <div class="form-group row">
          <table>
            <tr>
              <th>Requisito</th>
              <th>Dados</th>
            </tr>
            <tr <?php if($inscricao->declaracaoDeVinculo    == ''){echo('style="display: none"');} ?> >
              <form method="POST" action={{ route('cadastroClassificacao') }} enctype="multipart/form-data">
                    @csrf
              <div class="form-group row" >
                  <td>
                    <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                  </td>
                  <div class="col-md-6">
                      <td>
                        <a href="{{ $declaracaoDeVinculo }}" target="_blank">Abrir arquivo</a>
                      </td>
                  </div>
              </div>
            </tr>
            <tr <?php if($inscricao->historicoEscolar       == ''){echo('style="display: none"');} ?> >
              <div class="form-group row" >
                <td>
                  <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                </td>
                  <div class="col-md-6">
                    <td>
                      <a href="{{ $historicoEscolar }}" target="_blank">Abrir arquivo</a>
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
                      <a href="{{ $programaDasDisciplinas }}" target="_blank">Abir arquivo</a>
                    </td>
                  </div>
              </div>
            </tr>
            <tr <?php if($inscricao->curriculo              == ''){echo('style="display: none"');} ?> >
              <div class="form-group row" >
                <td>
                  <label for="curriculo" >{{ __('Curriculo') }}</label>
                </td>
                  <div class="col-md-6">
                    <td>
                      <a href="{{ $curriculo }}" target="_blank">Abrir arquivo</a>
                    </td>
                  </div>
              </div>
            </tr>
            <tr <?php if($inscricao->enem                   == ''){echo('style="display: none"');} ?> >
              <div class="form-group row" >
                <td>
                  <label for="enem" >{{ __('ENEM') }}</label>
                </td>
                  <div class="col-md-6">
                    <td>
                      <a href="{{ $enem }}" target="_blank">Abrir arquivo</a>
                    </td>
                  </div>
              </div>
            </tr>
          </table>
        </div>
        <div class="form-group row" >
            <label for="coeficienteDeRendimento" class="col-md-4 col-form-label text-md-right" >{{ __('Coeficiente de Rendimento')}}</label>
            <div class="col-md-6">
              <input id="coeficienteDeRendimento" type="text" name="coeficienteDeRendimento" autofocus>
            </div>
        </div>
        <div class="form-group row" >
            <label for="materias" class="col-md-4 col-form-label text-md-right" >{{ __('Materias Necessarias')}}</label>
            <div class="col-md-6">
              <input id="materias" type="text" name="materias" autofocus>
            </div>
        </div>
        <div class="form-group row" >
            <label for="completadas" class="col-md-4 col-form-label text-md-right" >{{ __('Materias Completadas')}}</label>
            <div class="col-md-6">
              <input id="completadas" type="text" name="completadas" autofocus>
            </div>
        </div>
          <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                <button id="buttonFinalizar" type="submit" class="btn btn-primary">
                    {{ __('Finalizar') }}
                </button>

            </div>
          </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" >
</script>
@endsection
