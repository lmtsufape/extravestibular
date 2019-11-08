@extends('layouts.app')
@section('titulo','Homologar Inscrição')
@section('navbar')
    <!-- Home / Detalhes do edital / Homologar Inscrição / {{$inscricao->cpfCandidato}} -->
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

<div class="container" style="width: 100rem; padding-bottom: 5%">
    <div class="row justify-content-left">
        <div class="col-md-8">


                        <input style="display: none" onclick="selectCheck('aprovado')" checked id="selectDadosPessoaisAprovado" type="radio" name="radioDadosPessoais" value="aprovado">





            </div>
            <div class="card" style="width: 70rem; margin-top: 0px"> <!-- Dados Inscrição-->
              <div class="card-header">{{ __('Dados Inscrição') }}</div>
              <div class="card-body">
                <div class="form-group row" style="margin-left:12.2rem;">
                  <div class="form-group row">
                    <div class="form-group row justify-content-center " style="margin-left: 1rem">
                      <div>
                        <label for="Tipo de Matricula" class="field a-field a-field_a2 page__field" style="margin-left: -15rem">
                          <input disabled id="Tipo de Matricula" type="text" name="Curso Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Tipo de Matricula"  style="width: 67rem; " value="{{ $inscricao->tipo }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Tipo de Matricula</span>
                          </span>
                        </label>

                      </div>
                      <div>
                        <label for="Curso Pretendido" class="field a-field a-field_a2 page__field" style="margin-left: -15rem;margin-top: 10px;">
                          <input disabled id="Curso Pretendido" type="text" name="Curso Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Curso Pretendido"  style="width: 53rem;" value="{{ $curso }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Curso Pretendido</span>
                          </span>
                        </label>

                      </div>
                      <div>
                        <label for="Turno" class="field a-field a-field_a2 page__field" style=" margin-left: 30px; margin-top: 10px;">
                          <input disabled id="Turno" type="text" name="Turno" autofocus class="form-control field__input a-field__input" placeholder="Turno" style="width: 12rem;" value="{{ $inscricao->turno }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Turno</span>
                          </span>
                        </label>

                      </div>

                    </div>
                  </div>
                  <div class="form-group row justify-content-center" style="display: none;font-weight: bold; margin-left: 10rem; width: 60rem">

                    <div class="col-md-11">
                      <input onclick="selectCheck('aprovado')" checked id="selectInscricaoAprovado" type="radio" name="radioInscricao" value="aprovado"> Aprovado

                      <input onclick="selectCheck('rejeitado')" id="selectInscricaoRejeitado" type="radio" name="radioInscricao" value="rejeitado"> Rejeitado
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div styles="<?php if($tipo != 'homologacao'){ echo("display: none");} ?>">
              <div class="card" style="width: 70rem; margin-top: 0px"> <!--  Dados da Curso e Instituição de Origem' -->
                <div class="card-header">{{ __('Dados da Curso e Instituição de Origem') }}</div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="form-group row">    <!-- Curso de origem -->
                      <div class="form-group row justify-content-center " style="margin-left: 2rem">
                        <div>
                          <label for="Curso de Origem" class="field a-field a-field_a2 page__field">
                            <input disabled id="Curso de Origem" type="text" name="Curso de Origem" autofocus class="form-control field__input a-field__input" placeholder="Curso de Origem"  style="width: 66rem;" value="{{ $inscricao->cursoDeOrigem }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Curso de Origem</span>
                            </span>
                          </label>

                        </div>
                      </div>
                    </div>
                    <div class="form-group row">    <!-- instituicaoDeOrigem/natureza -->
                      <div class="form-group row justify-content-center " style="margin-left: 2rem">  <!-- Nome | CPF-->
                        <div>
                          <label for="Instituição de Origem" class="field a-field a-field_a2 page__field">
                            <input disabled id="Instituição de de Origem" type="text" name="Instituição de Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Instituição de de Origem"  style="width: 52rem;" value="{{ $inscricao->instituicaoDeOrigem }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Instituição de de Origem</span>
                            </span>
                          </label>

                        </div>
                        <div>
                          <label for="Natureza da IES" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                            <input disabled id="Natureza da IES" type="text" name="Natureza da IES" autofocus class="form-control field__input a-field__input" placeholder="Natureza da IES" style="width: 12rem;" value="{{ $inscricao->naturezaDaIes }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Natureza da IES</span>
                            </span>
                          </label>

                        </div>
                      </div>
                    </div>
                    <div class="form-group row justify-content-center" style="margin-left: 1rem">  <!-- Endereço/Nº -->
                      <div>
                        <label for="endereco" class="field a-field a-field_a2 page__field">
                          <input disabled id="endereco" type="text" name="endereco" autofocus class="form-control field__input a-field__input" placeholder="Endereço" style="width: 60rem; " value="{{ $inscricao->endereco }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Endereço</span>
                          </span>
                        </label>

                      </div>
                      <div>
                        <label for="num" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                          <input disabled id="num" type="text" name="num" autofocus class=" form-control field__input a-field__input" placeholder="Nº" style="width: 4rem;" value="{{ $inscricao->num }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Nº</span>
                          </span>
                        </label>

                      </div>
                    </div>
                    <div class="form-group row justify-content-center" style="margin-left: 1rem">  <!-- Bairro/Cidade/Uf -->
                      <div>
                        <label for="bairro" class="field a-field a-field_a2 page__field" >
                          <input disabled id="bairro" type="text" name="bairro" autofocus class=" form-control field__input a-field__input" placeholder="Bairro" style="width: 33rem;" value="{{ $inscricao->bairro }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Bairro</span>
                          </span>
                        </label>

                      </div>
                      <div>
                        <label for="cidade" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                          <input disabled id="cidade" type="text" name="cidade" autofocus class=" form-control field__input a-field__input" placeholder="Cidade" style="width: 25.5rem;" value="{{ $inscricao->cidade }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Cidade</span>
                          </span>
                        </label>

                      </div>
                      <div>
                        <label for="uf" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                          <input disabled id="uf" type="text" name="uf" autofocus class=" form-control field__input a-field__input" placeholder="UF" style="width: 4rem;" value="{{ $inscricao->uf }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">UF</span>
                          </span>
                        </label>

                      </div>
                    </div>
                    <div class="form-group row justify-content-center" style="font-weight: bold; margin-left: 23rem; width: 60rem; margin-top: 15px;">

                      <div class="col-md-11">
                        <input onclick="selectCheck('aprovado')" id="selectDadosDoCursoAprovado" type="radio" name="radioDadosDoCurso" value="aprovado"> Aprovado

                        <input onclick="selectCheck('rejeitado')" id="selectDadosDoCursoRejeitado"  type="radio" name="radioDadosDoCurso" value="rejeitado"> Rejeitado
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="card" style="width: 70rem; margin-top: 15px"> <!-- Documentos -->
                <div class="card-header">{{ __('Documentos') }}</div>
                <div class="card-body">
                  <div class="form-group row">
                    <table class="table table-ordered table-hover">
                      <tr>
                        <th>Requisito</th>
                        <th>Dados</th>
                        <th style="text-align: center">Aprovado</th>
                        <th style="text-align: center">Rejeitado</th>
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
                                <td style="text-align: center">
                                  <input onclick="selectCheck('aprovado')"  type="radio" name="radioDeclaracaoDeVinculo" id="selectDeclaracaoDeVinculoAprovado" <?php if($inscricao->declaracaoDeVinculo == ''){echo('checked="true"');} ?> >
                                </td>
                                <td style="text-align: center">
                                  <input onclick="selectCheck('rejeitado')"  type="radio" name="radioDeclaracaoDeVinculo" id="selectDeclaracaoDeVinculoRejeitado">
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
                              <td style="text-align: center">
                                <input onclick=<?php if($tipo == 'drca'){echo("selectCheckDRCA('aprovado')");}else{ echo("selectCheck('aprovado')");} ?>  type="radio" name="radioHistoricoEscolar" id="selectHistoricoEscolarAprovado" <?php if($inscricao->historicoEscolar == ''){echo('checked="true"');} ?> >
                              </td>
                              <td style="text-align: center">
                                <input onclick=<?php if($tipo == 'drca'){echo("selectCheckDRCA('rejeitado')");}else{ echo("selectCheck('rejeitado')");} ?>  type="radio" name="radioHistoricoEscolar" id="selectHistoricoEscolarRejeitado" >
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
                              <td style="text-align: center">
                                <input onclick="selectCheck('aprovado')"  type="radio" name="radioProgramaDasDisciplinas" id="selectProgramaDasDisciplinasAprovado" <?php if($inscricao->programaDasDisciplinas == ''){echo('checked="true"');} ?> >
                              </td>
                              <td style="text-align: center">
                                <input onclick="selectCheck('rejeitado')"  type="radio" name="radioProgramaDasDisciplinas" id="selectProgramaDasDisciplinasRejeitado">
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
                              <td style="text-align: center">
                                <input onclick="selectCheck('aprovado')"  type="radio" name="radioCurriculo" id="selectCurriculoAprovado" <?php if($inscricao->curriculo == ''){echo('checked="true"');} ?> >
                              </td>
                              <td style="text-align: center">
                                <input onclick="selectCheck('rejeitado')"  type="radio" name="radioCurriculo" id="selectCurriculoRejeitado">
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
                              <td style="text-align: center">
                                <input onclick="selectCheck('aprovado')"  type="radio" name="radioEnem" id="selectEnemAprovado" <?php if($inscricao->enem == ''){echo('checked="true"');} ?> >
                              </td>
                              <td style="text-align: center">
                                <input onclick="selectCheck('rejeitado')"  type="radio" name="radioEnem" id="selectEnemRejeitado">
                              </td>
                            </div>
                        </div>
                      </tr>

                      <input style="display: none" checked type="radio" name="radioComprovante" id="selectComprovanteAprovado">
                      <input style="display: none"  type="radio" name="radioComprovante" id="selectComprovanteRejeitado">


                    </table>
                  </div>
                </div>
            </div>
            <form method="POST" action="{{ route('seguirParaClassificacao') }}" enctype="multipart/form-data" id="formHomologacao">
              @csrf
              <div class="form-group" id="motivoRejeicao" style=" display: none;">
                <label for="motivoRejeicao" class="col-md-4 col-form-label text-md-right"  style="margin-left: -60px;">{{ __('Motivos da Rejeição:') }}</label>

                <div class="col-md-6" style="margin-left: 10px">
                  <textarea form ="formHomologacao" name="motivoRejeicao" id="taid" cols="115" ></textarea>

                </div>
              </div>
              <div class="form-group row mb-0" style="margin-left: 23rem; margin-top: 10px">
                <div class="col-md-8 offset-md-4">
                  <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                  <input id="homologado" type="hidden" name="homologado" value="">
                  <input id="tipo" type="hidden" name="tipo" value="seguirParaClassificacao">
                  <button id="buttonFinalizar" type="submit" class="btn btn-primary btn-primary-lmts" disabled="true">
                    {{ __('Continuar') }}
                  </button>
                </div>
              </div>
            </form>
        </div>

    </div>
</div>


<script type="text/javascript" >
function checkFinalizar(){
  if(document.getElementById("selectHistoricoEscolarAprovado").checked || document.getElementById("selectHistoricoEscolarRejeitado").checked){
    if(document.getElementById("selectDeclaracaoDeVinculoAprovado").checked || document.getElementById("selectDeclaracaoDeVinculoRejeitado").checked){
      if(document.getElementById("selectProgramaDasDisciplinasAprovado").checked || document.getElementById("selectProgramaDasDisciplinasRejeitado").checked){
        if(document.getElementById("selectCurriculoAprovado").checked || document.getElementById("selectCurriculoRejeitado").checked){
          if(document.getElementById("selectEnemAprovado").checked || document.getElementById("selectEnemRejeitado").checked){
            if(document.getElementById("selectDadosPessoaisAprovado").checked || document.getElementById("selectDadosPessoaisRejeitado").checked){
              if(document.getElementById("selectDadosDoCursoAprovado").checked || document.getElementById("selectDadosDoCursoRejeitado").checked){
                if(document.getElementById("selectInscricaoAprovado").checked || document.getElementById("selectInscricaoRejeitado").checked){
                  if(document.getElementById("selectComprovanteAprovado").checked || document.getElementById("selectComprovanteRejeitado").checked){
                    document.getElementById("buttonFinalizar").disabled = false;
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}

function checkAprovado(){
  if(document.getElementById("selectHistoricoEscolarAprovado").checked){
    if(document.getElementById("selectDeclaracaoDeVinculoAprovado").checked){
      if(document.getElementById("selectProgramaDasDisciplinasAprovado").checked){
        if(document.getElementById("selectCurriculoAprovado").checked){
          if(document.getElementById("selectEnemAprovado").checked){
            if(document.getElementById("selectDadosPessoaisAprovado").checked){
              if(document.getElementById("selectDadosDoCursoAprovado").checked){
                if(document.getElementById("selectInscricaoAprovado").checked){
                  if(document.getElementById("selectComprovanteAprovado").checked){
                    document.getElementById("homologado").value = 'aprovado';
                    document.getElementById("motivoRejeicao").value = '';
                    document.getElementById("motivoRejeicao").style.display = 'none';
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}


function selectCheckDRCA(x){
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = '';
    document.getElementById("homologado").value = 'rejeitado';
    document.getElementById("buttonFinalizar").disabled = false;
  }
  else{
    document.getElementById("homologado").value = 'aprovado';
    document.getElementById("motivoRejeicao").value = '';
    document.getElementById("motivoRejeicao").style.display = 'none';
    document.getElementById("buttonFinalizar").disabled = false;
  }
}


function selectCheck(x){
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = '';
    document.getElementById("homologado").value = 'rejeitado';
  }
  checkAprovado();
  checkFinalizar();
}





</script>
@endsection
