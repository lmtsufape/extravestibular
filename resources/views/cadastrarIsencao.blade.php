@extends('layouts.app')
@section('titulo','Requerimento de Isenção')
@section('navbar')
    Home/Detalhes do edital/Requerimento de Isenção
@endsection
@section('content')

<div class="container"  style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action={{ route('cadastroIsencao') }} enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
            <div class="card" style="width: 70rem; margin-top: 10px;">
                <div class="card-header">{{ __('Declaração do Candidato nos Termos da Lei (Obrigatório)') }}</div>
                <div class="card-body">
                      <div class="card-body">
                          <div class="form-group row justify-content-center">  <!-- Declaração-->
                            <div class="col-md-11" style="font-weight: bold;">
                              <a style="width: 30rem">
                                {{__('O(a) candidato(a) declara, sob as penas da lei e da perda dos direitos decorrentes da sua inscrição,
                                serem verdadeiras as informações, os dados e os documentos apresentados, prontificando-se a fornecer outros
                                documentos comprobatórios, sempre que solicitados pela Universidade Federal Rural de Pernambuco.Nos termos da lei, o candidato se enquadra na situação:')}}
                              </a>
                              <br>
                              <br>
                              <input id="checkboxRenda" onclick="escolher('renda')"  value="rendaFamiliar" type="checkbox" > Renda familiar per capita igual ou inferior a um salário mínimo e meio <br>
                              <input id="checkboxEnsino" onclick="escolher('ensino')"  value="ensinoMedio" type="checkbox" > Ter cursado o ensino médio completo em escola da rede pública ou como bolsista integral em escola da rede privada. <br>
                            </div>
                          </div>
                      </div>
                </div>
            </div>

            <div id="historicoEscolar" class="card" style="width: 70rem; margin-top: 10px; display: none">
                <div class="card-header">{{ __('Historico Escolar (Obrigatório)') }}</div>
                <div class="card-body">
                      <div class="card-body">
                        <div class="form-group row">      <!-- Arquivo historico escolar -->
                          <label for="Historico escolar" class="col-md-4 col-form-label text-md-right">{{ __('Histórico escolar:') }}</label>

                          <div class="col-md-6">
                            <div class="custom-file">
                              <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="historicoEscolar">
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>



            <div id="dadosEconomicos" class="card" style="width: 70rem; margin-top: 10px; display: none">
                <div class="card-header">{{ __('Dados Econômicos (Obrigatório)') }}</div>
                <div class="card-body">
                      <div class="card-body">
                          <div class="form-group row justify-content-center">  <!-- Nome | CPF-->
                              <label for="nomeDadoEconomico" class="field a-field a-field_a2 page__field">
                                  <input id="nomeDadoEconomico" type="text" name="nomeDadoEconomico" autofocus class="field__input a-field__input" placeholder="Nome" style="width: 45rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Nome</span>
                                  </span>
                              </label>
                              <label for="cpfDadoEconomico" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="cpfDadoEconomico" type="text" name="cpfDadoEconomico" autofocus class="field__input a-field__input" placeholder="CPF" style="width: 12rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">CPF</span>
                                </span>
                              </label>
                          </div>

                          <div class="form-group row" style="margin-left: 50px;">  <!-- Parentesco/Renda/Fonte -->
                              <label for="parentescoDadoEconomico" class="field a-field a-field_a2 page__field" style=" margin-left: 0px;">
                                <input id="parentescoDadoEconomico" type="text" name="parentescoDadoEconomico" autofocus class="field__input a-field__input" placeholder="Parentesco" style="width: 22rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Parentesco</span>
                                </span>
                              </label>
                              <label for="rendaDadoEconomico" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="rendaDadoEconomico" type="text" name="rendaDadoEconomico" autofocus class="field__input a-field__input" placeholder="Renda" style="width: 12rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Renda</span>
                                </span>
                              </label>
                              <label for="fontePagadoraDadoEconomico" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="fontePagadoraDadoEconomico" type="text" name="fontePagadoraDadoEconomico" autofocus class="field__input a-field__input" placeholder="Fonte Pagadora" style="width: 22rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Fonte Pagadora</span>
                                </span>
                              </label>
                          </div>
                      </div>
                </div>
            </div>
            <div id="nucleo" class="card" style="width: 70rem; margin-top: 10px; display: none">
                <div class="card-header">{{ __('Dados Econômicos do Núcleo Familiar (Opcional)') }}</div>
                <div class="card-body">
                      <div class="card-body">
                          <div class="form-group row justify-content-center">  <!-- Nome | CPF-->
                              <label for="nomeNucleoFamiliar" class="field a-field a-field_a2 page__field">
                                  <input id="nomeNucleoFamiliar" type="text" name="nomeNucleoFamiliar" autofocus class="field__input a-field__input" placeholder="Nome" style="width: 45rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Nome</span>
                                  </span>
                              </label>
                              <label for="cpfNucleoFamiliar" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="cpfNucleoFamiliar" type="text" name="cpfNucleoFamiliar" autofocus class="field__input a-field__input" placeholder="CPF" style="width: 12rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">CPF</span>
                                </span>
                              </label>
                          </div>

                          <div class="form-group row" style="margin-left: 50px;">  <!-- Parentesco/Renda/Fonte -->
                              <label for="parentescoNucleoFamiliar" class="field a-field a-field_a2 page__field" style=" margin-left: 0px;">
                                <input id="parentescoNucleoFamiliar" type="text" name="parentescoNucleoFamiliar" autofocus class="field__input a-field__input" placeholder="Parentesco" style="width: 22rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Parentesco</span>
                                </span>
                              </label>
                              <label for="rendaNucleoFamiliar" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="rendaNucleoFamiliar" type="text" name="rendaNucleoFamiliar" autofocus class="field__input a-field__input" placeholder="Renda" style="width: 12rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Renda</span>
                                </span>
                              </label>
                              <label for="fontePagadoraNucleoFamiliar" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="fontePagadoraNucleoFamiliar" type="text" name="fontePagadoraNucleoFamiliar" autofocus class="field__input a-field__input" placeholder="Fonte Pagadora" style="width: 22rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Fonte Pagadora</span>
                                </span>
                              </label>
                          </div>
                      </div>
                </div>
            </div>
            <div id="nucleo1" class="card" style="width: 70rem; margin-top: 10px; display: none">
                <div class="card-header">{{ __('Dados Econômicos do Núcleo Familiar (Opcional)') }}</div>
                <div class="card-body">
                      <div class="card-body">
                          <div class="form-group row justify-content-center">  <!-- Nome | CPF-->
                              <label for="nomeNucleoFamiliar1" class="field a-field a-field_a2 page__field">
                                  <input id="nomeNucleoFamiliar1" type="text" name="nomeNucleoFamiliar1" autofocus class="field__input a-field__input" placeholder="Nome" style="width: 45rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Nome</span>
                                  </span>
                              </label>
                              <label for="cpfNucleoFamiliar1" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="cpfNucleoFamiliar1" type="text" name="cpfNucleoFamiliar1" autofocus class="field__input a-field__input" placeholder="CPF" style="width: 12rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">CPF</span>
                                </span>
                              </label>
                          </div>

                          <div class="form-group row" style="margin-left: 50px;">  <!-- Parentesco/Renda/Fonte -->
                              <label for="parentescoNucleoFamiliar1" class="field a-field a-field_a2 page__field" style=" margin-left: 0px;">
                                <input id="parentescoNucleoFamiliar1" type="text" name="parentescoNucleoFamiliar1" autofocus class="field__input a-field__input" placeholder="Parentesco" style="width: 22rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Parentesco</span>
                                </span>
                              </label>
                              <label for="rendaNucleoFamiliar1" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="rendaNucleoFamiliar1" type="text" name="rendaNucleoFamiliar1" autofocus class="field__input a-field__input" placeholder="Renda" style="width: 12rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Renda</span>
                                </span>
                              </label>
                              <label for="fontePagadoraNucleoFamiliar1" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                                <input id="fontePagadoraNucleoFamiliar1" type="text" name="fontePagadoraNucleoFamiliar1" autofocus class="field__input a-field__input" placeholder="Fonte Pagadora" style="width: 22rem;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Fonte Pagadora</span>
                                </span>
                              </label>
                          </div>
                      </div>
                </div>
            </div>

            <div class="form-group row mb-0" style="margin-left: 20rem; margin-top: 10px">
                <div class="col-md-8 offset-md-4">
                  <input type="hidden" name="editalId" value="{{$editalId}}">
                  <input id="tipo" type="hidden" name="tipo" value="">
                    <button type="submit" class="btn btn-primary btn-primary-lmts">
                        {{ __('Finalizar') }}
                    </button>

                </div>
            </div>
        </div>
      </form>
    </div>
</div>

<script type="text/javascript" >

function escolher(x) {
	if (x == "renda") {
    if(document.getElementById("checkboxRenda").checked == true){
      document.getElementById("dadosEconomicos").style.display = "";
      document.getElementById("nucleo").style.display = "";
      document.getElementById("nucleo1").style.display = "";
    }
    else{
      document.getElementById("dadosEconomicos").style.display = "none";
      document.getElementById("nucleo").style.display = "none";
      document.getElementById("nucleo1").style.display = "none";
    }

	}
	if (x == "ensino") {
    if(document.getElementById("checkboxEnsino").checked == true){
      document.getElementById("historicoEscolar").style.display = "";
    }
    else{
      document.getElementById("historicoEscolar").style.display = "none";

    }
	}
  if(document.getElementById("checkboxRenda").checked == true && document.getElementById("checkboxEnsino").checked == true){
    document.getElementById("tipo").value = "ambos";
  }
  else if (document.getElementById("checkboxRenda").checked == true ) {
    document.getElementById("tipo").value = "rendaFamiliar";
  }
  else{
    document.getElementById("tipo").value = "ensinoMedio";
  }
}

</script>

@endsection
