@extends('layouts.app')
@section('titulo','Inscrição')
@section('navbar')
    Inscrição
@endsection
@section('content')

<style type="text/css">

</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inscrição') }}</div>

                <div class="card-body">
                      <form class="md-form" method="POST" action={{ route('cadastroInscricao') }} enctype="multipart/form-data">
                          @csrf
                        @if($comprovante == 'deferida')
                        <div class="form-group row" >
                          <label for="ENEM" class="col-md-4 col-form-label text-md-right">{{ __('Comprovante: ') }}</label>

                          <div class="col-md-6">
                            Isento de pagamento
                            <input id="comprovante" type="hidden" name="comprovante" value="isento">
                          </div>
                        </div>
                        @else
                        <div class="form-group row" >
                          <label for="comprovante" class="col-md-4 col-form-label text-md-right">{{ __('Comprovante: ') }}</label>

                          <div class="col-md-6">
                            <div class="custom-file">
                              <input onclick="comprovanteSelecionado()"  type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="comprovante" >
                            </div>
                          </div>
                        </div>
                        @endif


                        <div class="card-body" id="formulario" style="display: none;">

                          <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" >{{ __('Tipo de Inscrição:') }}</label>

                            <div class="col-md-6">
                              <input onclick="tipo('reintegracao')" 			   type="radio" name="tipoInscricao" > Reintegração <br>
                              <input onclick="tipo('transferenciaInterna')"  type="radio" name="tipoInscricao" > Transferencia Interna <br>
                              <input onclick="tipo('transferenciaExterna')"  type="radio" name="tipoInscricao" > Transferencia Externa <br>
                              <input onclick="tipo('portadorDeDiploma')" 		 type="radio" name="tipoInscricao" > Portador de Diploma <br>
                            </div>
                          </div>
                          <input type="hidden" name="tipo" value="reintegracao" />
                          <input type="hidden" name="editalId" value="{{$editalId}}" />
                          <input id="tipo" type="hidden" name="tipo" value=""/>

                          <div id="historicoEscolar" class="form-group row" style="display: none" >      <!-- Arquivo historico escolar -->
                              <label for="Historico escolar" class="col-md-4 col-form-label text-md-right">{{ __('Histórico escolar:') }}</label>

                              <div class="col-md-6">
                                <div class="custom-file">
                                  <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="historicoEscolar">
                                </div>
                              </div>
                          </div>

                          <div id="declaracaoDeVinculo" class="form-group row" style="display: none">    <!-- Arquivo declaração de vinculo -->
                              <label for="Declaracao de Viculo" class="col-md-4 col-form-label text-md-right">{{ __('Declaração de vínculo:') }}</label>

                              <div class="col-md-6">
                                <div class="custom-file">
                                  <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="declaracaoDeVinculo">
                                </div>
                              </div>
                          </div>

                          <div id="programaDasDisciplinas" class="form-group row" style="display: none"> <!-- Arquivo programa das disciplinas -->
                              <label for="Programa das Disciplinas" class="col-md-4 col-form-label text-md-right">{{ __('Programa das disciplinas: ') }}</label>

                              <div class="col-md-6">
                                <div class="custom-file">
                                  <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="programaDasDisciplinas" >
                                </div>
                              </div>
                          </div>

                          <div id="curriculo" class="form-group row" style="display: none">              <!-- Arquivo curriculo -->
                              <label for="Curriculo" class="col-md-4 col-form-label text-md-right">{{ __('Currículo:') }}</label>

                              <div class="col-md-6">
                                <div class="custom-file">
                                  <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="curriculo" >
                                </div>
                              </div>
                          </div>

                          <div id="enem" class="form-group row" style="display: none">                   <!-- Arquivo enenm -->
                              <label for="ENEM" class="col-md-4 col-form-label text-md-right">{{ __('Nota no Exame Nacional do Ensino Médio (ENEM): ') }}</label>

                              <div class="col-md-6">
                                <div class="custom-file">
                                  <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="enem" >
                                </div>
                              </div>
                          </div>

                          <div class="form-group row">                                                   <!-- Curso -->
                              <label for="Curso" class="col-md-4 col-form-label text-md-right">{{ __('Curso:') }}</label>

                              <div class="col-md-6">
                                <select name="curso">
                                  <?php foreach ($cursosDisponiveis as $curso) {
                                    if($curso[0] != '#'){
                                      if($curso[0] != ''){
                                        echo('<option value=' . $curso[2] . '>' . $curso[0] . '</option>');
                                      }
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group row">                                                   <!-- Turno -->
                              <label for="Turno" class="col-md-4 col-form-label text-md-right">{{ __('Turno:') }}</label>

                              <div class="col-md-6">
                                <select name="turno">
                                  <option value="Manhã">Manhã</option>
                                  <option value="Tarde">Tarde</option>
                                  <option value="Noite">Noite</option>
                                  <option value="Especial (EAD)">Especial (EAD)</option>
                                </select>
                              </div>
                          </div>

                          <div class="form-group row">                                                   <!-- Polo -->
                              <label for="polo" class="field a-field a-field_a2 page__field" style="margin-left: 100px">
                                  <input id="polo" type="text" name="polo" autofocus class="field__input a-field__input" placeholder="Polo*:" style="width: 30rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Polo*:</span>
                                  </span>
                              </label>
                          </div>

                          <div class="form-group row">                                                   <!-- Curso de origem -->
                              <label for="cursoDeOrigem" class="field a-field a-field_a2 page__field" style="margin-left: 100px">
                                  <input id="cursoDeOrigem" type="text" name="cursoDeOrigem" autofocus class="field__input a-field__input" placeholder="Curso de Origem:" style="width: 30rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Curso de Origem:</span>
                                  </span>
                              </label>
                          </div>

                          <div class="form-group row">                                                   <!-- Instituição de origem -->
                              <label for="instituicaoDeOrigem" class="field a-field a-field_a2 page__field" style="margin-left: 100px">
                                  <input id="instituicaoDeOrigem" type="text" name="instituicaoDeOrigem" autofocus class="field__input a-field__input" placeholder="Instituição de Origem:" style="width: 30rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Instituição de Origem:</span>
                                  </span>
                              </label>
                          </div>

                          <div class="form-group row">                                                   <!-- Natureza da IES -->
                              <label for="naturezaDaIes" class="field a-field a-field_a2 page__field" style="margin-left: 100px">
                                  <input id="naturezaDaIes" type="text" name="naturezaDaIes" autofocus class="field__input a-field__input" placeholder="Natureza da IES:" style="width: 30rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Natureza da IES:</span>
                                  </span>
                              </label>
                          </div>

                          <div class="form-group row">                                                    <!-- Endereço da IES -->
                              <label for="enderecoIes" class="field a-field a-field_a2 page__field" style="margin-left: 100px">
                                  <input id="enderecoIes" type="text" name="enderecoIes" autofocus class="field__input a-field__input" placeholder="Endereço IES:" style="width: 30rem;">
                                  <span class="a-field__label-wrap">
                                    <span class="a-field__label">Endereço IES:</span>
                                  </span>
                              </label>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button id="button" type="submit" class="btn btn-primary btn-primary-lmts" disabled="true">
                                      {{ __('Cadastrar Inscrição') }}
                                  </button>

                              </div>
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

function comprovanteSelecionado(){
  document.getElementById("formulario").style.display = "";
}

function tipo(x) {
	if (x == "reintegracao") {
   document.getElementById("tipo").value = "reintegracao";
   document.getElementById("historicoEscolar").style.display = "";
   document.getElementById("declaracaoDeVinculo").style.display = "none";
   document.getElementById("enem").style.display = "none";
   document.getElementById("curriculo").style.display = "none";
   document.getElementById("programaDasDisciplinas").style.display = "none";
   document.getElementById("button").disabled = false;
   if(document.getElementById("comprovante").value == 'isento'){
     document.getElementById("formulario").style.display = "";
   }

	}
	if (x == "transferenciaInterna") {
    document.getElementById("tipo").value = "transferenciaInterna";
    document.getElementById("historicoEscolar").style.display = "";
    document.getElementById("declaracaoDeVinculo").style.display = "";
    document.getElementById("enem").style.display = "none";
    document.getElementById("curriculo").style.display = "none";
    document.getElementById("programaDasDisciplinas").style.display = "none";
    document.getElementById("button").disabled = false;
    if(document.getElementById("comprovante").value == 'isento'){
      document.getElementById("formulario").style.display = "";
    }
	}
	if (x == "transferenciaExterna") {
    document.getElementById("tipo").value = "transferenciaExterna";
    document.getElementById("historicoEscolar").style.display = "";
    document.getElementById("declaracaoDeVinculo").style.display = "";
    document.getElementById("enem").style.display = "none";
    document.getElementById("curriculo").style.display = "";
    document.getElementById("programaDasDisciplinas").style.display = "";
    document.getElementById("button").disabled = false;
    if(document.getElementById("comprovante").value == 'isento'){
      document.getElementById("formulario").style.display = "";
    }
	}
	if (x == "portadorDeDiploma") {
    document.getElementById("tipo").value = "portadorDeDiploma";
    document.getElementById("historicoEscolar").style.display = "";
    document.getElementById("declaracaoDeVinculo").style.display = "";
    document.getElementById("enem").style.display = "";
    document.getElementById("curriculo").style.display = "none";
    document.getElementById("programaDasDisciplinas").style.display = "";
    document.getElementById("button").disabled = false;
    if(document.getElementById("comprovante").value == 'isento'){
      document.getElementById("formulario").style.display = "";
    }
	}
}


</script>


    @endsection
