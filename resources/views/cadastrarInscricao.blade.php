@extends('layouts.app')
@section('titulo','Inscrição')
@section('navbar')
    Home/Detalhes do Edital/Fazer Inscrição
@endsection
@section('content')

<style type="text/css">

</style>


<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form class="md-form" method="POST" action={{ route('cadastroInscricao') }} enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
            <div class="card" style=" width: 70rem;">
                <div class="card-header">{{ __('Comprovante') }}</div>
                <div class="card-body">
                  @if($comprovante == 'deferida')
                    <div class="form-group row" >
                      <label for="ENEM" class="col-md-4 col-form-label text-md-right">{{ __('Comprovante: ') }}</label>

                      <div class="col-md-6">
                        Isento de pagamento
                        <input id="comprovante" type="hidden" name="comprovante" value="isento">
                      </div>
                    </div>
                  @else
                    <a style="font-weight: bold; margin-left: 15rem"> Selecione o comprovante gerado pelo pagamento da taxa do tipo de inscrição: </a>
                    <div class="form-group row" >
                      <label style="margin-top: 10px" for="comprovante" class="col-md-4 col-form-label text-md-center">{{ __('Comprovante: ') }}</label>

                      <div class="col-md-6">
                        <div class="custom-file" style="width: 45rem; margin-left: -9rem; margin-top: 10px">
                          <input id='elementoComprovante'  onclick="comprovanteSelecionado()"  type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="comprovante" >
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
            </div>
            <div id="formulario" style="display: <?php if($comprovante != 'deferida') { echo('none'); }?> ; width: 70rem; margin-top: 10px">
              <div class="card" style="">
                  <div class="card-header">{{ __('Inscrição') }}</div>
                  <div class="card-body">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right" >{{ __('Tipo de Inscrição:') }}</label>
                        <div class="col-md-6">
                          <input onclick="escolherTipo('reintegracao')" 			   type="radio" name="tipoInscricao" > Reintegração <br>
                          <input onclick="escolherTipo('transferenciaInterna')"  type="radio" name="tipoInscricao" > Transferencia Interna <br>
                          <input onclick="escolherTipo('transferenciaExterna')"  type="radio" name="tipoInscricao" > Transferencia Externa <br>
                          <input onclick="escolherTipo('portadorDeDiploma')" 		 type="radio" name="tipoInscricao" > Portador de Diploma <br>
                        </div>
                      </div>                                                 <!-- TIPO -->
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
                          @error('historicoEscolar')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div id="declaracaoDeVinculo" class="form-group row" style="display: none">    <!-- Arquivo declaração de vinculo -->
                          <label for="Declaracao de Viculo" class="col-md-4 col-form-label text-md-right">{{ __('Declaração de vínculo:') }}</label>

                          <div class="col-md-6">
                            <div class="custom-file">
                              <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="declaracaoDeVinculo">
                            </div>
                          </div>
                          @error('declaracaoDeVinculo')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div id="programaDasDisciplinas" class="form-group row" style="display: none"> <!-- Arquivo programa das disciplinas -->
                          <label for="Programa das Disciplinas" class="col-md-4 col-form-label text-md-right">{{ __('Programa das disciplinas: ') }}</label>

                          <div class="col-md-6">
                            <div class="custom-file">
                              <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="programaDasDisciplinas" >
                            </div>
                          </div>
                          @error('programaDasDisciplinas')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div id="curriculo" class="form-group row" style="display: none">              <!-- Arquivo curriculo -->
                          <label for="Curriculo" class="col-md-4 col-form-label text-md-right">{{ __('Currículo:') }}</label>

                          <div class="col-md-6">
                            <div class="custom-file">
                              <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="curriculo" >
                            </div>
                          </div>
                          @error('curriculo')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div id="enem" class="form-group row" style="display: none">                   <!-- Arquivo enenm -->
                          <label for="ENEM" class="col-md-4 col-form-label text-md-right">{{ __('Nota no Exame Nacional do Ensino Médio (ENEM): ') }}</label>

                          <div class="col-md-6">
                            <div class="custom-file">
                              <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="enem" >
                            </div>
                          </div>
                          @error('enem')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div class="form-group row">                                                   <!-- Curso -->
                          <label for="Curso" class="col-md-4 col-form-label text-md-right">{{ __('Curso pretendido:') }}</label>

                          <div class="col-md-6">
                            <select name="curso">
                              <?php foreach ($cursosDisponiveis as $curso) {
                                if($curso[0] != '#'){
                                  if($curso[0] != ''){
                                    echo('<option value=' . $curso[0] . '>' . $curso[0] . '</option>');
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
                          <label for="polo" class="field a-field a-field_a2 page__field" style="margin-left: 100px; width: 55rem">
                              <input id="polo" type="text" name="polo" autofocus class="form-control @error('polo') is-invalid @enderror field__input a-field__input" placeholder="Polo (apenas aluno EAD):" style="width: 55rem;" value="{{ old('polo') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Polo (apenas aluno EAD):</span>
                              </span>
                          </label>
                          @error('polo')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                    </div>
                  </div>
              </div>
              <div class="card" style=" width: 70rem; ; margin-top: 10px">
                  <div class="card-header">{{ __('Dados da IES') }}</div>
                  <div class="card-body">
                    <div class="card-body">
                      <div class="form-group row">                                                   <!-- Curso de origem -->
                        <label for="cursoDeOrigem" class="field a-field a-field_a2 page__field" style="margin-left: 100px; width: 55rem">
                          <input id="cursoDeOrigem" type="text" name="cursoDeOrigem" autofocus class="form-control @error('cursoDeOrigem') is-invalid @enderror field__input a-field__input" placeholder="Curso de Origem:" style="width: 55rem;" value="{{ old('cursoDeOrigem') }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Curso de Origem:</span>
                          </span>
                        </label>
                        @error('cursoDeOrigem')
                        <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="form-group row">                                                   <!-- Instituição de origem -->
                        <label for="instituicaoDeOrigem" class="field a-field a-field_a2 page__field" style="margin-left: 100px; width: 55rem">
                          <input id="instituicaoDeOrigem" type="text" name="instituicaoDeOrigem" autofocus class="form-control @error('instituicaoDeOrigem') is-invalid @enderror field__input a-field__input" placeholder="Instituição de Origem:" style="width: 55rem;" value="{{ old('instituicaoDeOrigem') }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Instituição de Origem:</span>
                          </span>
                        </label>
                        @error('instituicaoDeOrigem')
                        <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="form-group row">                                                   <!-- Natureza da IES -->
                        <label for="naturezaDaIes" class="field a-field a-field_a2 page__field" style="margin-left: 100px; width: 55rem">
                          <input id="naturezaDaIes" type="text" name="naturezaDaIes" autofocus class="form-control @error('naturezaDaIes') is-invalid @enderror field__input a-field__input" placeholder="Natureza da IES:" style="width: 55rem;"  value="{{ old('naturezaDaIes') }}">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Natureza da IES:</span>
                          </span>
                        </label>
                        @error('naturezaDaIes')
                        <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="form-group row justify-content-center">  <!-- Endereço/Nº -->
                        <div>
                          <label for="endereco" class="field a-field a-field_a2 page__field">
                              <input id="endereco" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Endereço" style="width: 53rem;" value="{{ old('endereco') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Endereço</span>
                              </span>
                          </label>
                          @error('endereco')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div>
                          <label for="num" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                              <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Nº" style="width: 4rem;" value="{{ old('num') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Nº</span>
                              </span>
                          </label>
                          @error('num')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row justify-content-center">  <!-- Bairro/Cidade/Uf -->
                        <div>
                          <label for="bairro" class="field a-field a-field_a2 page__field" >
                              <input id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro" style="width: 27rem;" value="{{ old('bairro') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Bairro</span>
                              </span>
                          </label>
                          @error('bairro')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div>
                          <label for="cidade" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                              <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade" style="width: 25rem;" value="{{ old('cidade') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Cidade</span>
                              </span>
                          </label>
                          @error('cidade')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div>
                          <label for="uf" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                              <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF" style="width: 4rem;" value="{{ old('uf') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">UF</span>
                              </span>
                          </label>
                          @error('uf')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                    </div>
                  </div>
              </div>
            </div>
            <div class="form-group row mb-0">                                              <!-- BUTTON -->
              <div class="col-md-8 offset-md-4" style="margin-left: 30rem; margin-top: 10px">
                <button id="button" type="submit" class="btn btn-primary btn-primary-lmts">
                  {{ __('Cadastrar Inscrição') }}
                </button>

              </div>
            </div>
        </div>
      </form>
    </div>
</div>

<script type="text/javascript" >

function comprovanteSelecionado(){
  document.getElementById("formulario").style.display = "";
}

function escolherTipo(x) {
	if (x == "reintegracao") {
   document.getElementById("tipo").value = "reintegracao";
   document.getElementById("historicoEscolar").style.display = "";
   document.getElementById("declaracaoDeVinculo").style.display = "none";
   document.getElementById("enem").style.display = "none";
   document.getElementById("curriculo").style.display = "none";
   document.getElementById("programaDasDisciplinas").style.display = "none";

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

    if(document.getElementById("comprovante").value == 'isento'){
      document.getElementById("formulario").style.display = "";
    }
	}
}


</script>


    @endsection
