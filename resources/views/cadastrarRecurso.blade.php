@extends('layouts.app')
@section('titulo','Requerimento de Recurso')
@section('navbar')
    Requerimento de Recurso
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Requerimento de Recurso') }}</div>

                <div class="card-body">
                      <div class="card-body">
                        <form method="POST" action={{ route('cadastroRecurso') }} enctype="multipart/form-data">
                              @csrf
                          <input type="hidden" name="editalId" value="{{$editalId}}" />

                          <div class="form-group row">
                              <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                              <div class="col-md-6">
                                <input id="nome" type="text" name="nome" autofocus>

                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                              <div class="col-md-6">
                                <input id="cpf" type="text" name="cpf" autofocus>

                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('interpõe recurso contra o resultado:') }}</label>

                              <div class="col-md-6">
                                <select name="tipo">
                                  <option value="taxa">Isenção da Taxa de Inscrição de Processo Seletivo</option>
                                  <option value="classificacao">seleção para ingresso extra</option>
                                </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nProcesso" class="col-md-4 col-form-label text-md-right">{{ __('Processo Nº') }}</label>

                              <div class="col-md-6">
                                <input id="nProcesso" type="text" name="nProcesso" autofocus>

                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo') }}</label>

                              <div class="col-md-6">
                                <input id="motivo" type="text" name="motivo" autofocus>

                              </div>
                          </div>

                          <div  class="form-group row" >
                              <label for="data" class="col-md-4 col-form-label text-md-right">{{ __('Data') }}</label>

                              <div class="col-md-6">
                                  <input type="date" name="data" >
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      {{ __('Cadastrar Recurso') }}
                                  </button>

                              </div>
                          </div>

                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" >
function tipo(x) {
	if (x == "reintegracao") {
   document.getElementById("tipo").value = "reintegracao";
   document.getElementById("formulario").style.display = "";
   document.getElementById("historicoEscolar").style.display = "";
   document.getElementById("declaracaoDeVinculo").style.display = "none";
   document.getElementById("enem").style.display = "none";
   document.getElementById("curriculo").style.display = "none";
   document.getElementById("programaDasDisciplinas").style.display = "none";
	}
	if (x == "transferenciaInterna") {
    document.getElementById("tipo").value = "transferenciaInterna";
    document.getElementById("formulario").style.display = "";
    document.getElementById("historicoEscolar").style.display = "";
    document.getElementById("declaracaoDeVinculo").style.display = "";
    document.getElementById("enem").style.display = "none";
    document.getElementById("curriculo").style.display = "none";
    document.getElementById("programaDasDisciplinas").style.display = "none";
	}
	if (x == "transferenciaExterna") {
    document.getElementById("tipo").value = "transferenciaExterna";
    document.getElementById("formulario").style.display = "";
    document.getElementById("historicoEscolar").style.display = "";
    document.getElementById("declaracaoDeVinculo").style.display = "";
    document.getElementById("enem").style.display = "none";
    document.getElementById("curriculo").style.display = "";
    document.getElementById("programaDasDisciplinas").style.display = "";
	}
	if (x == "portadorDeDiploma") {
    document.getElementById("tipo").value = "portadorDeDiploma";
    document.getElementById("formulario").style.display = "";
    document.getElementById("historicoEscolar").style.display = "";
    document.getElementById("declaracaoDeVinculo").style.display = "";
    document.getElementById("enem").style.display = "";
    document.getElementById("curriculo").style.display = "none";
    document.getElementById("programaDasDisciplinas").style.display = "";
	}
}


</script>


    @endsection
