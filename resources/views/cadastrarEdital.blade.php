@extends('layouts.app')
@section('titulo','Novo Edital')
@section('navbar')
    Novo Edital
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Novo Edital') }}</div>

                <div class="card-body">

                      <div class="card-body">
                        <form method="POST" action={{ route('cadastroEdital') }} enctype="multipart/form-data">
                              @csrf
                          <?php
                            $i = 0;
                            foreach ($cursos as $curso):
                          ?>
                            <div class="form-group row" >
                                <label for="{{$curso['nome']}}" class="col-md-4 col-form-label text-md-right">{{ __($curso['nome'] . "/" . $curso['unidade']) }}</label>

                                <div class="col-md-6">
                                    <input onclick="vagas({{$i}})"  type="checkbox" value="{{$curso['id']}}">
                                    <input type="hidden" name="cursoId{{$i}}" value="{{$curso['id']}}">
                                    <label for="{{$i}}" class="field a-field a-field_a2 page__field">
                                        <input placeholder="Número de vagas" value="#" id="{{$i}}" type="text" name="{{$i}}" class="field__input a-field__input" style="width: 10rem; display: none;">
                                        <span class="a-field__label-wrap">
                                          <span class="a-field__label">Número de vagas</span>
                                        </span>
                                    </label>
                                </div>

                            </div>
                          <?php
                            $i++;
                            endforeach;
                          ?>

                          <div  class="form-group row justify-content-center" style="margin-left: 1px"> <!-- Isenção -->
                              <a style="font-weight: bold; margin-top: 22px;">{{__('Isenção: ')}}</a>
                              <label for="inicioIsencao" class="field a-field a-field_a2 page__field">
                                  <input id="inicioIsencao" type="date" name="inicioIsencao" autofocus class="field__input a-field__input" placeholder="Inicio da Isenção" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Inicio da Isenção</span>
                                  </span>
                              </label>
                              <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                              <label for="fimIsencao" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                                  <input id="fimIsencao" type="date" name="fimIsencao" autofocus class="field__input a-field__input" placeholder="Fim do Recurso" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Fim do Recurso</span>
                                  </span>
                              </label>
                          </div>

                          <div  class="form-group row justify-content-center" style="margin-left: -85px"> <!-- Recurso Isenção -->
                              <a style="font-weight: bold; margin-top: 22px;">{{__('Recurso da Isenção: ')}}</a>
                              <label for="inicioRecursoIsencao" class="field a-field a-field_a2 page__field">
                                  <input id="inicioRecursoIsencao" type="date" name="inicioRecursoIsencao" autofocus class="field__input a-field__input" placeholder="Inicio do Recurso da Isenção" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Inicio do Recurso da Isenção</span>
                                  </span>
                              </label>
                              <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                              <label for="fimRecursoIsencao" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                                  <input id="fimRecursoIsencao" type="date" name="fimRecursoIsencao" autofocus class="field__input a-field__input" placeholder="Fim do Recurso da Isenção:" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Fim do Recurso da Isenção:</span>
                                  </span>
                              </label>
                            </div>

                          <div  class="form-group row justify-content-center" > <!-- Inscrições -->
                              <a style="font-weight: bold; margin-top: 22px;">{{__(' Inscrições: ')}}</a>
                              <label for="inicioInscricoes" class="field a-field a-field_a2 page__field">
                                  <input id="inicioInscricoes" type="date" name="inicioInscricoes" autofocus class="field__input a-field__input" placeholder="Inicio das Inscrições" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Inicio das Inscrições</span>
                                  </span>
                              </label>
                              <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                              <label for="fimInscricoes" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                                  <input id="fimInscricoes" type="date" name="fimInscricoes" autofocus class="field__input a-field__input" placeholder="Fim das Inscrições" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Fim das Inscrições</span>
                                  </span>
                              </label>
                          </div>

                          <div  class="form-group row justify-content-center" style="margin-left: -90px"> <!-- Recurso -->
                              <a style="font-weight: bold; margin-top: 22px;">{{__('Recurso da Inscrição: ')}}</a>
                              <label for="inicioRecurso" class="field a-field a-field_a2 page__field">
                                  <input id="inicioRecurso" type="date" name="inicioRecurso" autofocus class="field__input a-field__input" placeholder="Inicio do Recurso" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Inicio do Recurso</span>
                                  </span>
                              </label>
                              <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                              <label for="fimRecurso" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                                  <input id="fimRecurso" type="date" name="fimRecurso" autofocus class="field__input a-field__input" placeholder="Fim do Recurso" style="width: 10rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Fim do Recurso</span>
                                  </span>
                              </label>
                          </div>


                          <div  class="form-group row" >  <!-- PDF -->
                              <label for="pdfEdital" class="col-md-4 col-form-label text-md-right" style="margin-left: -30px; margin-top: 20px;">{{ __('Arquivo do Edital:') }}</label>
                              <div class="col-md-6" style="margin-top: 20px;">
                                <div class="custom-file">
                                  <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="pdfEdital">
                                </div>
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <input type="hidden" name="nCursos" value="{{$i}}">
                                  <button type="submit" class="btn btn-primary btn-primary-lmts">
                                      {{ __('Cadastrar Novo Edital') }}
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
@endsection

    <script type="text/javascript" >
      function vagas(x) {
      	if (document.getElementById(String(x)).style.display == "none") {
          document.getElementById(String(x)).style.display = "";
          document.getElementById(String(x)).value = "";

      	}
        else{
          document.getElementById(String(x)).style.display = "none";
          document.getElementById(String(x)).value = "#";
        }

      }
    </script>
