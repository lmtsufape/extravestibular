@extends('layouts.app')
@section('titulo','Homologar Isencao')
@section('navbar')
    Homologar Isencao
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Homologar recurso') }}</div>
                <div class="card-body">
                  <div class="form-group row">
                        <div class="form-group row"  >
                            <div class="col-md-12">
                              DECLARAÇÃO DO CANDIDATO NOS TERMOS DA LEI:<br>
                              <a style="font-weight: bold">
                              @if($isencao->tipo)
                                I - o candidato declarar-se impossibilitado de arcar com o pagamento da taxa de inscrição e comprovar renda familiar mensal igual inferior a um salário mínimo e meio.
                              @else
                                II – ter cursado o ensino médio completo em escola da rede pública ou como bolsista integral em escola da rede privada.
                              @endif
                              </a>
                              <br><br>
                              Dados economicos:<br>
                              Nome: {{$isencao->nomeDadoEconomico}}<br>
                              CPF: {{$isencao->cpfDadoEconomico}}<br>
                              Parentesco: {{$isencao->parentescoDadoEconomico}}<br>
                              Renda mensal: {{$isencao->rendaDadoEconomico}}<br>
                              Fonte pagadora: {{$isencao->fontePagadoraDadoEconomico}}<br>
                              <br><br>
                              Nucleo Familiar:
                              Nome: {{$isencao->nomeNucleoFamiliar}}<br>
                              CPF: {{$isencao->cpfNucleoFamiliar}}<br>
                              Parentesco: {{$isencao->parentescoNucleoFamiliar}}<br>
                              Renda mensal: {{$isencao->rendaNucleoFamiliar}}<br>
                              Fonte pagadora: {{$isencao->fontePagadoraNucleoFamiliar}}<br><br>

                              Nome: {{$isencao->nomeNucleoFamiliar1}}<br>
                              CPF: {{$isencao->cpfNucleoFamiliar1}}<br>
                              Parentesco: {{$isencao->parentescoNucleoFamiliar1}}<br>
                              Renda mensal: {{$isencao->rendaNucleoFamiliar1}}<br>
                              Fonte pagadora: {{$isencao->fontePagadoraNucleoFamiliar1}}<br>
                              <br>

                            </div>
                        </div>
                        <form method="POST" action={{ route('homologarIsencao') }} enctype="multipart/form-data">
                              @csrf
                        <div class="form-group row" >
                            <div class="col-md-" style="margin-left: 5rem">
                                <input type="radio" name="motivo" value="renda"> I - o candidato declarar-se impossibilitado de
arcar com o pagamento da taxa de inscrição e
comprovar renda familiar mensal igual inferior a
um salário mínimo e meio;<br>
                                <input type="radio" name="motivo" value="ensino"> II – ter cursado o ensino médio completo em
escola da rede pública ou como bolsista integral em
escola da rede privada.
                            </div>
                        </div>

                        <div class="form-group row " style="margin-left: 15rem; font-weight: bold" >
                            <div class="col-md-6">
                                <input type="radio" name="resultado" value="deferida"> Deferida
                                <input type="radio" name="resultado" value="indeferida"> Indeferida
                            </div>
                        </div>

                        <div class="form-group row mb-0" style="margin-left: 3rem">
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

    </div>
</div>


<script type="text/javascript" >

</script>
@endsection
