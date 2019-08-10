@extends('layouts.app')
@section('titulo','Homologar Recurso')
@section('navbar')
    Homologar Recurso
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
                              A Preg,  {{$recurso->nome}}, CPF {{$recurso->cpf}},
                              <tr>
                              interpões contra o resultado <?php
                              if($recurso->tipo == 'taxa')
                              {
                                echo('da Isenção da Taxa de Inscrição de Processo Seletivo');
                              }else
                              {
                                echo('da seleção para ingresso extra para UFRPE no curso' . $recurso->curso);
                              } ?>, processo Nº {{$recurso->processo}}.
                              <tr>
                              Pelos seguinto motivos:
                              <tr>
                              {{$recurso->motivo}}

                            </div>
                        </div>
                        <form method="POST" action={{ route('homologarRecurso') }} enctype="multipart/form-data">
                              @csrf
                        <div class="form-group row" >
                            <div class="col-md-6">
                                <input type="radio" name="radioRecurso" value="aprovado"> Aprovado
                                <input type="radio" name="radioRecurso" value="rejeitado"> Rejeitado
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <input type="hidden" name="recursoId" value="{{$recurso->id}}">
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
