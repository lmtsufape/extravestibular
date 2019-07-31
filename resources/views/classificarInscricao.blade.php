@extends('layouts.app')
@section('titulo','Classificar Inscrição')
@section('navbar')
    Classificar Inscrição
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
      <div class="card-header">{{ __('Classificar Inscrição') }}</div>
      <div class="card-body">
        <div class="form-group row">
          <table>
            <tr>
              <th>Requisito</th>
              <th>Dados</th>
            </tr>
            <tr <?php if($inscricao->declaracaoDeVinculo    == ''){echo('style="display: none"');} ?> >
              <form method="POST" action={{ route('homologarInscricao') }} enctype="multipart/form-data">
                    @csrf
              <div class="form-group row" >
                  <td>
                    <label for="declaracaoDeVinculo" >{{ __('Declaração de Vinculo') }}</label>
                  </td>
                  <div class="col-md-6">
                      <td>
                        <a href="{{ $declaracaoDeVinculo }}" target="_blank">Abrir arquivo</a>
                      </td>
                  </div>
              </div>
            </tr>
            <tr <?php if($inscricao->historicoEscolar       == ''){echo('style="display: none"');} ?> >
              <div class="form-group row" >
                <td>
                  <label for="historicoEscolar" >{{ __('Historico Escolar') }}</label>
                </td>
                  <div class="col-md-6">
                    <td>
                      <a href="{{ $historicoEscolar }}" target="_blank">Abrir arquivo</a>
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
                      <a href="{{ $programaDasDisciplinas }}" target="_blank">Abir arquivo</a>
                    </td>
                  </div>
              </div>
            </tr>
            <tr <?php if($inscricao->curriculo              == ''){echo('style="display: none"');} ?> >
              <div class="form-group row" >
                <td>
                  <label for="curriculo" >{{ __('Curriculo') }}</label>
                </td>
                  <div class="col-md-6">
                    <td>
                      <a href="{{ $curriculo }}" target="_blank">Abrir arquivo</a>
                    </td>
                  </div>
              </div>
            </tr>
            <tr <?php if($inscricao->enem                   == ''){echo('style="display: none"');} ?> >
              <div class="form-group row" >
                <td>
                  <label for="enem" >{{ __('ENEM') }}</label>
                </td>
                  <div class="col-md-6">
                    <td>
                      <a href="{{ $enem }}" target="_blank">Abrir arquivo</a>
                    </td>
                  </div>
              </div>
            </tr>
          </table>
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
