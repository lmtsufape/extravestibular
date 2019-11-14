@extends('layouts.app')
@section('titulo','Cadastrar Dados de Usuario')
@section('navbar')
    <!-- Home / Editar Dados -->
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
      <a class="nav-link">
        {{ __('Cadastrar Dados')}}
      </a>

    </li>
@endsection
@section('content')
<style media="screen">
  #margin{
    margin-bottom: 20px;
  }

  /* span{
    font-weight: bold;
  } */
  @media screen and (max-width:576px) {
    #largura{
      width: 100%;
    }

    .titulo-tabela-lmts{
      width: 90%;
    }

  }
</style>
<div class="container">
  <form method="POST" action={{ route('cadastroDadosUsuario') }} enctype="multipart/form-data">
      @csrf

    <!-- row dados usuário -->
    <div id="margin" class="row justify-content-center" style="margin-top:20px;">
      <!-- card dados usuário -->
        <div class="card" style="width:100%">
          <div class="card-header">
            {{ __('Dados de Usuário') }}
          </div>
          <div class="card-body">
            <!-- row Nome CPF -->
            <div class="row justify-content-center">
                <!-- Nome -->
                <div id="margin" class="col-sm-9">
                  <label id="largura" for="nome" class="field a-field a-field_a2 page__field" style="width:100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nome*</span>
                    </span>
                      <input id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Nome*"  style="" value="{{ old('nome') }}">
                  </label>
                  @error('nome')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div><!-- end Nome -->


              <!-- cpf -->
              <div id="margin" class="col-sm-3">
                <label id="largura" for="cpf" class="field a-field a-field_a2 page__field" style="width:100%">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">CPF*</span>
                  </span>
                    <input id="cpf" type="text" name="cpf" autofocus class="form-control @error('cpf') is-invalid @enderror field__input a-field__input" placeholder="CPF*" style="" value="{{ old('cpf') }}">
                </label>
                @error('cpf')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div><!-- end cpf -->
            </div><!--end row Nome CPF -->


            <!-- RG Orgao Emissor/UF/Titulo Eleitoral-->
            <div class="row justify-content-center">

              <!-- RG -->
              <div id="margin" class="col-sm-3">
                <label id="largura" for="rg" class="field a-field a-field_a2 page__field" style="width:100%" >
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">RG*</span>
                  </span>
                    <input id="rg" type="text" name="rg" autofocus class="form-control @error('rg') is-invalid @enderror field__input a-field__input" placeholder="RG*" style="" value="{{ old('rg') }}">
                </label>
                @error('rg')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div><!-- end RG -->

              <!-- Orgao Emissor -->
              <div id="margin" class="col-sm-2">
                <label id="largura" for="orgaoEmissor" class="field a-field a-field_a2 page__field" style="width:100%">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Orgão Emissor*</span>
                  </span>
                    <input id="orgaoEmissor" type="text" name="orgaoEmissor" autofocus class="form-control @error('orgaoEmissor') is-invalid @enderror field__input a-field__input" placeholder="Orgão Emissor*" style="" value="{{ old('orgaoEmissor') }}">
                </label>
                @error('orgaoEmissor')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div><!-- end Orgao Emissor -->

              <!-- uf -->
              <div id="margin" class="col-sm-1">
                <label id="largura" for="orgaoEmissorUF" class="field a-field a-field_a2 page__field" style="width:100%">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">UF*</span>
                  </span>
                    <input id="orgaoEmissorUF" type="text" name="orgaoEmissorUF" autofocus class="form-control @error('orgaoEmissorUF') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="" value="{{ old('orgaoEmissorUF') }}">
                </label>
                @error('orgaoEmissorUF')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div><!-- end uf -->

              <!-- titulo eleitoral -->
              <div id="margin" class="col-sm-3">
                <label id="largura" for="tituloEleitoral" class="field a-field a-field_a2 page__field" style="width:100%">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Título Eleitoral*</span>
                  </span>
                    <input id="tituloEleitoral" type="text" name="tituloEleitoral" autofocus class="form-control @error('tituloEleitoral') is-invalid @enderror field__input a-field__input" placeholder="Título Eleitoral*" style="" value="{{ old('tituloEleitoral') }}">
                </label>
                @error('tituloEleitoral')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div><!-- end titulo eleitoral -->

              <!-- data nascimento -->
              <div class="col-sm-3">
                <label id="largura" for="nascimento" class="field a-field a-field_a2 page__field" style="width:100%">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Data de Nascimento*</span>
                  </span>
                    <input id="nascimento" type="date" name="nascimento" autofocus class="form-control @error('nascimento') is-invalid @enderror field__input a-field__input" placeholder="Data de Nascimento*" style="" value="{{ old('nascimento') }}">
                </label>
                @error('nascimento')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div><!-- end RG Orgao Emissor/UF/Titulo Eleitoral-->

            <!-- row filiacao -->
            <div class="row">
              <div id="margin" class="col-sm-9">
                <label for="filiacao" class="field a-field a-field_a1 page__field" style="width:100%">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Filiação*</span>
                  </span>
                    <input id="filiacao" type="text" name="filiacao" autofocus class="form-control @error('filiacao') is-invalid @enderror field__input a-field__input" placeholder="Filiação*" value="{{ old('filiacao') }}">
                </label>
                @error('filiacao')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div><!-- end row filiacao -->
          </div><!-- end card-body -->
        </div><!-- end card dados usuário -->
    </div><!-- row dados usuário -->


    <!-- row endereco -->
    <div id="margin" class="row justify-content-center">
      <!-- card endereco -->
      <div class="card" style="width:100%">
        <div class="card-header">
          {{ __('Endereço') }}
        </div>
        <!-- card-body -->
        <div class="card-body">
          <!-- row cep -->
          <div class="row">
            <div id="margin" class="col-sm-9">
              <label id="largura" for="endereco" class="field a-field a-field_a3 page__field" style="">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">CEP</span>
                </span>
                  <input onblur="pesquisacep(this.value);" id="cep" type="text" name="cep" autofocus class="form-control field__input a-field__input" placeholder="CEP" size="10" maxlength="9" >
              </label>
            </div>
          </div><!-- end row cep -->

          <!-- row rua/numero -->
          <div class="row">
            <!-- rua -->
            <div id="margin" class="col-sm-9">
              <label for="endereco" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Rua*</span>
                </span>
                  <input id="rua" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Endereço*" style="" value="{{ old('endereco') }}">
              </label>
              @error('endereco')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <!-- numero -->
            <div id="margin" class="col-sm-3">
              <label id="largura" for="num" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Número*</span>
                </span>
                  <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Número*" style="" value="{{ old('num') }}">
              </label>
              @error('num')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end numero -->

          </div><!-- end row rua/numero -->

          <!-- row bairro cidade uf -->
          <div class="row">
            <!-- bairro -->
            <div id="margin" class="col-sm-5">
              <label for="bairro" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Bairro*</span>
                </span>
                  <input id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro*" style="" value="{{ old('bairro') }}">
              </label>
              @error('bairro')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end bairro -->

            <!-- cidade -->
            <div id="margin" class="col-sm-5">
              <label for="cidade" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Cidade*</span>
                </span>
                  <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade*" style="" value="{{ old('cidade') }}">
              </label>
              @error('cidade')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end cidade -->

            <!-- uf -->
            <div id="margin" class="col-sm-2">
              <label for="uf" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">UF*</span>
                </span>
                  <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="" value="{{ old('uf') }}">
              </label>
              @error('uf')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end uf -->
          </div><!-- end row bairro cidade uf -->

          <!-- row telefones -->
          <div class="row justify-content-center">
            <!-- telefone residencial -->
            <div id="margin" class="col-sm-4">
              <label for="foneResidencial" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Telefone Residencial</span>
                </span>
                  <input id="foneResidencial" type="text" name="foneResidencial" autofocus class="form-control @error('foneResidencial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Residencial" value="{{ old('foneResidencial') }}">
              </label>
              @error('foneResidencial')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end telefone residencial -->
            <!-- telefone celular -->
            <div id="margin" class="col-sm-4">
              <label for="foneCelular" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Telefone Celular</span>
                </span>
                  <input id="foneCelular" type="text" name="foneCelular" autofocus class="form-control @error('foneCelular') is-invalid @enderror field__input a-field__input" placeholder="Telefone Celular" value="{{ old('foneCelular') }}">
              </label>
              @error('foneCelular')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end telefone celular -->
            <!-- telefone comercial -->
            <div id="margin" class="col-sm-4">
              <label for="foneComercial" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Telefone Comercial</span>
                </span>
                  <input id="foneComercial" type="text" name="foneComercial" autofocus class="form-control @error('foneComercial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Comercial" value="{{ old('foneComercial') }}">
              </label>
              @error('foneComercial')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end telefone comercial -->
          </div><!-- end row telefones -->
        </div><!-- end card-body -->
      </div><!-- end card endereco -->
    </div><!-- end row endereco -->

    <div class="row justify-content-center">
      <button type="submit" class="btn btn-primary btn-primary-lmts" >
        {{ __('Finalizar') }}
      </button>
    </div>

  </form>
</div><!-- end container -->




<script type="text/javascript" >


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
