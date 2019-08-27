@extends('layouts.app')
@section('titulo','Homologar Isencao')
@section('navbar')
    Homologar Isencao
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
                <div class="card-header">{{ __('Homologar recurso') }}</div>
                <div class="card-body">
                  <div class="form-group row">
                        <div class="form-group row"  >
                            <div class="col-md-6">
                              DECLARAÇÃO DO CANDIDATO NOS TERMOS DA LEI: {{$isencao->tipo}}
                              <tr><tr>
                              Dados economicos:
                              Nome: {{$isencao->nomeDadoEconomico}}<tr>
                              CPF: {{$isencao->cpfDadoEconomico}}<tr>
                              Parentesco: {{$isencao->parentescoDadoEconomico}}<tr>
                              Renda mensal: {{$isencao->rendaDadoEconomico}}<tr>
                              Fonte pagadora: {{$isencao->fontePagadoraDadoEconomico}}<tr>
                              <tr><tr>
                              Nucleo Familiar:
                              Nome: {{$isencao->nomeNucleoFamiliar}}<tr>
                              CPF: {{$isencao->cpfNucleoFamiliar}}<tr>
                              Parentesco: {{$isencao->parentescoNucleoFamiliar}}<tr>
                              Renda mensal: {{$isencao->rendaNucleoFamiliar}}<tr>
                              Fonte pagadora: {{$isencao->fontePagadoraNucleoFamiliar}}<tr><tr>

                              Nome: {{$isencao->nomeNucleoFamiliar1}}<tr>
                              CPF: {{$isencao->cpfNucleoFamiliar1}}<tr>
                              Parentesco: {{$isencao->parentescoNucleoFamiliar1}}<tr>
                              Renda mensal: {{$isencao->rendaNucleoFamiliar1}}<tr>
                              Fonte pagadora: {{$isencao->fontePagadoraNucleoFamiliar1}}<tr>
                              <tr>

                            </div>
                        </div>
                        <form method="POST" action={{ route('homologarIsencao') }} enctype="multipart/form-data">
                              @csrf
                        <div class="form-group row" >
                            <div class="col-md-6">
                                <input type="radio" name="motivo" value="renda"> I - o candidato declarar-se impossibilitado de
arcar com o pagamento da taxa de inscrição e
comprovar renda familiar mensal igual inferior a
um salário mínimo e meio;
                                <input type="radio" name="motivo" value="ensino"> II – ter cursado o ensino médio completo em
escola da rede pública ou como bolsista integral em
escola da rede privada.o
                            </div>
                        </div>

                        <div class="form-group row" >
                            <div class="col-md-6">
                                <input type="radio" name="resultado" value="deferida"> Deferida
                                <input type="radio" name="resultado" value="indeferida"> Indeferida
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <input type="hidden" name="isencaoId" value="{{$isencao->id}}">
                                <button id="buttonFinalizar" type="submit" class="btn btn-primary" >
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
