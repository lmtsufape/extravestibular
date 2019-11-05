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
      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

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

<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action={{ route('cadastroEditarDadosUsuario') }} enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
            <div class="card" style="width: 70rem;">
              <div class="card-header">{{ __('Dados de Usuário') }}</div>
              <div class="card-body">
                    <div class="card-body">
                      <div class="form-group row justify-content-center ">  <!-- Nome | CPF-->
                        <div>
                          <label for="nome" class="field a-field a-field_a2 page__field">
                              <input id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Nome*"  style="width: 45rem;" value="{{ $dados->nome }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Nome*</span>
                              </span>
                          </label>
                          @error('nome')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div>
                          <label for="cpf" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                              <input id="cpf" type="text" name="cpf" autofocus class="form-control @error('cpf') is-invalid @enderror field__input a-field__input" placeholder="CPF*" style="width: 12rem;" value="{{ $dados->cpf }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">CPF*</span>
                              </span>
                          </label>
                          @error('cpf')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row " style="margin-left: 50px;">  <!-- RG Orgao Emissor/UF/Titulo Eleitoral-->
                          <div>
                            <label for="rg" class="field a-field a-field_a2 page__field" >
                                <input id="rg" type="text" name="rg" autofocus class="form-control @error('rg') is-invalid @enderror field__input a-field__input" placeholder="RG*" style="width: 12rem;" value="{{ $dados->rg }}">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">RG*</span>
                                </span>
                            </label>
                            @error('rg')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div>
                            <label for="orgaoEmissor" class="field a-field a-field_a2 page__field" style=" margin-left: 50px;">
                                <input id="orgaoEmissor" type="text" name="orgaoEmissor" autofocus class="form-control @error('orgaoEmissor') is-invalid @enderror field__input a-field__input" placeholder="Orgão Emissor*" style="width: 5rem;" value="{{ $dados->orgaoEmissor }}">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Orgão Emissor*</span>
                                </span>
                            </label>
                            @error('orgaoEmissor')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div>
                            <label for="orgaoEmissorUF" class="field a-field a-field_a2 page__field" style=" margin-left: 50px;">
                                <input id="orgaoEmissorUF" type="text" name="orgaoEmissorUF" autofocus class="form-control @error('orgaoEmissorUF') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="width: 5rem;" value="{{ $dados->orgaoEmissorUF }}">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">UF*</span>
                                </span>
                            </label>
                            @error('orgaoEmissorUF')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div>
                            <label for="tituloEleitoral" class="field a-field a-field_a2 page__field" style=" margin-left: 50px;">
                                <input id="tituloEleitoral" type="text" name="tituloEleitoral" autofocus class="form-control @error('tituloEleitoral') is-invalid @enderror field__input a-field__input" placeholder="Título Eleitoral*" style="width: 12rem;" value="{{ $dados->tituloEleitoral }}">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Título Eleitoral*</span>
                                </span>
                            </label>
                            @error('tituloEleitoral')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div>
                            <label for="nascimento" class="field a-field a-field_a2 page__field" style=" margin-left: 55px;">
                                <input id="nascimento" type="date" name="nascimento" autofocus class="form-control @error('nascimento') is-invalid @enderror field__input a-field__input" placeholder="Data de Nascimento*" style="width: 12rem;" value="{{ $dados->nascimento }}">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Data de Nascimento*</span>
                                </span>
                            </label>
                            @error('nascimento')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                      </div>

                      <div class="form-group row" style="margin-left: 50px;">  <!-- Filiação -->
                          <div>
                            <label for="filiacao" class="field a-field a-field_a1 page__field">
                                <input id="filiacao" type="text" name="filiacao" autofocus class="form-control @error('filiacao') is-invalid @enderror field__input a-field__input" placeholder="Filiação*" style="width: 30rem;" value="{{ $dados->filiacao }}">
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
                      </div>
                    </div>
              </div>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px">
              <div class="card-header">{{ __('Endereço') }}</div>
              <div class="card-body">
                    <div class="card-body">
                      <div class="form-group row justify-content-left">
                        <label for="endereco" class="field a-field a-field_a3 page__field" style="margin-left: 65px;">
                            <input onblur="pesquisacep(this.value);" id="cep" type="text" name="cep" autofocus class="field__input a-field__input" placeholder="CEP" size="10" maxlength="9" >
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">CEP</span>
                            </span>
                        </label>
                      </div>
                      <div class="form-group row justify-content-center">  <!-- Endereço/Nº -->
                        <div>
                          <label for="endereco" class="field a-field a-field_a2 page__field">
                              <input id="rua" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Endereço*" style="width: 53rem;" value="{{ $dados->endereco }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Endereço*</span>
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
                              <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Número*" style="width: 4rem;" value="{{ $dados->num }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Número*</span>
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
                              <input id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro*" style="width: 27rem;" value="{{ $dados->bairro }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Bairro*</span>
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
                              <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade*" style="width: 25rem;" value="{{ $dados->cidade }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Cidade*</span>
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
                              <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF*" style="width: 4rem;" value="{{ $dados->uf }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">UF*</span>
                              </span>
                          </label>
                          @error('uf')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">  <!-- Fone Residencial/Celular/Comercial -->
                        <div>
                          <label for="foneResidencial" class="field a-field a-field_a2 page__field" style=" margin-left: 60px;">
                              <input id="foneResidencial" type="text" name="foneResidencial" autofocus class="form-control @error('foneResidencial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Residencial" style="width: 15rem;" value="{{ $dados->foneResidencial }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Telefone Residencial</span>
                              </span>
                          </label>
                          @error('foneResidencial')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div>
                          <label for="foneCelular" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                              <input id="foneCelular" type="text" name="foneCelular" autofocus class="form-control @error('foneCelular') is-invalid @enderror field__input a-field__input" placeholder="Telefone Celular" style="width: 15rem;" value="{{ $dados->foneCelular }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Telefone Celular</span>
                              </span>
                          </label>
                          @error('foneCelular')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div>
                          <label for="foneComercial" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                              <input id="foneComercial" type="text" name="foneComercial" autofocus class="form-control @error('foneComercial') is-invalid @enderror field__input a-field__input" placeholder="Telefone Comercial" style="width: 15rem;" value="{{ $dados->foneComercial }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Telefone Comercial</span>
                              </span>
                          </label>
                          @error('foneComercial')
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
        <div class="form-group row mb-0" style="margin-top: 10px; margin-left: 10rem; padding-bottom: 5%"> <!-- Button -->
          <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary btn-primary-lmts" >
              {{ __('Finalizar') }}
            </button>

          </div>
        </div>
      </form>
    </div>
</div>
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
