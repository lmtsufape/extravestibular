@extends('layouts.app')
@section('titulo','Homologar Isencao')
@section('navbar')
    Home / Detalhes do edital / Homologar Isenção / {{$isencao->cpfCandidato}}
@endsection
@section('content')

<div class="container " style="width: 100rem;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 70rem; margin-left: -12rem">
                <div class="card-header">{{ __('Declaração') }}</div>
                <div class="card-body">
                  <div class="form-group row justify-content-center">
                        <div class="form-group row "   >
                            <div class="col-md-12">
                              <a style="margin-left: 15rem">DECLARAÇÃO DO CANDIDATO NOS TERMOS DA LEI:</a><br>
                              <a style="font-weight: bold">
                              @if($isencao->tipo == "ambos")
                                I - o candidato declarar-se impossibilitado de arcar com o pagamento da taxa de inscrição e comprovar renda familiar mensal igual inferior a um salário mínimo e meio.
                                <br>
                                II – ter cursado o ensino médio completo em escola da rede pública ou como bolsista integral em escola da rede privada.
                              @elseif($isencao->tipo == "renda")
                                I - o candidato declarar-se impossibilitado de arcar com o pagamento da taxa de inscrição e comprovar renda familiar mensal igual inferior a um salário mínimo e meio.
                              @else
                                II – ter cursado o ensino médio completo em escola da rede pública ou como bolsista integral em escola da rede privada.
                              @endif
                              </a>

                            </div>
                        </div>
                  </div>
                </div>
            </div>
            @if($isencao->tipo == "ambos")
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Arquivos') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-center">
                        <div class="form-group row" >
                            <label for="historicoEscolar" style="font-weight: bold; margin-left: -5rem">{{ __('Historico Escolar:') }}</label>
                            <div >
                                <a style="margin-left: 10px" href="{{ route('download', ['file' => $isencao->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Dados economicos') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-left">
                      <div class="form-group row"   style="margin-left: 15px">
                        <table class="table table-ordered table-hover">
                          <tr>
                            <tr>
                              <td style="width: 13rem">
                                Nome:
                              </td>
                              <td style="width: 55rem">
                                <a style="font-weight: bold;"> {{$isencao->nomeDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                CPF:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->cpfDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Parentesco:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->parentescoDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Renda mensal:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->rendaDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Fonte pagadora:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->fontePagadoraDadoEconomico}} </a>
                              </td>
                            </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Dados economicos do nucleo familiar') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-left">
                      <div class="form-group row"   style="margin-left: 15px">
                        <table class="table table-ordered table-hover">
                          <tr>
                            <tr>
                              <td style="width: 13rem">
                                Nome:
                              </td>
                              <td style="width: 55rem">
                                <a style="font-weight: bold"> {{$isencao->nomeNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                CPF:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->cpfNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Parentesco:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->parentescoNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Renda mensal:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->rendaNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Fonte pagadora:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->fontePagadoraNucleoFamiliar}} </a>
                              </td>
                            </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Dados economicos do nucleo familiar') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-left">
                      <div class="form-group row"   style="margin-left: 15px">
                        <table class="table table-ordered table-hover">
                          <tr>
                            <tr>
                              <td style="width: 13rem">
                                Nome:
                              </td>
                              <td style="width: 55rem">
                                <a style="font-weight: bold"> {{$isencao->nomeNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                CPF:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->cpfNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Parentesco:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->parentescoNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Renda mensal:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->rendaNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Fonte pagadora:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->fontePagadoraNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>

            @elseif($isencao->tipo == "ensinoMedio")
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Arquivos') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-center">
                        <div class="form-group row" >
                            <label for="historicoEscolar" style="font-weight: bold; margin-left: -5rem">{{ __('Historico Escolar:') }}</label>
                            <div >
                                <a style="margin-left: 10px" href="{{ route('download', ['file' => $isencao->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
            @else
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Dados economicos') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-left">
                      <div class="form-group row"   style="margin-left: 15px">
                        <table class="table table-ordered table-hover">
                          <tr>
                            <tr>
                              <td style="width: 13rem">
                                Nome:
                              </td>
                              <td style="width: 55rem">
                                <a style="font-weight: bold;"> {{$isencao->nomeDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                CPF:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->cpfDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Parentesco:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->parentescoDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Renda mensal:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->rendaDadoEconomico}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Fonte pagadora:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->fontePagadoraDadoEconomico}} </a>
                              </td>
                            </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Dados economicos do nucleo familiar') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-left">
                      <div class="form-group row"   style="margin-left: 15px">
                        <table class="table table-ordered table-hover">
                          <tr>
                            <tr>
                              <td style="width: 13rem">
                                Nome:
                              </td>
                              <td style="width: 55rem">
                                <a style="font-weight: bold"> {{$isencao->nomeNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                CPF:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->cpfNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Parentesco:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->parentescoNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Renda mensal:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->rendaNucleoFamiliar}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Fonte pagadora:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->fontePagadoraNucleoFamiliar}} </a>
                              </td>
                            </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Dados economicos do nucleo familiar') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-left">
                      <div class="form-group row"   style="margin-left: 15px">
                        <table class="table table-ordered table-hover">
                          <tr>
                            <tr>
                              <td style="width: 13rem">
                                Nome:
                              </td>
                              <td style="width: 55rem">
                                <a style="font-weight: bold"> {{$isencao->nomeNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                CPF:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->cpfNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Parentesco:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->parentescoNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Renda mensal:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->rendaNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Fonte pagadora:
                              </td>
                              <td>
                                <a style="font-weight: bold"> {{$isencao->fontePagadoraNucleoFamiliar1}} </a>
                              </td>
                            </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
            @endif
            <form method="POST" action={{ route('homologarIsencao') }} enctype="multipart/form-data" id="formHomologacao">
              @csrf
              <div class="card" style="width: 70rem; margin-top: 10px; margin-left: -12rem">
                  <div class="card-header">{{ __('Parecer') }}</div>
                  <div class="card-body">
                    <div class="form-group row  justify-content-center">
                        <div class="form-group row" >
                            <div class="col-md-12">

                                <div class="form-group row justify-content-center" style="margin-left: -5rem; font-weight: bold" >
                                  <div class="col-md-12">
                                    <input onclick="selectCheck('aprovado')" type="radio" name="resultado" value="deferida"> Deferida
                                    <input onclick="selectCheck('rejeitado')" type="radio" name="resultado" value="indeferida"> Indeferida
                                  </div>
                                </div>

                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="form-group" id="motivoRejeicao" style=" display: none; margin-left: -12rem">
                <label for="motivoRejeicao" class="col-md-4 col-form-label text-md-right"  style="margin-left: -60px;">{{ __('Motivos da Rejeição:') }}</label>

                <div class="col-md-6" style="margin-left: 10px">
                  <textarea form ="formHomologacao" name="motivoRejeicao" id="taid" cols="115" ></textarea>

                </div>
              </div>
              <div class="form-group row mb-0" style="margin-left: 3rem; margin-top: 10px">
                <div class="col-md-8 offset-md-4">
                  <input type="hidden" name="isencaoId" value="{{$isencao->id}}">
                  <button id="buttonFinalizar" type="submit" class="btn btn-primary btn-primary-lmts" >
                    {{ __('Finalizar') }}
                  </button>

                </div>
              </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" >
function selectCheck(x){
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = ''
  }
}
</script>
@endsection
