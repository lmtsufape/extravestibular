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
                       document.('classificar').submit();">
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
  .check{
    margin-left: 1%;
  }
  .card-body{
    margin-left: 5%;
    margin-right: 5%;
  }
  #buttonFinalizar{
    margin-top: 20px;
  }
  @media screen and (max-width:576px){
    .check{
      margin-left: 3%;
    }
    .card-body{
      margin-left: 5%;
      margin-right: 5%;
    }
  }

</style>


<div class="container">
  <form method="GET" action="{{ route('seguirParaClassificacao') }}" enctype="multipart/form-data" id="formHomologacao">

    <div class="row justify-content-center">
      <div class="col-md-8">
        <input style="display: none" onclick="selectCheck('aprovado')" checked id="selectDadosPessoaisAprovado" type="radio" name="radioDadosPessoais" value="aprovado">
      </div>
    </div>

    <div class="row justify-content-center">
      <!-- título Dados de Usuário-->
      <div class="titulo-tabela-lmts">
          <h3>
            Transferência Externa
          </h3>
      </div><!-- end título Dados de Usuário-->
    </div>

    <!-- row Documentos -->
    <div class="row justify-content-center">
      <!-- card Documentos -->
      <div class="card">
          <div class="card-header">{{ __('Documentos') }}</div>

          <!-- card-body -->
          <div class="card-body">
            <div class="row justify-content-center">
              <table class="table table-ordered table-hover">
                <tr>
                  <th>Requisito</th>
                  <th>Dados</th>
                  <th style="text-align: center">Aceito</th>
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

    <!-- row motivos rejeicao -->
    <div class="row justify-content-center">
      <div class="card" style="width:100%;display: none; margin-bottom: 20px;" id="motivoRejeicao">
        <div class="card-header">
          {{ __('Motivos da Rejeição dos Documentos') }}
        </div>
        <div class="card-body">
          <div class="row">
            <label for="motivoRejeicao" class="col-form-label text-md-right" style="margin-left: 1.5%;">{{ __('Motivos da Rejeição dos Documentos') }}</label>
          </div><!-- end row div-->

          <div class="row justify-content-center">
            <div class="col-sm-12">
              <textarea class="form-control @error('motivoRejeicao') is-invalid @enderror" form ="formHomologacao" name="motivoRejeicao" id="taid" cols="115" style="width:100%"></textarea>
              @error('motivoRejeicao')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div><!-- end row text area-->
        </div><!-- end card-body-->
      </div><!-- end card-->
    </div><!-- end row -->


    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">
          Critérios de Avaliação
        </div>
        <div class="card-body">
          <div class="row justify-content-left">
            <div class="col-sm-12">
              <input type="checkbox" class="form-check-input" id="checkCriterioA" onclick="selectCriterio('a')">
              <label for="">
                a) Tiver cursado e concluído com aproveitamento de média global igual ou maior que 6,0 e
                  não ter mais do que 2 (duas) reprovações nas disciplinas do primeiro semestre letivo na
                  Instituição de origem;
              </label>
            </div>
          </div>

          <div class="row justify-content-left">
            <div class="col-sm-12">
              <input type="checkbox" class="form-check-input" id="checkCriterioB" onclick="selectCriterio('b')">
              <label for="">
                b) Conseguir concluir o currículo pleno do Curso de Graduação da UFRPE, dentro do prazo
                  máximo estabelecido pelo UFRPE para o curso no qual está ingressando, considerando o
                  prazo anterior utilizado no curso da IES original;
              </label>
            </div>
          </div>

          <div class="row justify-content-left">
            <div class="col-sm-12">
              <input type="checkbox" class="form-check-input" id="checkCriterioC" onclick="selectCriterio('c')">
              <label for="">
                c) Tiver cursado com aprovação, <b>no máximo</b> 70% do curso na Instituição de origem;
              </label>
            </div>
          </div>

          <div class="row justify-content-left">
            <div class="col-sm-12">
              <input type="checkbox" class="form-check-input" id="checkCriterioD" onclick="selectCriterio('d')">
              <label for="">
                d) Não tiver sido reprovado 04 (quatro) vezes em uma ou mais disciplinas;
              </label>
            </div>
          </div>

          <div class="row justify-content-left">
            <div class="col-sm-12">
              <input type="checkbox" class="form-check-input" id="checkCriterioE" onclick="selectCriterio('e')">
              <label for="">
                e) Não tiver sido formalmente desligado de um Curso de Graduação da UFRPE.
              </label>
            </div>
          </div>


          <br>
          <div class="row justify-content-left">
            <h4><b>Os critérios de prioridade para classificação serão:</b></h4>
          </div>

          <div class="row justify-content-left">
            <ol>
              <li><h5>Maior proximidade de conclusão do curso;</h5></li>
              <li><h5>Maior média global constante no Histórico Escolar da graduação.</h5></li>
            </ol>
          </div>

        </div><!-- End card-body-->

      </div><!-- End card-->

    </div><!-- End Row -->

    <!-- row motivos rejeicao -->
    <div class="row justify-content-center">
      <div class="card" style="width:100%;display: none; margin-bottom: 20px;" id="motivoRejeicaoCriterio">
        <div class="card-header">
          {{ __('Motivos da Rejeição dos Critérios') }}
        </div>
        <div class="card-body">

          <div class="row">
            <label for="motivoRejeicao" class="col-form-label text-md-right" style="margin-left: 1.5%;">
              {{ __('Critérios Rejeitados') }}:
            </label>
          </div><!-- end row div-->

          <div class="row">
            <div class="col-sm-12">

              <h4> <p style="" id="motivos"></p></h4>
            </div>
          </div>


          <div class="row">
            <label for="motivoRejeicao" class="col-form-label text-md-right" style="margin-left: 1.5%;">{{ __('Informações adicionais') }}</label>
          </div><!-- end row div-->

          <div class="row justify-content-center">
            <div class="col-sm-12">
              <textarea class="form-control @error('motivoRejeicao') is-invalid @enderror" form ="formHomologacao" name="motivoRejeicao" id="taid" cols="115" style="width:100%"></textarea>
              @error('motivoRejeicao')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div><!-- end row text area-->
        </div><!-- end card-body-->
      </div><!-- end card-->
    </div><!-- end row -->

      <!-- Button -->
      <div class="form-group row justify-content-center">
          <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
          <input id="homologado" type="hidden" name="homologado" value="">
          <input id="tipo" type="hidden" name="tipo" value="seguirParaClassificacao">
          <div class="row justify-content-center">
            <button id="buttonFinalizar" onclick="event.preventDefault();confirmar();" class="btn btn-primary btn-primary-lmts" disabled="true">
              {{ __('Finalizar') }}
            </button>
          </div>
      </div><!-- end Button -->
  </form>
</div>


<script type="text/javascript" >


var arrayMotivos = [];
function selectCriterio(opcao){

  var checkboxA = document.getElementById("checkCriterioA");
  var checkboxB = document.getElementById("checkCriterioB");
  var checkboxC = document.getElementById("checkCriterioC");
  var checkboxD = document.getElementById("checkCriterioD");
  var checkboxE = document.getElementById("checkCriterioE");


  var cardRejeicaoCriterio = document.getElementById("motivoRejeicaoCriterio");

  var textoMotivos = document.getElementById("motivos");



  if(opcao == "a"){
    if (checkboxA.checked == true) {

      // cardRejeicaoCriterio.style.display = "block";
      arrayMotivos.push(opcao);

    }
    else{
      // arrayMotivos.splice(arrayMotivos.indexOf(opcao));
      arrayMotivos= arrayRemove(arrayMotivos,opcao);
    }
  }
  if(opcao == "b"){
    if (checkboxB.checked == true) {
      // cardRejeicaoCriterio.style.display = "block";
      arrayMotivos.push(opcao);
    }
    else{
      // arrayMotivos.splice(arrayMotivos.indexOf(opcao));
      arrayMotivos= arrayRemove(arrayMotivos,opcao);
    }

  }
  if(opcao == "c"){
    if (checkboxC.checked == true) {
      // cardRejeicaoCriterio.style.display = "block";
      arrayMotivos.push(opcao);
    }
    else{
      // arrayMotivos.splice(arrayMotivos.indexOf(opcao));
      arrayMotivos= arrayRemove(arrayMotivos,opcao);
    }

  }
  if(opcao == "d"){
    if (checkboxD.checked == true) {
      // cardRejeicaoCriterio.style.display = "block";
      arrayMotivos.push(opcao);
    }
    else{
      // arrayMotivos.splice(arrayMotivos.indexOf(opcao));
      arrayMotivos= arrayRemove(arrayMotivos,opcao);
    }

  }
  if(opcao == "e"){
    if (checkboxE.checked == true) {
      // cardRejeicaoCriterio.style.display = "block";
      arrayMotivos.push(opcao);
    }
    else{
      // arrayMotivos.splice(arrayMotivos.indexOf(opcao));
      arrayMotivos= arrayRemove(arrayMotivos,opcao);
    }

  }

  if(checkCriterioA.checked == false && checkCriterioB.checked == false && checkCriterioC.checked == false
    && checkCriterioD.checked == false && checkCriterioE.checked == false){
    cardRejeicaoCriterio.style.display = "none";
  }else {
    cardRejeicaoCriterio.style.display = "block";
    textoMotivos.innerHTML = arrayMotivos.sort();
  }
}


function arrayRemove(arr, value) {

   return arr.filter(function(ele){
       return ele != value;
   });

}






  function confirmar(){
      if(confirm("Tem certeza que deseja finalizar?") == true) {
        document.getElementById("formHomologacao").submit();
     }
    }
  function checkFinalizar(){
    if(document.getElementById("selectHistoricoEscolarAprovado").checked || document.getElementById("selectHistoricoEscolarRejeitado").checked){
      if(document.getElementById("selectDeclaracaoDeVinculoAprovado").checked || document.getElementById("selectDeclaracaoDeVinculoRejeitado").checked){
        if(document.getElementById("selectProgramaDasDisciplinasAprovado").checked || document.getElementById("selectProgramaDasDisciplinasRejeitado").checked){
          if(document.getElementById("selectCurriculoAprovado").checked || document.getElementById("selectCurriculoRejeitado").checked){
            if(document.getElementById("selectEnemAprovado").checked || document.getElementById("selectEnemRejeitado").checked){
                if(document.getElementById("selectComprovanteAprovado").checked || document.getElementById("selectComprovanteRejeitado").checked){
                  document.getElementById("buttonFinalizar").disabled = false;
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
                if(document.getElementById("selectComprovanteAprovado").checked){
                  document.getElementById("homologado").value = 'aprovado';
                  document.getElementById("motivoRejeicao").value = '';
                  document.getElementById("motivoRejeicao").style.display = 'none';
                }
              // }
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
