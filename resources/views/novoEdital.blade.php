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
                                    <input placeholder="Número de vagas" style="display: none; width: 45%;" value="#" id="{{$i}}" type="text" name="{{$i}}">
                                </div>

                            </div>
                          <?php
                            $i++;
                            endforeach;
                          ?>


                          <div  class="form-group row" >
                              <label for="inicioInscricoes" class="col-md-4 col-form-label text-md-right">{{ __('Inicio das Inscrições:') }}</label>

                              <div class="col-md-6">
                                  <input type="date" name="inicioInscricoes" >
                              </div>
                          </div>

                          <div  class="form-group row" >
                              <label for="fimInscricoes" class="col-md-4 col-form-label text-md-right">{{ __('Fim das Inscrições:') }}</label>

                              <div class="col-md-6">
                                  <input type="date" name="fimInscricoes" >
                              </div>
                          </div>

                          <div  class="form-group row" >
                              <label for="inicioRecurso" class="col-md-4 col-form-label text-md-right">{{ __('Inicio do Recurso:') }}</label>

                              <div class="col-md-6">
                                  <input type="date" name="inicioRecurso" >
                              </div>
                          </div>

                          <div  class="form-group row" >
                              <label for="fimRecurso" class="col-md-4 col-form-label text-md-right">{{ __('Fim do Recurso:') }}</label>

                              <div class="col-md-6">
                                  <input type="date" name="fimRecurso" >
                              </div>
                          </div>

                          <div  class="form-group row" >
                              <label for="pdfEdital" class="col-md-4 col-form-label text-md-right">{{ __('Arquivo do Edital:') }}</label>

                              <div class="col-md-6">
                                  <input type="file" name="pdfEdital" >
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <input type="hidden" name="nCursos" value="{{$i}}">
                                  <button type="submit" class="btn btn-primary">
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
