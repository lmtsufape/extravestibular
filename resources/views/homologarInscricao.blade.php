@extends('layouts.app')
@section('titulo','Homologar Inscrição')
@section('navbar')
    Homologar Inscrição
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
                <div class="card-header">{{ __('Homologar inscrição') }}</div>
                <div class="card-body">
                  <div class="form-group row">
                    <table>
                      <tr>
                        <th>Requisito</th>
                        <th>Dados</th>
                        <th>Aprovado</th>
                        <th>Rejeitado</th>
                      </tr>
                      <tr <?php if($inscricao->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                        <form method="POST" action={{ route('homologarInscricao') }} enctype="multipart/form-data">
                              @csrf
                        <div class="form-group row" >
                            <td>
                              <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                            </td>
                            <div class="col-md-6">
                                <td>
                                  <a href="{{ route('download', ['file' => $declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                                </td>
                                <td>
                                  <input onclick="selectCheck('aprovado')"  type="radio" name="radioDeclaracaoDeVinculo" id="selectDeclaracaoDeVinculoAprovado" <?php if($inscricao->declaracaoDeVinculo == ''){echo('checked="true"');} ?> >
                                </td>
                                <td>
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
                                <a href="{{ route('download', ['file' => $historicoEscolar])}}" target="_new">Abrir arquivo</a>
                              </td>
                              <td>
                                <input onclick="selectCheck('aprovado')"  type="radio" name="radioHistoricoEscolar" id="selectHistoricoEscolarAprovado" <?php if($inscricao->historicoEscolar == ''){echo('checked="true"');} ?> >
                              </td>
                              <td>
                                <input onclick="selectCheck('rejeitado')"  type="radio" name="radioHistoricoEscolar" id="selectHistoricoEscolarRejeitado" >
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
                                <a href="{{ route('download', ['file' => $programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                              </td>
                              <td>
                                <input onclick="selectCheck('aprovado')"  type="radio" name="radioProgramaDasDisciplinas" id="selectProgramaDasDisciplinasAprovado" <?php if($inscricao->programaDasDisciplinas == ''){echo('checked="true"');} ?> >
                              </td>
                              <td>
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
                                <a href="{{ route('download', ['file' => $curriculo ])}}" target="_blank">Abrir arquivo</a>
                              </td>
                              <td>
                                <input onclick="selectCheck('aprovado')"  type="radio" name="radioCurriculo" id="selectCurriculoAprovado" <?php if($inscricao->curriculo == ''){echo('checked="true"');} ?> >
                              </td>
                              <td>
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
                                <a href="{{ route('download', ['file' => $enem ])}}" target="_blank">Abrir arquivo</a>
                              </td>
                              <td>
                                <input onclick="selectCheck('aprovado')"  type="radio" name="radioEnem" id="selectEnemAprovado" <?php if($inscricao->enem == ''){echo('checked="true"');} ?> >
                              </td>
                              <td>
                                <input onclick="selectCheck('rejeitado')"  type="radio" name="radioEnem" id="selectEnemRejeitado">
                              </td>
                            </div>
                        </div>
                      </div>
                      </tr>
                      <tr>
                        <div class="form-group row" >
                          <td>
                            <label for="curso" >{{ __('Curso')}}</label>
                          </td>

                          <td>
                            <label for="cursoDado" >{{ __($inscricao->curso)}}</label>
                          </td>
                          <td>
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioCurso" id="selectCursoAprovado">
                          </td>
                          <td>
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioCurso" id="selectCursoRejeitado">
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group row" >
                          <td>
                            <label for="cursoDeOrigem" >{{ __('Curso de Origem')}}</label>
                          </td>

                          <td>
                            <label for="cursoDeOrigemDado" >{{ __($inscricao->cursoDeOrigem)}}</label>
                          </td>
                          <td>
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioCursoDeOrigem" id="selectCursoDeOrigemAprovado">
                          </td>
                          <td>
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioCursoDeOrigem" id="selectCursoDeOrigemRejeitado">
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group row" >
                          <td>
                            <label for="instituicaoDeOrigem" >{{ __('Instituição de Origem')}}</label>
                          </td>

                          <td>
                            <label for="instituicaoDeOrigem" >{{ __($inscricao->instituicaoDeOrigem)}}</label>
                          </td>
                          <td>
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioInstituicaoDeOrigem" id="selectInstituicaoDeOrigemAprovado">
                          </td>
                          <td>
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioInstituicaoDeOrigem" id="selectInstituicaoDeOrigemRejeitado">
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group row" >
                          <td>
                            <label for="polo" >{{ __('Polo')}}</label>
                          </td>

                          <td>
                            <label for="poloDado" >{{ __($inscricao->polo)}}</label>
                          </td>
                          <td>
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioPolo" id="selectPoloAprovado">
                          </td>
                          <td>
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioPolo" id="selectPoloRejeitado">
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group row" >
                          <td>
                            <label for="turno" >{{ __('Turno')}}</label>
                          </td>

                          <td>
                            <label for="turnoDado" >{{ __($inscricao->turno)}}</label>
                          </td>
                          <td>
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioTurno" id="selectTurnoAprovado">
                          </td>
                          <td>
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioTurno" id="selectTurnoRejeitado">
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group row" >
                          <td>
                            <label for="naturezaDaIes" >{{ __('Natureza da IES')}}</label>
                          </td>

                          <td>
                            <label for="naturezaDaIesDado" >{{ __($inscricao->naturezaDaIes)}}</label>
                          </td>
                          <td>
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioNaturezaDaIes" id="selectNaturezaDaIesAprovado">
                          </td>
                          <td>
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioNaturezaDaIes" id="selectNaturezaDaIesRejeitado">
                          </td>
                        </div>
                      </tr><tr>
                        <div class="form-group row" >
                          <td>
                            <label for="enderecoDaIes" >{{ __('Endereço da IES')}}</label>
                          </td>

                          <td>
                            <label for="enderecoDaIesDado" >{{ __($inscricao->naturezaDaIes)}}</label>
                          </td>
                          <td>
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioEnderecoDaIes" id="selectEnderecoDaIesAprovado">
                          </td>
                          <td>
                            <input onclick="selectCheck('rejeitado')" type="radio" name="radioEnderecoDaIes" id="selectEnderecoDaIesRejeitado">
                          </td>
                        </div>
                      </tr>
                    </table>
                        <div class="form-group row" id="motivoRejeicao" style="display: none;" >
                            <label for="motivosRejeicao" class="col-md-4 col-form-label text-md-right">{{ __('Motivos da Rejeição') }}</label>

                            <div class="col-md-6">
                              <input type="text" name="motivoRejeicao" autofocus>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                                <input id="homologado" type="hidden" name="homologado" value="">
                                <input id="tipo" type="hidden" name="tipo" value="{{$tipo}}">
                                <button id="buttonFinalizar" type="submit" class="btn btn-primary" disabled="true">
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
function checkFinalizar(){
  if(document.getElementById("selectHistoricoEscolarAprovado").checked || document.getElementById("selectHistoricoEscolarRejeitado").checked){
    if(document.getElementById("selectDeclaracaoDeVinculoAprovado").checked || document.getElementById("selectDeclaracaoDeVinculoRejeitado").checked){
      if(document.getElementById("selectProgramaDasDisciplinasAprovado").checked || document.getElementById("selectProgramaDasDisciplinasRejeitado").checked){
        if(document.getElementById("selectCurriculoAprovado").checked || document.getElementById("selectCurriculoRejeitado").checked){
          if(document.getElementById("selectEnemAprovado").checked || document.getElementById("selectEnemRejeitado").checked){
            if(document.getElementById("selectCursoAprovado").checked || document.getElementById("selectCursoRejeitado").checked){
              if(document.getElementById("selectCursoDeOrigemAprovado").checked || document.getElementById("selectCursoDeOrigemRejeitado").checked){
                if(document.getElementById("selectInstituicaoDeOrigemAprovado").checked || document.getElementById("selectInstituicaoDeOrigemRejeitado").checked){
                  if(document.getElementById("selectPoloAprovado").checked || document.getElementById("selectPoloRejeitado").checked){
                    if(document.getElementById("selectTurnoAprovado").checked || document.getElementById("selectTurnoRejeitado").checked){
                      if(document.getElementById("selectNaturezaDaIesAprovado").checked || document.getElementById("selectNaturezaDaIesRejeitado").checked){
                        if(document.getElementById("selectEnderecoDaIesAprovado").checked || document.getElementById("selectEnderecoDaIesRejeitado").checked){
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
    }
  }
}

function checkAprovado(){
  if(document.getElementById("selectHistoricoEscolarAprovado").checked){
    if(document.getElementById("selectDeclaracaoDeVinculoAprovado").checked){
      if(document.getElementById("selectProgramaDasDisciplinasAprovado").checked){
        if(document.getElementById("selectCurriculoAprovado").checked){
          if(document.getElementById("selectEnemAprovado").checked){
            if(document.getElementById("selectCursoAprovado").checked){
              if(document.getElementById("selectCursoDeOrigemAprovado").checked){
                if(document.getElementById("selectInstituicaoDeOrigemAprovado").checked){
                  if(document.getElementById("selectPoloAprovado").checked){
                    if(document.getElementById("selectTurnoAprovado").checked){
                      if(document.getElementById("selectNaturezaDaIesAprovado").checked){
                        if(document.getElementById("selectEnderecoDaIesAprovado").checked){
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
    }
  }
}




function selectCheck(x){
  console.log('entrou');
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = '';
    document.getElementById("homologado").value = 'rejeitado';
  }
  checkAprovado();
  checkFinalizar();
}





</script>
@endsection
