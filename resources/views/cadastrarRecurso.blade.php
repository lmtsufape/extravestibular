@extends('layouts.app')
@section('titulo','Requerimento de Recurso')
@section('navbar')
    Home / Detalhes do edital / Requerimento de Recurso
@endsection
@section('content')

<div class="container" style="width: 100rem;margin-left: 200px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 70rem;">
                <div class="card-header">{{ __('Requerimento de Recurso') }}</div>
                <div class="card-body">
                      <div class="card-body">
                        <form method="POST" action={{ route('cadastroRecurso') }} enctype="multipart/form-data" id="formRecurso">
                              @csrf
                          <input type="hidden" name="editalId" value="{{$editalId}}" />
                          <input type="hidden" name="tipoRecurso" value="{{$tipoRecurso}}" />

                          <div class="form-group row justify-content-center">  <!-- Nome | CPF-->
                            <label for="nome" class="field a-field a-field_a2 page__field">
                                <input id="nome" type="text" name="nome" autofocus class="field__input a-field__input" disabled value="{{$dados->nome}}" placeholder="Nome" style="width: 45rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Nome</span>
                                </span>
                            </label>
                            <label for="cpf" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="cpf" type="text" name="cpf" autofocus class="field__input a-field__input" disabled value="{{$dados->cpf}}" placeholder="CPF" style="width: 12rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">CPF</span>
                                </span>
                            </label>
                          </div>


                          <div class="form-group">
                              <label for="motivo" class="col-md-4 col-form-label text-md-right"  style="margin-left: -15rem">{{ __('Motivo:') }}</label>

                              <div class="col-md-6" style="margin-left: 30px">
                                <textarea form ="formRecurso" name="motivo" id="taid" cols="100" ></textarea>

                              </div>
                          </div>


                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-primary btn-primary-lmts">
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
