@extends('layouts.app')
@section('titulo','Novo Edital')
@section('navbar')
    Novo Edital
@endsection
@section('content')

<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action={{ route('cadastroEdital') }} enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
            <div class="card" style="width: 70rem;"> <!-- Card Arquivo -->
                <div class="card-header">{{ __('Arquivo') }}</div>

                <div class="card-body">
                  <div class="card-body">
                          <div  class="form-group row justify-content-center" >  <!-- Nome do Edital -->
                            <label for="nome" class="field a-field a-field_a2 page__field" style="margin-left: 0px;">
                                <input id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Nome do edital" style="width: 50rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Nome do edital</span>
                                </span>
                            </label>

                          </div>

                          <div  class="form-group row justify-content-center" >  <!-- PDF -->
                            <label for="pdfEdital" class="col-md-4 col-form-label text-md-right" style="margin-left: -12rem; margin-top: 20px; font-weight: bold">{{ __('Arquivo do Edital:') }}</label>
                            <div class="col-md-6" style="margin-top: 20px;">
                              <div class="custom-file">
                                <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="pdfEdital">
                              </div>
                            </div>
                          </div>
                  </div>
                </div>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px"> <!-- Card Datas -->
                <div class="card-header">{{ __('Datas') }}</div>
                <div class="card-body">
                  <div class="card-body">
                    <div  class="form-group row justify-content-center" style="margin-top: 0rem; margin-left: 1px"> <!-- Isenção -->
                      <a style="font-weight: bold; margin-top: 22px;">{{__('Isenção: ')}}</a>
                      <label for="inicioIsencao" class="field a-field a-field_a2 page__field">
                        <input id="inicioIsencao" type="date" name="inicioIsencao" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Inicio da Isenção" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Inicio da Isenção</span>
                        </span>
                      </label>
                      <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                      <label for="fimIsencao" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                        <input id="fimIsencao" type="date" name="fimIsencao" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Fim do Recurso" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Fim do Recurso</span>
                        </span>
                      </label>
                    </div>

                    <div  class="form-group row justify-content-center" style="margin-left: -85px; margin-top: 3rem"> <!-- Recurso Isenção -->
                      <a style="font-weight: bold; margin-top: 22px;">{{__('Recurso da Isenção: ')}}</a>
                      <label for="inicioRecursoIsencao" class="field a-field a-field_a2 page__field">
                        <input id="inicioRecursoIsencao" type="date" name="inicioRecursoIsencao" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Inicio do Recurso da Isenção" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Inicio do Recurso da Isenção</span>
                        </span>
                      </label>
                      <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                      <label for="fimRecursoIsencao" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                        <input id="fimRecursoIsencao" type="date" name="fimRecursoIsencao" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Fim do Recurso da Isenção:" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Fim do Recurso da Isenção:</span>
                        </span>
                      </label>
                    </div>

                    <div  class="form-group row justify-content-center" style="margin-top: 3rem" > <!-- Inscrições -->
                      <a style="font-weight: bold; margin-top: 22px;">{{__(' Inscrições: ')}}</a>
                      <label for="inicioInscricoes" class="field a-field a-field_a2 page__field">
                        <input id="inicioInscricoes" type="date" name="inicioInscricoes" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Inicio das Inscrições" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Inicio das Inscrições</span>
                        </span>
                      </label>
                      <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                      <label for="fimInscricoes" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                        <input id="fimInscricoes" type="date" name="fimInscricoes" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Fim das Inscrições" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Fim das Inscrições</span>
                        </span>
                      </label>
                    </div>

                    <div  class="form-group row justify-content-center" style="margin-left: -90px; margin-top: 3rem"> <!-- Recurso -->
                      <a style="font-weight: bold; margin-top: 22px;">{{__('Recurso da Inscrição: ')}}</a>
                      <label for="inicioRecurso" class="field a-field a-field_a2 page__field">
                        <input id="inicioRecurso" type="date" name="inicioRecurso" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Inicio do Recurso" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Inicio do Recurso</span>
                        </span>
                      </label>
                      <a style="font-weight: bold; margin-top: 22px;margin-left: 20px;">{{__('até')}}</a>
                      <label for="fimRecurso" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                        <input id="fimRecurso" type="date" name="fimRecurso" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Fim do Recurso" style="width: 10rem;">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Fim do Recurso</span>
                        </span>
                      </label>
                    </div>

                  </div>
                </div>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px"> <!-- Card Cursos -->
                <div class="card-header">{{ __('Vagas por Curso') }}</div>
                <div class="card-body">
                  <div class="card-body">
                    <table class="table table-ordered table-hover justify-content-center">
                      <tr>
                        <th> Curso/Unidade </th>
                        <th> Vagas Disponíveis </th>
                        <th style="width: 15rem;"> Número de Vagas </th>
                      </tr>
                      <?php //cursos
                      $i = 0;
                      foreach ($cursos as $curso):
                      ?>
                      <tr>
                        <td>
                          {{ $curso['nome'] . "/" . $curso['unidade'] }}
                        </td>
                        <td>
                          <input onclick="vagas({{$i}})"  type="checkbox" value="{{$curso['id']}}">
                          <input type="hidden" name="cursoId{{$i}}" value="{{$curso['id']}}">
                        </td>
                        <td>
                          <label for="{{$i}}" class="field a-field a-field_a2 page__field" id="label{{$i}}" style="display: none; margin-top: -10px" >
                            <input value="#" id="{{$i}}" type="text" name="{{$i}}" class="field__input a-field__input" style="width: 10rem; display: none;">
                          </label>
                        </td>
                      </tr>
                      <?php
                      $i++;
                      endforeach;
                      ?>
                  </table>

                  </div>
                </div>
            </div>

            <div class="form-group row mb-0 justify-content-center"> <!-- button -->
                <div class="col-md-8 offset-md-4">
                    <input type="hidden" name="nCursos" value="{{$i}}">
                    <button type="submit" class="btn btn-primary btn-primary-lmts"  style="margin-top: 20px; margin-left: 15rem">
                        {{ __('Cadastrar Novo Edital') }}
                    </button>

                </div>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection

    <script type="text/javascript" >
      function vagas(x) {
        var str = "label";
        var res = str.concat(x);
      	if (document.getElementById(String(x)).style.display == "none") {
          document.getElementById(String(x)).style.display = "";
          document.getElementById(res).style.display = "";
          document.getElementById(String(x)).value = "";

      	}
        else{
          document.getElementById(String(x)).style.display = "none";
          document.getElementById(res).style.display = "none";
          document.getElementById(String(x)).value = "#";
        }

      }
    </script>
