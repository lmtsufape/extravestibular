@extends('layouts.app')
@section('titulo','Inscrição')
@section('navbar')
    Inscrição
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inscrição') }}</div>

                <div class="card-body">
                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de pedido') }}</label>

                          <div class="col-md-6">
                            <input onclick="tipo('reintegracao')" 			   type="radio" name="tipoInscricao" > Reintegração <br>
                            <input onclick="tipo('transferenciaInterna')"  type="radio" name="tipoInscricao" > Transferencia Interna <br>
                            <input onclick="tipo('transferenciaExterna')"  type="radio" name="tipoInscricao" > Transferencia Externa <br>
                            <input onclick="tipo('portadorDeDiploma')" 		 type="radio" name="tipoInscricao" > Portador de Diploma <br>
                          </div>
                      </div>
                      <div class="card-body" id="formulario" style="display: none;">
                        <form method="POST" action={{ route('cadastroInscricao') }} enctype="multipart/form-data">
                              @csrf
                          <input type="hidden" name="tipo" value="reintegracao" />
                          <input type="hidden" name="editalId" value="{{$editalId}}" />
                          <input id="tipo" type="hidden" name="tipo" value=""/>

                          <div id="historicoEscolar" class="form-group row" style="display: none">
                              <label for="Historico escolar" class="col-md-4 col-form-label text-md-right">{{ __('Histórico escolar:') }}</label>

                              <div class="col-md-6">
                                  <input type="file" name="historicoEscolar" >
                              </div>
                          </div>

                          <div id="declaracaoDeVinculo" class="form-group row" style="display: none">
                              <label for="Declaracao de Viculo" class="col-md-4 col-form-label text-md-right">{{ __('Declaração de vínculo:)') }}</label>

                              <div class="col-md-6">
                                  <input type="file" name="declaracaoDeVinculo" >
                              </div>
                          </div>

                          <div id="programaDasDisciplinas" class="form-group row" style="display: none">
                              <label for="Programa das Disciplinas" class="col-md-4 col-form-label text-md-right">{{ __('Programa das disciplinas: ') }}</label>

                              <div class="col-md-6">
                                  <input type="file" name="programaDasDisciplinas" >
                              </div>
                          </div>

                          <div id="curriculo" class="form-group row" style="display: none">
                              <label for="Curriculo" class="col-md-4 col-form-label text-md-right">{{ __('Currículo:') }}</label>

                              <div class="col-md-6">
                                  <input type="file" name="curriculo" >
                              </div>
                          </div>

                          <div id="enem" class="form-group row" style="display: none">
                              <label for="ENEM" class="col-md-4 col-form-label text-md-right">{{ __('Nota no Exame Nacional do Ensino Médio (ENEM): ') }}</label>

                              <div class="col-md-6">
                                  <input type="file" name="enem" >
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="Curso" class="col-md-4 col-form-label text-md-right">{{ __('Curso') }}</label>

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

                          <div class="form-group row">
                              <label for="Turno" class="col-md-4 col-form-label text-md-right">{{ __('Turno') }}</label>

                              <div class="col-md-6">
                                <select name="turno">
                                  <option value="Manhã">Manhã</option>
                                  <option value="Tarde">Tarde</option>
                                  <option value="Noite">Noite</option>
                                  <option value="Especial (EAD)">Especial (EAD)</option>
                                </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="Polo" class="col-md-4 col-form-label text-md-right">{{ __('Polo') }}</label>

                              <div class="col-md-6">
                                <input id="polo" type="text" name="polo" autofocus>

                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="Curso de Origem" class="col-md-4 col-form-label text-md-right">{{ __('Curso de Origem') }}</label>

                              <div class="col-md-6">
                                <input id="cursoDeOrigem" type="text" name="cursoDeOrigem" autofocus>

                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="Instituicaoo de Origem" class="col-md-4 col-form-label text-md-right">{{ __('Instituição de Origem') }}</label>

                              <div class="col-md-6">
                                <input id="instituicaoDeOrigem" type="text" name="instituicaoDeOrigem" autofocus>

                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="Natureza da Ies" class="col-md-4 col-form-label text-md-right">{{ __('Natureza da Ies') }}</label>

                              <div class="col-md-6">
                                <input id="naturezaDaIes" type="text" name="naturezaDaIes" autofocus>

                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="Endereco Ies" class="col-md-4 col-form-label text-md-right">{{ __('Endereço Ies') }}</label>

                              <div class="col-md-6">
                                <input id="enderecoIes" type="text" name="enderecoIes" autofocus>

                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      {{ __('Cadastrar Inscrição') }}
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
