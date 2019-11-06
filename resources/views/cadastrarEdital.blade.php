@extends('layouts.app')
@section('titulo','Novo Edital')
@section('navbar')
    <!-- Home / Novo Edital -->
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
      <a class="nav-link" >
        {{ __('Novo Edital')}}
      </a>

    </li>
@endsection
@section('content')

<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action={{ route('cadastroEdital') }} enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
          <!-- Arquivo -->
          <div class="titulo-tabela-lmts">
            <h2>Arquivo</h2>
          </div>
            <div class="card" style="width: 70rem;margin-top:10px;"> <!-- Card Arquivo -->


                <div class="card-body">
                  <div class="card-body">
                          <div  class="form-group row justify-content-center" >  <!-- Nome do Edital -->
                            <div>
                              <label for="nome" class="field a-field a-field_a2 page__field" style="margin-left: 0px;">
                                  <input value="{{ old('nome') }}"  id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Nome do edital*" style="width: 50rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Nome do edital*</span>
                                  </span>
                              </label>
                              @error('nome')
                              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror

                            </div>
                          </div>

                          <div  class="form-group row justify-content-center" >  <!-- PDF -->
                            <label for="pdfEdital" class="col-md-4 col-form-label text-md-right" style="margin-left: -12rem; margin-top: 20px; font-weight: bold">{{ __('Arquivo do Edital*:') }}</label>
                            <div class="col-md-6" style="margin-top: 20px;">
                              <div class="custom-file">
                                <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="pdfEdital">
                              </div>
                              @error('pdfEdital')
                              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div  class="form-group row justify-content-center" >  <!-- PDF -->
                            <label for="pdfEdital" class="col-md-4 col-form-label text-md-right" style="margin-left: -12rem; margin-top: -5px; font-weight: bold">{{ __('Publicar o Edital*:') }}</label>
                            <input name="publicado" type="checkbox" value="sim">
                          </div>
                  </div>
                </div>
            </div>


            <!-- Datas -->
            <div class="titulo-tabela-lmts">
              <h2>Datas</h2>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px"> <!-- Card Datas -->
                <div class="card-body justify-content-left">
                  <div class="card-body ">
                    <table class="table table-ordered table-hover justify-content-center">
                      <tr>
                        <th style="width: 40rem;"> Descrição </th>
                        <th> Data de Início </th>
                        <th> Data de Encerramento </th>
                      </tr>
                      <tr>
                        <td>
                          <a style="font-weight: bold;">{{__('Período de Isenção da Taxa de Inscrição*: ')}}</a>
                        </td>
                        <td>
                          <label for="inicioIsencao" class="field a-field a-field_a2 page__field">
                            <input value="{{ old('inicioIsencao') }}" id="inicioIsencao" type="date" name="inicioIsencao" autofocus class="form-control @error('inicioIsencao') is-invalid @enderror field__input a-field__input" style="width: 10rem; height:100%">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('inicioIsencao')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                        <td>
                          <label for="fimIsencao" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ old('fimIsencao') }}" id="fimIsencao" type="date" name="fimIsencao" autofocus class="form-control @error('fimIsencao') is-invalid @enderror field__input a-field__input" style="width: 10rem; height:100%">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('fimIsencao')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;margin-left: 25px;" >
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <a style="font-weight: bold;">{{__('Período de Recurso da Isenção da Taxa de Inscrição*: ')}}</a>
                        </td>
                        <td>
                          <label for="inicioRecursoIsencao" class="field a-field a-field_a2 page__field">
                            <input value="{{ old('inicioRecursoIsencao') }}" id="inicioRecursoIsencao" type="date" name="inicioRecursoIsencao" autofocus class="form-control @error('inicioRecursoIsencao') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('inicioRecursoIsencao')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                        <td>
                          <label for="fimRecursoIsencao" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ old('fimRecursoIsencao') }}" id="fimRecursoIsencao" type="date" name="fimRecursoIsencao" autofocus class="form-control @error('fimRecursoIsencao') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('fimRecursoIsencao')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;margin-left: 25px;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <a style="font-weight: bold;">{{__('Período de Inscrições*: ')}}</a>
                        </td>
                        <td>
                          <label for="inicioInscricoes" class="field a-field a-field_a2 page__field">
                            <input value="{{ old('inicioInscricoes') }}" id="inicioInscricoes" type="date" name="inicioInscricoes" autofocus class="form-control @error('inicioInscricoes') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('inicioInscricoes')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                        <td>
                          <label for="fimInscricoes" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ old('fimInscricoes') }}" id="fimInscricoes" type="date" name="fimInscricoes" autofocus class="form-control @error('fimInscricoes') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('fimInscricoes')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;margin-left: 25px;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <a style="font-weight: bold;">{{__('Período de Recurso da Inscrição*: ')}}</a>
                        </td>
                        <td>
                          <label for="inicioRecurso" class="field a-field a-field_a2 page__field">
                            <input value="{{ old('inicioRecurso') }}" id="inicioRecurso" type="date" name="inicioRecurso" autofocus class="form-control @error('inicioRecurso') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('inicioRecurso')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                        <td>
                          <label for="fimRecurso" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ old('fimRecurso') }}" id="fimRecurso" type="date" name="fimRecurso" autofocus class="form-control @error('fimRecurso') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('fimRecurso')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;margin-left: 25px;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <a style="font-weight: bold;">{{__('Data do Resultado Preliminar*: ')}}</a>
                        </td>
                        <td>
                        </td>
                        <td>
                          <label for="resultado" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ old('resultado') }}" id="fimRecurso" type="date" name="resultado" autofocus class="form-control @error('resultado') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('resultado')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;margin-left: 25px;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <a style="font-weight: bold;">{{__('Período do Recurso do Resultado*: ')}}</a>
                        </td>
                        <td>
                          <label for="inicioRecursoResultado" class="field a-field a-field_a2 page__field">
                            <input value="{{ old('inicioRecursoResultado') }}" id="inicioRecursoResultado" type="date" name="inicioRecursoResultado" autofocus class="form-control @error('inicioRecursoResultado') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('inicioRecursoResultado')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                        <td>
                          <label for="fimRecursoResultado" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ old('fimRecursoResultado') }}" id="fimRecurso" type="date" name="fimRecursoResultado" autofocus class="form-control @error('fimRecursoResultado') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('fimRecursoResultado')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;margin-left: 25px;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <a style="font-weight: bold;">{{__('Data do Resultado*: ')}}</a>
                        </td>
                        <td>
                        </td>
                        <td>
                          <label for="resultadoFinal" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ old('resultadoFinal') }}" id="fimRecurso" type="date" name="resultadoFinal" autofocus class="form-control @error('resultadoFinal') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label"></span>
                            </span>
                          </label>
                          @error('resultadoFinal')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;margin-left: 25px;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </td>
                      </tr>
                    </table>

                  </div>
                </div>
            </div>

            <!-- Vagas por Curso -->
            <div class="titulo-tabela-lmts">
              <h2>Vagas por Curso</h2>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px"> <!-- Card Cursos -->
                <div class="card-body">
                  <div class="card-body">
                    <table class="table table-ordered table-hover justify-content-center">
                      <tr>
                        <th> Campus </th>
                        <th> Departamento </th>
                        <th> Curso </th>
                        <th> Vagas Disponíveis </th>
                        <th style="width: 10rem;"> Manhã </th>
                        <th style="width: 10rem;"> Tarde </th>
                        <th style="width: 10rem;"> Noite </th>
                        <th style="width: 10rem;"> Integral </th>
                        <th style="width: 10rem;"> Especial </th>
                      </tr>
                      <?php //cursos
                      // dd($cursos);
                      $i = 1;

                      foreach ($cursos as $curso):

                      ?>
                      <tr>
                        <td>
                          {{ $curso['campus'] }}
                        </td>
                        <td>
                          {{ $curso['departamento'] }}
                        </td>
                        <td>
                          {{ $curso['nome'] }}
                        </td>
                        <td>
                          <input id="checkbox{{$i}}" onclick="vagas({{$i}})" name="checkbox{{$i}}"  type="checkbox" value="{{$curso['id']}}">
                        </td>
                        <td>
                          <label for="manha{{$i}}" class="field a-field a-field_a2 page__field" id="labelManha{{$curso['id']}}" style="display: none; margin-top: -10px" >
                            <input disabled value="#" id="manha{{$curso['id']}}" type="text" name="manha{{$i}}" class="field__input a-field__input" style="width: 5rem; display: none;">
                          </label>
                        </td>
                        <td>
                          <label for="tarde{{$i}}" class="field a-field a-field_a2 page__field" id="labelTarde{{$curso['id']}}" style="display: none; margin-top: -10px" >
                            <input disabled value="#" id="tarde{{$curso['id']}}" type="text" name="tarde{{$i}}" class="field__input a-field__input" style="width: 5rem; display: none;">
                          </label>
                        </td>
                        <td>
                          <label for="noite{{$i}}" class="field a-field a-field_a2 page__field" id="labelNoite{{$curso['id']}}" style="display: none; margin-top: -10px" >
                            <input disabled value="#" id="noite{{$curso['id']}}" type="text" name="noite{{$i}}" class="field__input a-field__input" style="width: 5rem; display: none;">
                          </label>
                        </td>
                        <td>
                          <label for="integral{{$i}}" class="field a-field a-field_a2 page__field" id="labelIntegral{{$curso['id']}}" style="display: none; margin-top: -10px" >
                            <input disabled value="#" id="integral{{$curso['id']}}" type="text" name="integral{{$i}}" class="field__input a-field__input" style="width: 5rem; display: none;">
                          </label>
                        </td>
                        <td>
                          <label for="especial{{$i}}" class="field a-field a-field_a2 page__field" id="labelEspecial{{$curso['id']}}" style="display: none; margin-top: -10px" >
                            <input disabled value="#" id="especial{{$curso['id']}}" type="text" name="especial{{$i}}" class="field__input a-field__input" style="width: 5rem; display: none;">
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

            <div class="form-group row mb-0 justify-content-center" style="padding-bottom: 5rem"> <!-- button -->
                <div class="col-md-8 offset-md-4">
                    <input type="hidden" name="nCursos" value="{{$i}}">
                    <button type="submit" class="btn btn-primary btn-primary-lmts"  style="height: 50px;width: 120px;margin-top: 20px; margin-left: 15rem; ">
                        {{ __('Finalizar') }}
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
        var str = "labelManha";
        var labelManha = str.concat(x);
        var str = "labelTarde";
        var labelTarde = str.concat(x);
        var str = "labelNoite";
        var labelNoite = str.concat(x);
        var str = "labelIntegral";
        var labelIntegral = str.concat(x);
        var str = "labelEspecial";
        var labelEspecial = str.concat(x);
        str = "manha";
        var manha = str.concat(x);
        str = "tarde";
        var tarde = str.concat(x);
        str = "noite";
        var noite = str.concat(x);
        str = "integral";
        var integral = str.concat(x);
        str = "especial";
        var especial = str.concat(x);
      	if (document.getElementById("checkbox" + x).checked == true) {
          document.getElementById(manha).style.display = "";
          document.getElementById(tarde).style.display = "";
          document.getElementById(noite).style.display = "";
          document.getElementById(integral).style.display = "";
          document.getElementById(especial).style.display = "";

          document.getElementById(labelManha).style.display = "";
          document.getElementById(labelTarde).style.display = "";
          document.getElementById(labelNoite).style.display = "";
          document.getElementById(labelIntegral).style.display = "";
          document.getElementById(labelEspecial).style.display = "";

          document.getElementById(manha).value = "";
          document.getElementById(tarde).value = "";
          document.getElementById(noite).value = "";
          document.getElementById(integral).value = "";
          document.getElementById(especial).value = "";

          document.getElementById(manha).disabled = "";
          document.getElementById(tarde).disabled = "";
          document.getElementById(noite).disabled = "";
          document.getElementById(integral).disabled = "";
          document.getElementById(especial).disabled = "";

      	}
        else{
          document.getElementById(manha).style.display = "none";
          document.getElementById(tarde).style.display = "none";
          document.getElementById(noite).style.display = "none";
          document.getElementById(integral).style.display = "none";
          document.getElementById(especial).style.display = "none";

          document.getElementById(labelManha).style.display = "none";
          document.getElementById(labelTarde).style.display = "none";
          document.getElementById(labelNoite).style.display = "none";
          document.getElementById(labelIntegral).style.display = "none";
          document.getElementById(labelEspecial).style.display = "none";

          document.getElementById(manha).value = "#";
          document.getElementById(tarde).value = "#";
          document.getElementById(noite).value = "#";
          document.getElementById(integral).value = "#";
          document.getElementById(especial).value = "#";

          document.getElementById(manha).disabled = "true";
          document.getElementById(tarde).disabled = "true";
          document.getElementById(noite).disabled = "true";
          document.getElementById(integral).disabled = "true";
          document.getElementById(especial).disabled = "true";
        }

      }
    </script>
