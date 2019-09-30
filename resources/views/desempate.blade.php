@extends('layouts.app')
@section('titulo','Desempate')
@section('navbar')
    Home / Detalhes do edital / Desempate
@endsection
@section('content')

<div class="container">
  <div class="column justify-content-center">
    <div class="card" style="width: 90rem; margin-left: -10rem;margin-top: 1rem"> <!-- head -->
      <div class="card-header">{{ __('Desempate') }}</div>
      <div class="card-body">
        <div class="card" style="width: 40rem"> <!-- inscricao1 -->
          <div class="card-header">{{ __('Candidato 1') }}</div>
          <div class="card-body">
            <div class="form-group row" >
              <table class="table table-ordered table-hover">
                <tr>
                  <th>Requisito</th>
                  <th>Dados</th>
                </tr>
                <tr <?php if($inscricao1->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao1->historicoEscolar == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao1->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao1->curriculo == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="curriculo" >{{ __('Curriculo') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->curriculo ])}}" target="_blank">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao1->enem == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="enem" >{{ __('ENEM') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->enem ])}}" target="_blank">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr >
              </table>
            </div>
            <div class="form-group row" style="padding-top: 1rem">
              <div style="width: 13rem">
                <label for="coeficienteDeRendimento" class="field a-field a-field_a2 page__field">
                  <input disabled id="coeficienteDeRendimento" type="text" name="coeficienteDeRendimento" autofocus class="form-control @error('coeficienteDeRendimento') is-invalid @enderror field__input a-field__input" placeholder="Coeficiente de Rendimento"  value="{{ $inscricao1->coeficienteDeRendimento }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Coeficiente de Rendimento</span>
                  </span>
                </label>
                @error('coeficienteDeRendimento')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div style="width: 13rem">
                <label for="materias" class="field a-field a-field_a2 page__field" style="margin-left: 20px">
                  <input disabled id="materias" type="text" name="materias" autofocus class="form-control @error('materias') is-invalid @enderror field__input a-field__input" placeholder="Nota Disciplinas"  value="{{$inscricao1->conclusaoDoCurso}}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Nota Disciplinas</span>
                  </span>
                </label>
                @error('materias')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div style="width: 13rem">
                <label for="completadas" class="field a-field a-field_a2 page__field" style="margin-left: 20px">
                  <input disabled id="completadas" type="text" name="completadas" autofocus class="form-control @error('completadas') is-invalid @enderror field__input a-field__input" placeholder="Nota Final" value="{{$inscricao1->nota}}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Nota Final</span>
                  </span>
                </label>
                @error('completadas')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <form method="POST" action="{{route('cadastroDesempate')}}">
                @csrf
                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4" style="margin-top: 10px; margin-left: 14rem">
                    <input type="hidden" name="inscricaoAprovada" value="{{$inscricao1->id}}">
                    <input type="hidden" name="inscricaoClassificavel" value="{{$inscricao2->id}}">
                    <button id="buttonFinalizar" type="submit" class="btn btn-primary btn-primary-lmts">
                      {{ __('Aprovar Candidato') }}
                    </button>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card" style="width: 40rem; margin-left: 47.5rem; margin-top: -21.4rem"> <!-- inscricao1 -->
          <div class="card-header">{{ __('Candidato 2') }}</div>
          <div class="card-body">
            <div class="form-group row" >
              <table class="table table-ordered table-hover">
                <tr>
                  <th>Requisito</th>
                  <th>Dados</th>
                </tr>
                <tr <?php if($inscricao2->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao2->historicoEscolar == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao2->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao2->curriculo == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="curriculo" >{{ __('Curriculo') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->curriculo ])}}" target="_blank">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr>
                <tr <?php if($inscricao2->enem == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="enem" >{{ __('ENEM') }}</label>
                    </td>
                    <div class="col-md-6">
                      <td>
                        <a href="{{ route('download', ['file' => $inscricao1->enem ])}}" target="_blank">Abrir arquivo</a>
                      </td>
                    </div>
                  </div>
                </tr >
              </table>
            </div>
            <div class="form-group row" style="padding-top: 1rem">
              <div style="width: 13rem">
                <label for="coeficienteDeRendimento" class="field a-field a-field_a2 page__field">
                  <input disabled id="coeficienteDeRendimento" type="text" name="coeficienteDeRendimento" autofocus class="form-control @error('coeficienteDeRendimento') is-invalid @enderror field__input a-field__input" placeholder="Coeficiente de Rendimento"  value="{{ $inscricao2->coeficienteDeRendimento }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Coeficiente de Rendimento</span>
                  </span>
                </label>
                @error('coeficienteDeRendimento')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div style="width: 13rem">
                <label for="materias" class="field a-field a-field_a2 page__field" style="margin-left: 20px">
                  <input disabled id="materias" type="text" name="materias" autofocus class="form-control @error('materias') is-invalid @enderror field__input a-field__input" placeholder="Nota Disciplinas"  value="{{$inscricao2->conclusaoDoCurso}}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Nota Disciplinas</span>
                  </span>
                </label>
                @error('materias')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div style="width: 13rem">
                <label for="completadas" class="field a-field a-field_a2 page__field" style="margin-left: 20px">
                  <input disabled id="completadas" type="text" name="completadas" autofocus class="form-control @error('completadas') is-invalid @enderror field__input a-field__input" placeholder="Nota Final" value="{{$inscricao2->nota}}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Nota Final</span>
                  </span>
                </label>
                @error('completadas')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <form method="POST" action="{{route('cadastroDesempate')}}">
                @csrf
                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4" style="margin-top: 10px; margin-left: 14rem">
                    <input type="hidden" name="inscricaoAprovada" value="{{$inscricao2->id}}">
                    <input type="hidden" name="inscricaoClassificavel" value="{{$inscricao1->id}}">
                    <button id="buttonFinalizar" type="submit" class="btn btn-primary btn-primary-lmts">
                      {{ __('Aprovar Candidato') }}
                    </button>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif

<script type="text/javascript" >
</script>
@endsection
