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

<style media="screen">
  .card{
    width: 100%;
  }
  #margin{
    margin-bottom: 20px;
  }
</style>

<div class="container">

  <div class="row justify-content-center">
    <div class="col-md-8">
      <input style="display: none" onclick="selectCheck('aprovado')" checked id="selectDadosPessoaisAprovado" type="radio" name="radioDadosPessoais" value="aprovado">
    </div>
  </div>

  <!-- row card Dados da Inscrição -->
  <div class="row justify-content-center">
    <!-- card -->
    <div id="margin" class="card" style="margin-top:20px">
      <div class="card-header">{{ __('Dados da Inscrição') }}</div>
      <div class="card-body">
        <!-- row tipo de Matricula -->
        <div class="row">
          <div id="margin" class="col-sm-12">
            <label for="Tipo de Matricula" class="field a-field a-field_a2 page__field" style="width:100%;">
              <input disabled id="Tipo de Matricula" type="text" name="Curso Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Tipo de Matricula" value="{{ $inscricao->tipo }}">
              <span class="a-field__label-wrap">
                <span class="a-field__label">Tipo de Matricula</span>
              </span>
            </label>

          </div>
        </div>

        <!-- row curso pertendido | turno -->
        <div class="row justify-content-center">
          <!-- curso Pretendido -->
          <div id="margin" class="col-sm-9">
            <label for="Curso Pretendido" class="field a-field a-field_a2 page__field" style="width:100%">
              <input disabled id="Curso Pretendido" type="text" name="Curso Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Curso Pretendido" value="{{ $curso }}">
              <span class="a-field__label-wrap">
                <span class="a-field__label">Curso Pretendido</span>
              </span>
            </label>
          </div><!-- end curso Pretendido -->
          <!-- turno -->
          <div id="margin" class="col-sm-3">
            <label for="Turno" class="field a-field a-field_a2 page__field" style="width:100%">
              <input disabled id="Turno" type="text" name="Turno" autofocus class="form-control field__input a-field__input" placeholder="Turno" value="{{ $inscricao->turno }}">
              <span class="a-field__label-wrap">
                <span class="a-field__label">Turno</span>
              </span>
            </label>
          </div><!-- end turno -->
        </div><!-- end row curso pertendido | turno -->
      </div><!-- end card-body -->

    </div><!-- end card -->
  </div><!-- end row card Dados da Inscrição -->

  <!-- if -->
  <div styles="<?php if($tipo != 'homologacao'){ echo("display: none");} ?>">
    <!-- row card Dados de curso -->
    <div class="row justify-content-center">
        <!-- card dados do Curso -->
        <div id="margin" class="card">
          <div class="card-header">{{ __('Dados do Curso e Instituição de Origem') }}</div>
          <!-- card-body -->
          <div class="card-body">

            <!-- row curso de origem -->
            <div id="margin" class="row justify-content-center">
              <div class="col-sm-12">
                <label for="Curso de Origem" class="field a-field a-field_a2 page__field" style="width:100%">
                  <input disabled id="Curso de Origem" type="text" name="Curso de Origem" autofocus class="form-control field__input a-field__input" placeholder="Curso de Origem" value="{{ $inscricao->cursoDeOrigem }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Curso de Origem</span>
                  </span>
                </label>
              </div>
            </div><!-- end row curso de origem -->

            <!-- row instituicaoDeOrigem/natureza -->
            <div class="row justify-content-center">
              <!-- Instituição de origem -->
              <div id="margin" class="col-sm-9">
                <label for="Instituição de Origem" class="field a-field a-field_a2 page__field" style="width:100%">
                  <input disabled id="Instituição de de Origem" type="text" name="Instituição de Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Instituição de de Origem" value="{{ $inscricao->instituicaoDeOrigem }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Instituição de Origem</span>
                  </span>
                </label>
              </div><!-- end Instituição de origem -->

              <div id="margin" class="col-sm-3">
                <label for="Natureza da IES" class="field a-field a-field_a2 page__field" style="width:100%">
                  <input disabled id="Natureza da IES" type="text" name="Natureza da IES" autofocus class="form-control field__input a-field__input" placeholder="Natureza da IES" value="{{ $inscricao->naturezaDaIes }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Natureza da IES</span>
                  </span>
                </label>
              </div>
            </div><!-- end row instituicaoDeOrigem/natureza -->

            <!-- row Endereco|N° -->
            <div id="margin" class="row justify-content-center">
              <!-- endereco -->
              <div class="col-sm-9">
                <label for="endereco" class="field a-field a-field_a2 page__field" style=" width:100%">
                  <input disabled id="endereco" type="text" name="endereco" autofocus class="form-control field__input a-field__input" placeholder="Endereço" value="{{ $inscricao->endereco }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Endereço</span>
                  </span>
                </label>
              </div><!-- end endereco -->

              <!-- n° -->
              <div id="margin" class="col-sm-3">
                <label for="num" class="field a-field a-field_a2 page__field" style=" width:100%">
                  <input disabled id="num" type="text" name="num" autofocus class=" form-control field__input a-field__input" placeholder="Nº" value="{{ $inscricao->num }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Nº</span>
                  </span>
                </label>
              </div><!-- end n° -->
            </div><!-- end row Endereco|N° -->

            <!-- row bairro cidade uf -->
            <div class="row justify-content-center">
              <!-- bairro -->
              <div id="margin" class="col-sm-6">
                <label for="bairro" class="field a-field a-field_a2 page__field"  style=" width:100%">
                  <input disabled id="bairro" type="text" name="bairro" autofocus class=" form-control field__input a-field__input" placeholder="Bairro" value="{{ $inscricao->bairro }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Bairro</span>
                  </span>
                </label>
              </div><!-- end bairro -->
              <!-- cidade -->
              <div id="margin" class="col-sm-4">
                <label for="cidade" class="field a-field a-field_a2 page__field"  style=" width:100%">
                  <input disabled id="cidade" type="text" name="cidade" autofocus class=" form-control field__input a-field__input" placeholder="Cidade" value="{{ $inscricao->cidade }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Cidade</span>
                  </span>
                </label>

              </div><!-- end cidade -->
              <!-- uf -->
              <div id="margin" class="col-sm-2">
                <label for="uf" class="field a-field a-field_a2 page__field" style=" width:100%">
                  <input disabled id="uf" type="text" name="uf" autofocus class=" form-control field__input a-field__input" placeholder="UF" value="{{ $inscricao->uf }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">UF</span>
                  </span>
                </label>
              </div><!-- end uf -->
            </div><!-- end row bairro cidade uf -->

            <!-- aprovado rejeitado -->
            <div class="row justify-content-center" style="margin-top:20px;">
              <!-- aprovado-->
              <div class="col-sm-3" >
                <div class="row justify-content-center">
                  <input onclick="selectCheck('aprovado')" id="selectDadosDoCursoAprovado" type="radio" name="radioDadosDoCurso" value="aprovado"> <h4>Aprovado</h4>
                </div>
              </div><!-- end aprovado-->
              <!-- Rejeitado -->
              <div class="col-sm-3">
                <div class="row justify-content-center">
                  <input onclick="selectCheck('rejeitado')" id="selectDadosDoCursoRejeitado"  type="radio" name="radioDadosDoCurso" value="rejeitado"> <h4>Rejeitado</h4>
                </div><!-- end Rejeitado -->
              </div><!-- end Rejeitado -->
            </div><!-- end aprovado rejeitado -->
          </div><!-- end card-body -->
        </div><!-- card dados do Curso -->
    </div><!-- row card Dados de curso -->
  </div><!-- end if -->

  <!-- row Documentos -->
  <div class="row justify-content-center">
    <!-- card Documentos -->
    <div id="margin" class="card">
        <div class="card-header">{{ __('Documentos') }}</div>

        <!-- card-body -->
        <div class="card-body">
          <div class="row justify-content-center">
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

        </div><!-- end card-body -->
    </div><!-- end card Documentos -->
  </div><!-- end row Documentos -->

  <form method="POST" action="{{ route('seguirParaClassificacao') }}" enctype="multipart/form-data" id="formHomologacao">
    @csrf
    <div class="row justify-content-center">
      <div class="card" style="width:100%;display: none; margin-bottom: 20px;" id="motivoRejeicao">
        <div class="card-header">
          {{ __('Motivos da Rejeição') }}
        </div>
        <div class="card-body">
          <div class="row">
            <label for="motivoRejeicao" class="col-form-label text-md-right" style="margin-left: 1.5%;">{{ __('Motivos da Rejeição') }}</label>
          </div><!-- end row div-->

          <div class="row justify-content-center">
            <div class="col-sm-12">
              <textarea form ="formHomologacao" name="motivoRejeicao" id="taid" cols="115" style="width:100%"></textarea>

            </div>
          </div><!-- end row text area-->



        </div><!-- end card-body-->
      </div><!-- end card-->
    </div><!-- end row -->

    <div class="form-group row justify-content-center">

        <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
        <input id="homologado" type="hidden" name="homologado" value="">
        <input id="tipo" type="hidden" name="tipo" value="seguirParaClassificacao">
        <div class="row justify-content-center">
          <button id="buttonFinalizar" type="submit" class="btn btn-primary btn-primary-lmts" disabled="true">
            {{ __('Continuar') }}
          </button>
        </div>

    </div>
  </form>
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
