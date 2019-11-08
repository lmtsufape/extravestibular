@extends('layouts.app')
@section('titulo','Editar Dados de Usuario')
@section('navbar')
    <!-- Home / Editar Dados   -->
    <li class="nav-item active">
      <a class="nav-link" style="color: black" href="{{ route('home') }}"
         onclick="event.preventDefault();
                       document.getElementById('VerEditais').submit();">
         {{ __('Home') }}
      </a>
      <form id="VerEditais" action="{{ route('home') }}" method="POST" style="display: none;">

      </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
      <a class="nav-link">
        {{ __('Editar Dados')}}
      </a>

    </li>
@endsection
@section('content')
<style media="screen">
  #margin{
    margin-bottom: 20px;
  }

  @media screen and (max-width:576px) {
    #largura{
      width: 100%;
    }

    .titulo-tabela-lmts{
      width: 90%;
    }
  }
</style>
<!-- container -->
<div class="container">
  <!-- form -->
  <form method="POST" action="{{ route('cadastroEditarDadosUsuario') }}" enctype="multipart/form-data">
    @csrf
  <!-- row dados de usuário-->
  <div class="row " style="margin-bottom: 20px;">
    <!-- card dados de usuário -->
    <div class="card" style="width:100%">
      <!-- card-header -->
      <div class="card-header">
        Dados de Usuário
      </div>  <!--end card-header -->
      <!-- card-body -->
      <div class="card-body">
          <div class="row"> <!-- row nome cpf -->
            <!-- Nome -->
            <div id="margin" class="col-sm-9">
              <label id="largura" for="nome" class="field a-field a-field_a2 page__field" style="width: 100%">
                    <input id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input " placeholder="Nome*"  style="width: 100%" value="{{ $dados->nome }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Nome*</span>
                  </span>
              </label>
              @error('nome')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end Nome -->
            <!-- cpf -->
            <div id="margin" class="col-sm-3">
              <label id="largura" for="cpf" class="field a-field a-field_a2 page__field" style=" margin-left: 0px;">
                  <input id="cpf" type="text" name="cpf" autofocus class="form-control @error('cpf') is-invalid @enderror field__input a-field__input" placeholder="CPF*" style="" value="{{ $dados->cpf }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">CPF*</span>
                  </span>
              </label>
              @error('cpf')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end cpf -->
          </div> <!-- end row nome cpf -->

          <div class="row"><!-- row rg oe uf te dn-->
            <!-- RG -->
            <div id="margin" class="col-sm-4 margin">
              <label id="largura" for="rg" class="field a-field a-field_a2 page__field" >
                  <input id="rg" type="text" name="rg" autofocus class="form-control @error('rg') is-invalid @enderror field__input a-field__input" placeholder="RG*" style="" value="{{ $dados->rg }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">RG*</span>
                  </span>
              </label>
              @error('rg')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end RG -->
            <!-- Orgão Emissor -->
            <div id="margin" class="col-sm-1">
              <label id="largura" for="orgaoEmissor" class="field a-field a-field_a2 page__field" style="">
                  <input id="orgaoEmissor" type="text" name="orgaoEmissor" autofocus class="form-control @error('orgaoEmissor') is-invalid @enderror field__input a-field__input" placeholder="Orgão Emissor*" style="" value="{{ $dados->orgaoEmissor }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Orgão Emissor*</span>
                  </span>
              </label>
              @error('orgaoEmissor')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end Orgão Emissor -->
            <!-- UF -->
            <div id="margin" class="col-sm-1">
              <label id="largura" for="orgaoEmissorUF" class="field a-field a-field_a2 page__field" style="">
                  <input id="orgaoEmissorUF" type="text" name="orgaoEmissorUF" autofocus class="form-control @error('orgaoEmissorUF') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="" value="{{ $dados->orgaoEmissorUF }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">UF*</span>
                  </span>
              </label>
              @error('orgaoEmissorUF')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end UF -->
            <!-- Título Eleitoral -->
            <div id="margin" class="col-sm-3">
              <label id="largura" for="tituloEleitoral" class="field a-field a-field_a2 page__field" style="">
                  <input id="tituloEleitoral" type="text" name="tituloEleitoral" autofocus class="form-control @error('tituloEleitoral') is-invalid @enderror field__input a-field__input" placeholder="Título Eleitoral*" value="{{ $dados->tituloEleitoral }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Título Eleitoral*</span>
                  </span>
              </label>
              @error('tituloEleitoral')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end Título Eleitoral -->
            <!-- Data Nascimento -->
            <div id="margin" class="col-sm-3">
              <label id="largura" for="nascimento" class="field a-field a-field_a2 page__field" style="">
                  <input id="nascimento" type="date" name="nascimento" autofocus class="form-control @error('nascimento') is-invalid @enderror field__input a-field__input" placeholder="Data de Nascimento*" value="{{ $dados->nascimento }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Data de Nascimento*</span>
                  </span>
              </label>
              @error('nascimento')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end Data Nascimento -->
          </div><!-- end row rg oe uf te dn-->
          <!-- Filiação -->
          <div class="row">
            <div id="margin" class="col-sm-9">
              <label id="largura" for="filiacao" class="field a-field a-field_a1 page__field" style="width:100%">
                  <input id="filiacao" type="text" name="filiacao" autofocus class="form-control @error('filiacao') is-invalid @enderror field__input a-field__input" placeholder="Filiação*" style="width:100%" value="{{ $dados->filiacao }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Filiação*</span>
                  </span>
              </label>
              @error('filiacao')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div><!-- end Filiação -->

      </div><!-- end card-body -->
    </div><!-- end card dados de usuário -->
  </div><!-- end row dados de usuário-->


  <!-- row endereco -->
  <div class="row" style="margin-bottom: 20px;">
  <!-- card endereco -->
    <div class="card" style="width:100%">
      <!-- card-header endereço -->
      <div class="card-header">
        Endereço
      </div><!-- end card-header endereço -->
      <!-- card-body -->
      <div class="card-body">
          <!-- row cep -->
          <div  class="row">
            <div id="margin" class="col-sm-9">
              <label id="largura" for="endereco" class="field a-field a-field_a3 page__field" style="">
                  <input onblur="pesquisacep(this.value);" id="cep" type="text" name="cep" autofocus class="field__input a-field__input" placeholder="CEP" size="10" maxlength="9" >
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">CEP</span>
                  </span>
              </label>
            </div>
          </div><!-- end row cep -->

          <!-- row endereco numero -->
          <div class="row">
            <!-- endereço -->
            <div id="margin" class="col-sm-10">
              <label id="largura" for="endereco" class="field a-field a-field_a2 page__field" style="width:100%">
                  <input id="rua" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Endereço*" style="width:100%" value="{{ $dados->endereco }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Endereço*</span>
                  </span>
              </label>
              @error('endereco')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end endereço -->
            <!-- Número -->
            <div id="margin" class="col-sm-2">
              <label id="largura" for="num" class="field a-field a-field_a2 page__field" style="width:100%">
                  <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Número*" style="width:100%" value="{{ $dados->num }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Número*</span>
                  </span>
              </label>
              @error('num')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end Número -->

          </div><!-- end row endereco numero -->

          <!-- row bairro cidade uf -->
          <div class="row">
            <!-- bairro -->
            <div id="margin" class="col-sm-5">
              <label for="bairro" class="field a-field a-field_a2 page__field" style="width:100%">
                  <input id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro*" style="width:100%" value="{{ $dados->bairro }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Bairro*</span>
                  </span>
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
                  <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade*" style="width:100%" value="{{ $dados->cidade }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Cidade*</span>
                  </span>
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
                  <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="width:100%" value="{{ $dados->uf }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">UF*</span>
                  </span>
              </label>
              @error('uf')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end uf -->
          </div><!-- end row bairro cidade uf -->

          <!-- row telefones -->
          <div class="row">
            <!-- telefone residencial -->
            <div id="margin" class="col-sm-4">
              <label for="foneResidencial" class="field a-field a-field_a2 page__field" style=" width:100%">
                  <input id="foneResidencial" type="text" name="foneResidencial" autofocus class="form-control @error('foneResidencial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Residencial" style=" width:100%"value="{{ $dados->foneResidencial }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Telefone Residencial</span>
                  </span>
              </label>
              @error('foneResidencial')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end telefone residencial -->
            <!-- telefone celular -->
            <div id="margin" class="col-sm-4">
              <label for="foneCelular" class="field a-field a-field_a2 page__field" style=" width:100%">
                  <input id="foneCelular" type="text" name="foneCelular" autofocus class="form-control @error('foneCelular') is-invalid @enderror field__input a-field__input" placeholder="Telefone Celular" style=" width:100%" value="{{ $dados->foneCelular }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Telefone Celular</span>
                  </span>
              </label>
              @error('foneCelular')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end telefone celular -->
            <!-- telefone comercial -->
            <div id="margin" class="col-sm-4">
              <label for="foneComercial" class="field a-field a-field_a2 page__field" style=" width:100%">
                  <input id="foneComercial" type="text" name="foneComercial" autofocus class="form-control @error('foneComercial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Comercial" style=" width:100%" value="{{ $dados->foneComercial }}">
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Telefone Comercial</span>
                  </span>
              </label>
              @error('foneComercial')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end telefone comercial -->
          </div><!-- end row telefones -->

      </div><!-- end card-body -->
    </div>  <!--end card endereco -->
  </div><!-- end row endereco-->

  <div class="row justify-content-center"> <!-- Button -->
    <div class=>
      <button type="submit" class="btn btn-primary btn-primary-lmts" >
        {{ __('Finalizar') }}
      </button>
    </div>
  </div><!-- end Button -->

</form><!-- end Form Endereço -->



</div><!-- end container -->

<br>
<br>
<br>

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
