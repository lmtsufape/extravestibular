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
  <form id="formCadastro" autocomplete="off" method="POST" action="{{ route('cadastroEditarDadosUsuario') }}" enctype="multipart/form-data">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Nome*</span>
                </span>
                    <input id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input " placeholder="Nome*"  style="width: 100%" value="{{ $dados->nome }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">CPF*</span>
                </span>
                  <input disabled id="cpf" type="text" name="cpf" autofocus class="form-control @error('cpf') is-invalid @enderror field__input a-field__input" placeholder="CPF*" style="" value="{{ $dados->cpf }}">
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
            <div id="margin" class="col-sm-3 margin">
              <label id="largura" for="rg" class="field a-field a-field_a2 page__field" >
                <span class="a-field__label-wrap">
                  <span class="a-field__label">RG*</span>
                </span>
                  <input id="rg" type="text" name="rg" autofocus class="form-control @error('rg') is-invalid @enderror field__input a-field__input" placeholder="RG*" style="" value="{{ $dados->rg }}">
              </label>
              @error('rg')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div><!-- end RG -->
            <!-- Orgão Emissor -->
            <div id="margin" class="col-sm-2">
              <label id="largura" for="orgaoEmissor" class="field a-field a-field_a2 page__field" style="">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Orgão Emissor*</span>
                </span>
                  <input maxlength="5" id="orgaoEmissor" type="text" name="orgaoEmissor" autofocus class="form-control @error('orgaoEmissor') is-invalid @enderror field__input a-field__input" placeholder="Orgão Emissor*" style="" value="{{ $dados->orgaoEmissor }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">UF*</span>
                </span>
                  <!-- <input maxlength="2" id="orgaoEmissorUF" type="text" name="orgaoEmissorUF" autofocus class="form-control @error('orgaoEmissorUF') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="" value="{{ $dados->orgaoEmissorUF }}"> -->
                  <select class="form-control col-sm-10" name="orgaoEmissorUF">
                    <option <?php if(old('orgaoEmissorUF') == 'AC'){ echo('selected'); } ?> value="AC">AC</option>
                    <option <?php if(old('orgaoEmissorUF') == 'AL'){ echo('selected'); } ?> value="AL">AL</option>
                    <option <?php if(old('orgaoEmissorUF') == 'AP'){ echo('selected'); } ?> value="AP">AP</option>
                    <option <?php if(old('orgaoEmissorUF') == 'AM'){ echo('selected'); } ?> value="AM">AM</option>
                    <option <?php if(old('orgaoEmissorUF') == 'BA'){ echo('selected'); } ?> value="BA">BA</option>
                    <option <?php if(old('orgaoEmissorUF') == 'CE'){ echo('selected'); } ?> value="CE">CE</option>
                    <option <?php if(old('orgaoEmissorUF') == 'DF'){ echo('selected'); } ?> value="DF">DF</option>
                    <option <?php if(old('orgaoEmissorUF') == 'ES'){ echo('selected'); } ?> value="ES">ES</option>
                    <option <?php if(old('orgaoEmissorUF') == 'GO'){ echo('selected'); } ?> value="GO">GO</option>
                    <option <?php if(old('orgaoEmissorUF') == 'MA'){ echo('selected'); } ?> value="MA">MA</option>
                    <option <?php if(old('orgaoEmissorUF') == 'MT'){ echo('selected'); } ?> value="MT">MT</option>
                    <option <?php if(old('orgaoEmissorUF') == 'MS'){ echo('selected'); } ?> value="MS">MS</option>
                    <option <?php if(old('orgaoEmissorUF') == 'MG'){ echo('selected'); } ?> value="MG">MG</option>
                    <option <?php if(old('orgaoEmissorUF') == 'PA'){ echo('selected'); } ?> value="PA">PA</option>
                    <option <?php if(old('orgaoEmissorUF') == 'PB'){ echo('selected'); } ?> value="PB">PB</option>
                    <option <?php if(old('orgaoEmissorUF') == 'PR'){ echo('selected'); } ?> value="PR">PR</option>
                    <option <?php if(old('orgaoEmissorUF') == 'PE'){ echo('selected'); } ?> value="PE">PE</option>
                    <option <?php if(old('orgaoEmissorUF') == 'PI'){ echo('selected'); } ?> value="PI">PI</option>
                    <option <?php if(old('orgaoEmissorUF') == 'RJ'){ echo('selected'); } ?> value="RJ">RJ</option>
                    <option <?php if(old('orgaoEmissorUF') == 'RN'){ echo('selected'); } ?> value="RN">RN</option>
                    <option <?php if(old('orgaoEmissorUF') == 'RS'){ echo('selected'); } ?> value="RS">RS</option>
                    <option <?php if(old('orgaoEmissorUF') == 'RO'){ echo('selected'); } ?> value="RO">RO</option>
                    <option <?php if(old('orgaoEmissorUF') == 'RR'){ echo('selected'); } ?> value="RR">RR</option>
                    <option <?php if(old('orgaoEmissorUF') == 'SC'){ echo('selected'); } ?> value="SC">SC</option>
                    <option <?php if(old('orgaoEmissorUF') == 'SP'){ echo('selected'); } ?> value="SP">SP</option>
                    <option <?php if(old('orgaoEmissorUF') == 'SE'){ echo('selected'); } ?> value="SE">SE</option>
                    <option <?php if(old('orgaoEmissorUF') == 'TO'){ echo('selected'); } ?> value="TO">TO</option>
                  </select>
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Título Eleitoral*</span>
                </span>
                  <input maxlength="12" id="tituloEleitoral" type="text" name="tituloEleitoral" autofocus class="form-control @error('tituloEleitoral') is-invalid @enderror field__input a-field__input" placeholder="Título Eleitoral*" value="{{ $dados->tituloEleitoral }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Data de Nascimento*</span>
                </span>
                  <input id="nascimento" type="date" name="nascimento" autofocus class="form-control @error('nascimento') is-invalid @enderror field__input a-field__input" placeholder="Data de Nascimento*" value="{{ $dados->nascimento }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Filiação*</span>
                </span>
                  <input id="filiacao" type="text" name="filiacao" autofocus class="form-control @error('filiacao') is-invalid @enderror field__input a-field__input" placeholder="Filiação*" style="width:100%" value="{{ $dados->filiacao }}">
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

          <!-- row endereco numero -->
          <div class="row">
            <!-- endereço -->
            <div id="margin" class="col-sm-10">
              <label id="largura" for="endereco" class="field a-field a-field_a2 page__field" style="width:100%">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Endereço*</span>
                </span>
                  <input id="rua" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Endereço*" style="width:100%" value="{{ $dados->endereco }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Número*</span>
                </span>
                  <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Número*" style="width:100%" value="{{ $dados->num }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Bairro*</span>
                </span>
                  <input maxlength="2" id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro*" style="width:100%" value="{{ $dados->bairro }}">
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
                  <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade*" style="width:100%" value="{{ $dados->cidade }}">
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
                  <!-- <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="width:100%" value="{{ $dados->uf }}"> -->
                  <select id="uf" class="form-control col-sm-10" name="uf">
                    <option <?php if(old('uf') == 'AC'){ echo('selected'); } ?> value="AC">AC</option>
                    <option <?php if(old('uf') == 'AL'){ echo('selected'); } ?> value="AL">AL</option>
                    <option <?php if(old('uf') == 'AP'){ echo('selected'); } ?> value="AP">AP</option>
                    <option <?php if(old('uf') == 'AM'){ echo('selected'); } ?> value="AM">AM</option>
                    <option <?php if(old('uf') == 'BA'){ echo('selected'); } ?> value="BA">BA</option>
                    <option <?php if(old('uf') == 'CE'){ echo('selected'); } ?> value="CE">CE</option>
                    <option <?php if(old('uf') == 'DF'){ echo('selected'); } ?> value="DF">DF</option>
                    <option <?php if(old('uf') == 'ES'){ echo('selected'); } ?> value="ES">ES</option>
                    <option <?php if(old('uf') == 'GO'){ echo('selected'); } ?> value="GO">GO</option>
                    <option <?php if(old('uf') == 'MA'){ echo('selected'); } ?> value="MA">MA</option>
                    <option <?php if(old('uf') == 'MT'){ echo('selected'); } ?> value="MT">MT</option>
                    <option <?php if(old('uf') == 'MS'){ echo('selected'); } ?> value="MS">MS</option>
                    <option <?php if(old('uf') == 'MG'){ echo('selected'); } ?> value="MG">MG</option>
                    <option <?php if(old('uf') == 'PA'){ echo('selected'); } ?> value="PA">PA</option>
                    <option <?php if(old('uf') == 'PB'){ echo('selected'); } ?> value="PB">PB</option>
                    <option <?php if(old('uf') == 'PR'){ echo('selected'); } ?> value="PR">PR</option>
                    <option <?php if(old('uf') == 'PE'){ echo('selected'); } ?> value="PE">PE</option>
                    <option <?php if(old('uf') == 'PI'){ echo('selected'); } ?> value="PI">PI</option>
                    <option <?php if(old('uf') == 'RJ'){ echo('selected'); } ?> value="RJ">RJ</option>
                    <option <?php if(old('uf') == 'RN'){ echo('selected'); } ?> value="RN">RN</option>
                    <option <?php if(old('uf') == 'RS'){ echo('selected'); } ?> value="RS">RS</option>
                    <option <?php if(old('uf') == 'RO'){ echo('selected'); } ?> value="RO">RO</option>
                    <option <?php if(old('uf') == 'RR'){ echo('selected'); } ?> value="RR">RR</option>
                    <option <?php if(old('uf') == 'SC'){ echo('selected'); } ?> value="SC">SC</option>
                    <option <?php if(old('uf') == 'SP'){ echo('selected'); } ?> value="SP">SP</option>
                    <option <?php if(old('uf') == 'SE'){ echo('selected'); } ?> value="SE">SE</option>
                    <option <?php if(old('uf') == 'TO'){ echo('selected'); } ?> value="TO">TO</option>
                  </select>
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Telefone Residencial</span>
                </span>
                  <input id="foneResidencial" type="text" name="foneResidencial" autofocus class="form-control @error('foneResidencial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Residencial" style=" width:100%"value="{{ $dados->foneResidencial }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Telefone Celular</span>
                </span>
                  <input id="foneCelular" type="text" name="foneCelular" autofocus class="form-control @error('foneCelular') is-invalid @enderror field__input a-field__input" placeholder="Telefone Celular" style=" width:100%" value="{{ $dados->foneCelular }}">
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
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Telefone Comercial</span>
                </span>
                  <input id="foneComercial" type="text" name="foneComercial" autofocus class="form-control @error('foneComercial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Comercial" style=" width:100%" value="{{ $dados->foneComercial }}">
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
      <button onclick="event.preventDefault();confirmar();" class="btn btn-primary btn-primary-lmts" >
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
    function confirmar(){
      if(confirm("Tem certeza que deseja finalizar?") == true) {
        document.getElementById("formCadastro").submit();
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


    var estados = [
      "AC","AL","AP","AM","BA","CE","DF","ES",
      "GO","MA","MT","MS","MG","PA","PB","PR",
      "PE","PI","RJ","RN","RS","RO","RR","SC",
      "SP","SE","TO",
    ];


    //autoCompĺete
    function autocomplete(inp, arr) {
      /*the autocomplete function takes two arguments,
      the text field element and an array of possible autocompleted values:*/
      var currentFocus;
      /*execute a function when someone writes in the text field:*/
      inp.addEventListener("input", function(e) {
          var a, b, i, val = this.value;
          /*close any already open lists of autocompleted values*/
          closeAllLists();
          if (!val) { return false;}
          currentFocus = -1;
          /*create a DIV element that will contain the items (values):*/
          a = document.createElement("DIV");
          a.setAttribute("id", this.id + "autocomplete-list");
          a.setAttribute("class", "autocomplete-items");
          /*append the DIV element as a child of the autocomplete container:*/
          this.parentNode.appendChild(a);
          /*for each item in the array...*/
          for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
              /*create a DIV element for each matching element:*/
              b = document.createElement("DIV");
              /*make the matching letters bold:*/
              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
              b.innerHTML += arr[i].substr(val.length);
              /*insert a input field that will hold the current array item's value:*/
              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
              /*execute a function when someone clicks on the item value (DIV element):*/
                  b.addEventListener("click", function(e) {
                  /*insert the value for the autocomplete text field:*/
                  inp.value = this.getElementsByTagName("input")[0].value;
                  /*close the list of autocompleted values,
                  (or any other open lists of autocompleted values:*/
                  closeAllLists();
              });
              a.appendChild(b);
            }
          }
      });
      /*execute a function presses a key on the keyboard:*/
      inp.addEventListener("keydown", function(e) {
          var x = document.getElementById(this.id + "autocomplete-list");
          if (x) x = x.getElementsByTagName("div");
          if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
          } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
          } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
              /*and simulate a click on the "active" item:*/
              if (x) x[currentFocus].click();
            }
          }
      });
      function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
      }
      function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
          x[i].classList.remove("autocomplete-active");
        }
      }
      function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
          if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
          }
        }
      }
      /*execute a function when someone clicks in the document:*/
      document.addEventListener("click", function (e) {
          closeAllLists(e.target);
      });
    }

    //end autocomplete

    autocomplete(document.getElementById("uf"), estados);
    autocomplete(document.getElementById("orgaoEmissorUF"), estados);




</script>


    @endsection
