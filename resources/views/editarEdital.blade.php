@extends('layouts.app')
@section('titulo','Novo Edital')
@section('navbar')
    <!-- Home / Editar Edital / {{$edital->nome}} -->
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
      <a class="nav-link">Editar Edital</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">{{$edital->nome}}</a>
    </li>
@endsection
@section('content')

<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action="{{ route('cadastroEditarEdital') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
            <div class="card" style="width: 70rem;"> <!-- Card Arquivo -->
                <div class="card-header">{{ __('Arquivo') }}</div>


                <div class="card-body">
                  <div class="card-body">
                          <div  class="form-group row justify-content-center" >  <!-- Nome do Edital -->
                            <div>
                              <label for="nome" class="field a-field a-field_a2 page__field" style="margin-left: 0px;">
                                <?php
                                  $nomeEdital = explode(".pdf", $edital->nome);
                                 ?>
                                  <input id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Nome do edital*" style="width: 50rem;" value="{{$nomeEdital[0]}}">
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

                          <!-- row descricao -->
                          <div class="row justify-content-center">
                            <!-- descricao -->
                            <div class="col-sm-9">
                              <label for="descricao" class="field a-field a-field_a2 page__field" style="width: 100%;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Descrição do edital*</span>
                                </span>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" form="formCadastro" name="descricao" id="taid" style="width:100%" >{{ $edital->descricao }}</textarea>                
                              </label>
                              @error('descricao')
                              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div><!-- end descricao -->
                          </div><!-- end row descricao -->

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
                            <input name="publicado" type="checkbox" value="Si">
                          </div>
                  </div>
                </div>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px"> <!-- Card Datas -->
                <div class="card-header">{{ __('Datas') }}</div>
                <div class="card-body">
                  <div class="card-body justify-content-center">
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
                            <input value="{{ $edital->inicioIsencao }}" id="inicioIsencao" type="date" name="inicioIsencao" autofocus class="form-control @error('inicioIsencao') is-invalid @enderror field__input a-field__input" style="width: 10rem; height:100%">
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
                            <input value="{{ $edital->fimIsencao }}" id="fimIsencao" type="date" name="fimIsencao" autofocus class="form-control @error('fimIsencao') is-invalid @enderror field__input a-field__input" style="width: 10rem; height:100%">
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
                            <input value="{{ $edital->inicioRecursoIsencao }}" id="inicioRecursoIsencao" type="date" name="inicioRecursoIsencao" autofocus class="form-control @error('inicioRecursoIsencao') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
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
                            <input value="{{ $edital->fimRecursoIsencao }}" id="fimRecursoIsencao" type="date" name="fimRecursoIsencao" autofocus class="form-control @error('fimRecursoIsencao') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
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
                            <input value="{{ $edital->inicioInscricoes }}" id="inicioInscricoes" type="date" name="inicioInscricoes" autofocus class="form-control @error('inicioInscricoes') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
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
                            <input value="{{ $edital->fimInscricoes }}" id="fimInscricoes" type="date" name="fimInscricoes" autofocus class="form-control @error('fimInscricoes') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
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
                            <input value="{{ $edital->inicioRecurso }}" id="inicioRecurso" type="date" name="inicioRecurso" autofocus class="form-control @error('inicioRecurso') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
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
                            <input value="{{ $edital->fimRecurso }}" id="fimRecurso" type="date" name="fimRecurso" autofocus class="form-control @error('fimRecurso') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
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
                          <a style="font-weight: bold;">{{__('Data do Resultado*: ')}}</a>
                        </td>
                        <td>
                        </td>
                        <td>
                          <label for="resultado" class="field a-field a-field_a2 page__field" style="margin-left: 25px;">
                            <input value="{{ $edital->resultado }}" id="fimRecurso" type="date" name="resultado" autofocus class="form-control @error('resultado') is-invalid @enderror field__input a-field__input"  style="width: 10rem;">
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
                    </table>

                  </div>
                </div>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px"> <!-- Card Cursos -->
                <div class="card-header">{{ __('Vagas por Curso') }}</div>
                <div class="card-body">
                  <div class="card-body">
                    <table class="table table-ordered table-hover justify-content-center">
                      <tr>
                        <th> Curso </th>
                        <th> Departamento </th>
                        <th> Vagas Disponíveis </th>
                        <th style="width: 15rem;"> Número de Vagas </th>
                      </tr>
                      <?php //cursos
                      $i = 0;
                      foreach ($cursos as $curso):
                      ?>
                      <tr>
                        <td>
                          {{ $curso['nome'] }}
                        </td>
                        <td>
                          {{ $curso['departamento'] }}
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
                    <input type="hidden" name="editalId" value="{{$edital->id}}">
                    <button type="submit" class="btn btn-primary btn-primary-lmts"  style="margin-top: 20px; margin-left: 15rem">
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
