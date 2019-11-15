@extends('layouts.app')
@section('titulo','Inscrição')
@section('navbar')
    <!-- Home / Detalhes do Edital / Fazer Inscrição -->
    <li class="nav-item active">
      <a class="nav-link" style="color: black" href="{{ route('home') }}"
         onclick="event.preventDefault();
                       document.getElementById('VerEditais').submit();">
         {{ __('Home') }}
      </a>
      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

      </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
      <a class="nav-link" href="detalhes" style="color: black" onclick="event.preventDefault(); document.getElementById('detalhesEdital').submit();" >
        {{ __('Detalhes do Edital')}}
      </a>
      @if(Auth::check())
        <form id="detalhesEdital" action="{{route('detalhesEdital')}}" method="GET" style="display: none;">
      @else
        <form id="detalhesEdital" action="{{route('detalhesEditalServidor')}}" method="GET" style="display: none;">
      @endif
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input type="hidden" name="mytime" value="{{$mytime}}">

        </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">Fazer Inscrição</a>
    </li>
@endsection
@section('content')

<style type="text/css">

@media screen and (max-width:576px) {
  div#divCidade{
    margin-top: 5%;
  }

  div#divUf{
    margin-top: 5%;
  }
}
</style>


<div class="container">
  <form class="" method="POST" action="{{ route('cadastroInscricao') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="editalId" value="{{$editalId}}" />
    <input id="tipo" type="hidden" name="tipo" value=""/>
    <div class="row" style="margin-top:5%">
      <div class="card " style="width: 100%;">
          <div class="card-header">{{ __('Comprovante') }}</div>
          <div class="card-body">
          
            @if($comprovante == 'deferida')
              <div class="row justify-content-center" >
                <label for="comprovante" class="">{{ __('Comprovante: ') }}</label>

                <div class="col-sm-12">
                  Isento de pagamento
                  <input id="comprovante" type="hidden" name="comprovante" value="isento">
                </div>
              </div>
            @else
              <div class="row justify-content-center">
                
                <div class="col-sm-10">
                  <label for="comprovante" style="font-weight: bold">Selecione o comprovante gerado pelo pagamento da taxa do tipo de inscrição:</label>
                </div>
                
              </div>
              <div class="row justify-content-center">
                <div class="col-sm-10">
                  <div class="custom-file" style="width: 100%;">
                    <input id='elementoComprovante'  onclick="comprovanteSelecionado()"  type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="comprovante" >
                  </div>
                </div>
              </div>
            @endif
          </div>
      </div>
    </div>
      <div class="row" id="formulario" style="display: <?php if($comprovante != 'deferida') { echo('none'); }?> ;margin-top: 5%">
        <div class="card" style="width: 100%;">
            <div class="card-header">{{ __('Inscrição') }}</div>
            <div class="card-body">

                <div class="row">
                  <label for="tipoInscricao" class="col-sm-4 col-form-label text-sm-right" >Tipo de Inscrição*:</label>
                  <div class="col-sm-8">
                    <input onclick="escolherTipo('reintegracao')" 			   type="radio" name="tipoInscricao" > Reintegração <br>
                    <input onclick="escolherTipo('transferenciaInterna')"  type="radio" name="tipoInscricao" > Transferencia Interna <br>
                    <input onclick="escolherTipo('transferenciaExterna')"  type="radio" name="tipoInscricao" > Transferencia Externa <br>
                    <input onclick="escolherTipo('portadorDeDiploma')" 		 type="radio" name="tipoInscricao" > Portador de Diploma <br>
                  </div>
                </div>

                <div id="historicoEscolar" class="form-group row" style="display: none" >      <!-- Arquivo historico escolar -->
                    <label for="Historico escolar" class="col-sm-4 col-form-label text-md-right">{{ __('Histórico escolar:') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="historicoEscolar">
                      </div>
                      @error('historicoEscolar')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="declaracaoDeVinculo" class="form-group row" style="display: none">    <!-- Arquivo declaração de vinculo -->
                    <label for="Declaracao de Viculo" class="col-sm-4 col-form-label text-md-right">{{ __('Declaração de vínculo:') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="declaracaoDeVinculo">
                      </div>
                      @error('declaracaoDeVinculo')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="programaDasDisciplinas" class="form-group row" style="display: none"> <!-- Arquivo programa das disciplinas -->
                    <label for="Programa das Disciplinas" class="col-sm-4 col-form-label text-md-right">{{ __('Programa das disciplinas: ') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="programaDasDisciplinas" >
                      </div>
                      @error('programaDasDisciplinas')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="curriculo" class="form-group row" style="display: none">              <!-- Arquivo curriculo -->
                    <label for="Curriculo" class="col-sm-4 col-form-label text-md-right">{{ __('Perfil Currícular:') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="curriculo" >
                      </div>
                      @error('curriculo')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                    </div>

                <div id="enem" class="form-group row" style="display: none">                   <!-- Arquivo enenm -->
                    <label for="ENEM" class="col-sm-4 col-form-label text-md-right">{{ __('Nota no Exame Nacional do Ensino Médio (ENEM): ') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="enem" >
                      </div>
                      @error('enem')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div class="form-group row">                                                   <!-- Curso -->
                    <label for="Curso" class="col-sm-4 col-form-label text-md-right">{{ __('Curso pretendido*:') }}</label>

                    <div class="col-sm-8" id="selectCurso">
                      
                      <select class="form-control col-sm-10" name="curso" style="width: 100%">
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
                    <label for="Turno" class="col-sm-4 col-form-label text-md-right">{{ __('Turno*:') }}</label>

                    <div class="col-sm-8">
                      <select class="form-control col-sm-10" name="turno">
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                        <option value="Especial (EAD)">Especial (EAD)</option>
                      </select>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                  <div class="col-sm-10">                                                   <!-- Polo -->
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="polo" class="field a-field a-field_a2 page__field" style="width: 100%">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Polo (apenas aluno EAD):</span>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                          <input id="polo" type="text" name="polo" autofocus class="form-control @error('polo') is-invalid @enderror field__input a-field__input" placeholder="Polo (apenas aluno EAD):" style="width: 100%;" value="{{ old('polo') }}" style="width:100%">
                          
                      </div>
                    </div>
                    
                    @error('polo')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

            </div>
        </div>
      </div>
      <div class="row" style="margin-top:5%">
        <div class="card" style=" width: 100%">
            <div class="card-header">{{ __('Dados da IES') }}</div>
            <div class="card-body">
              <div class="card-body">
                <div class="form-group row">                                                   <!-- Curso de origem -->

                
                  <label for="cursoDeOrigem" class="field a-field a-field_a2 page__field" style="width: 100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Curso de Origem*:</span>
                    </span>
                  </label>
                    <input id="cursoDeOrigem" type="text" name="cursoDeOrigem" class="form-control @error('cursoDeOrigem') is-invalid @enderror field__input a-field__input" placeholder="Curso de Origem*:" style="width: 100%;" value="{{ old('cursoDeOrigem') }}">
                  @error('cursoDeOrigem')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group row">                                                   <!-- Instituição de origem -->
                  <label for="instituicaoDeOrigem" class="field a-field a-field_a2 page__field" style="width: 100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Instituição de Origem*:</span>
                    </span>
                  </label>
                    <input id="instituicaoDeOrigem" type="text" name="instituicaoDeOrigem" autofocus class="form-control @error('instituicaoDeOrigem') is-invalid @enderror field__input a-field__input" placeholder="Instituição de Origem*:" style="width: 100%;" value="{{ old('instituicaoDeOrigem') }}">
                  @error('instituicaoDeOrigem')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group row">                                                   <!-- Natureza da IES -->
                  <label for="naturezaDaIes" class="field a-field a-field_a2 page__field" style="width: 100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Natureza da IES*:</span>
                    </span>
                  </label>
                    <input id="naturezaDaIes" type="text" name="naturezaDaIes" autofocus class="form-control @error('naturezaDaIes') is-invalid @enderror field__input a-field__input" placeholder="Natureza da IES*:" style="width: 100%;"  value="{{ old('naturezaDaIes') }}">
                  @error('naturezaDaIes')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group row">
                  <div class="" style="">
                    <label for="endereco" class="field a-field a-field_a3 page__field" style="width: 100%;">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">CEP</span>
                      </span>
                    </label>
                      <input onblur="pesquisacep(this.value);" id="cep" type="text" name="cep" autofocus class="form-control field__input a-field__input" placeholder="CEP" maxlength="9" >
                  </div>
                </div>
                <div class="form-group row">  <!-- Endereço/Nº -->
                        
                  <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-12">
                      <label for="endereco" class="field a-field a-field_a2 page__field" style="width: 100%">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Rua*</span>
                          </span>
                      </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <input id="rua" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Rua*" style="width: 100%;" value="{{ old('endereco') }}">
                    </div>
                  </div>
                    
                    @error('endereco')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-2">
                        
                    
                    <label for="num" class="field a-field a-field_a2 page__field" style="">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Número*</span>
                        </span>
                    </label>
                        <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Número*" style="width: 100%;" value="{{ old('num') }}">
                    @error('num')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">  <!-- Bairro/Cidade/Uf -->
                  <div class="col-sm-5" id="divBairro">
                    <label for="bairro" class="field a-field a-field_a2 page__field" style="width: 100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Bairro*</span>
                        </span>
                    </label>
                        <input id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro*" style="width: 100%" value="{{ old('bairro') }}">
                    @error('bairro')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-5" id="divCidade">
                    <label for="cidade" class="field a-field a-field_a2 page__field" style="width: 100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Cidade*</span>
                        </span>
                    </label>
                        <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade*" style="width: 100%" value="{{ old('cidade') }}">
                    @error('cidade')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-2" id="divUf">
                    <label for="uf" class="field a-field a-field_a2 page__field" style="width: 100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">UF*</span>
                        </span>
                    </label>
                        <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="width: 100%" value="{{ old('uf') }}">
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

      <div class="row justify-content-center">
          <div class="">
            <button id="button" type="submit" class="btn btn-primary btn-primary-lmts" style="margin-top:20px;">
              {{ __('Finalizar') }}
            </button>
          </div>
      </div>

    
    </div>
  </form>
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



    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);

        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

</script>


    @endsection
