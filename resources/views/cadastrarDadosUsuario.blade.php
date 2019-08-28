@extends('layouts.app')
@section('titulo','Cadastro dos Dados de Usuario')
@section('navbar')
    Dados de Usuario
@endsection
@section('content')

<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action={{ route('cadastroDadosUsuario') }} enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
            <div class="card" style="width: 70rem;">
              <div class="card-header">{{ __('Dados de Usuario') }}</div>
              <div class="card-body">

                @error('nome')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('cpf')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('rg')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('orgaoEmissor')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('orgaoEmissorUF')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('tituloEleitoral')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('filiacao')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('endereco')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('num')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('bairro')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('cidade')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('uf')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('foneResidencial')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('foneCelular')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('foneComercial')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                    <div class="card-body">
                      <div class="form-group row justify-content-center">  <!-- Nome | CPF-->
                        <label for="nome" class="field a-field a-field_a2 page__field">
                            <input id="nome" type="text" name="nome" autofocus class="form-control @error('nome') is-invalid @enderror field__input a-field__input" placeholder="Nome"  style="width: 45rem;" value="{{ old('nome') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Nome</span>
                            </span>
                        </label>
                        <label for="cpf" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                            <input id="cpf" type="text" name="cpf" autofocus class="form-control @error('cpf') is-invalid @enderror field__input a-field__input" placeholder="CPF" style="width: 12rem;" value="{{ old('cpf') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">CPF</span>
                            </span>
                        </label>
                      </div>

                      <div class="form-group row " style="margin-left: 50px;">  <!-- RG Orgao Emissor/UF/Titulo Eleitoral-->
                          <label for="rg" class="field a-field a-field_a2 page__field" >
                              <input id="rg" type="text" name="rg" autofocus class="form-control @error('rg') is-invalid @enderror field__input a-field__input" placeholder="RG" style="width: 12rem;" value="{{ old('rg') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">RG</span>
                              </span>
                          </label>
                          <label for="orgaoEmissor" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                              <input id="orgaoEmissor" type="text" name="orgaoEmissor" autofocus class="form-control @error('orgaoEmissor') is-invalid @enderror field__input a-field__input" placeholder="Orgão Emissor" style="width: 5rem;" value="{{ old('orgaoEmissor') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Orgão Emissor</span>
                              </span>
                          </label>
                          <label for="orgaoEmissorUF" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                              <input id="orgaoEmissorUF" type="text" name="orgaoEmissorUF" autofocus class="form-control @error('orgaoEmissorUF') is-invalid @enderror field__input a-field__input" placeholder="UF" style="width: 5rem;" value="{{ old('orgaoEmissorUF') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">UF</span>
                              </span>
                          </label>
                          <label for="tituloEleitoral" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                              <input id="tituloEleitoral" type="text" name="tituloEleitoral" autofocus class="form-control @error('tituloEleitoral') is-invalid @enderror field__input a-field__input" placeholder="Título Eleitoral" style="width: 12rem;" value="{{ old('tituloEleitoral') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Título Eleitoral</span>
                              </span>
                          </label>
                      </div>

                      <div class="form-group row" style="margin-left: 50px;">  <!-- Filiação -->
                          <label for="filiacao" class="field a-field a-field_a1 page__field">
                              <input id="filiacao" type="text" name="filiacao" autofocus class="form-control @error('filiacao') is-invalid @enderror field__input a-field__input" placeholder="Filiação" style="width: 30rem;" value="{{ old('filiacao') }}">
                              <span class="a-field__label-wrap">
                                <span class="a-field__label">Filiação</span>
                              </span>
                          </label>
                      </div>
                    </div>
              </div>
            </div>

            <div class="card" style="width: 70rem; margin-top: 15px">
              <div class="card-header">{{ __('Endereço') }}</div>
              <div class="card-body">
                    <div class="card-body">
                        <div class="form-group row justify-content-center">  <!-- Endereço/Nº -->
                        <label for="endereco" class="field a-field a-field_a2 page__field">
                            <input id="endereco" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Endereço" style="width: 53rem;" value="{{ old('endereco') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Endereço</span>
                            </span>
                        </label>
                        <label for="num" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                            <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Nº" style="width: 4rem;" value="{{ old('num') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Nº</span>
                            </span>
                        </label>
                      </div>

                      <div class="form-group row justify-content-center">  <!-- Bairro/Cidade/Uf -->
                        <label for="bairro" class="field a-field a-field_a2 page__field" >
                            <input id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro" style="width: 27rem;" value="{{ old('bairro') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Bairro</span>
                            </span>
                        </label>
                        <label for="cidade" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                            <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade" style="width: 25rem;" value="{{ old('cidade') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Cidade</span>
                            </span>
                        </label>
                        <label for="uf" class="field a-field a-field_a2 page__field" style=" margin-left: 25px;">
                            <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF" style="width: 4rem;" value="{{ old('uf') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">UF</span>
                            </span>
                        </label>
                      </div>

                      <div class="form-group row">  <!-- Fone Residencial/Celular/Comercial -->
                        <label for="foneResidencial" class="field a-field a-field_a2 page__field" style=" margin-left: 60px;">
                            <input id="foneResidencial" type="text" name="foneResidencial" autofocus class="form-control @error('foneResidencial') is-invalid @enderror field__input a-field__input" placeholder="Fone Residencial*" style="width: 15rem;" value="{{ old('foneResidencial') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Fone Residencial*</span>
                            </span>
                        </label>
                        <label for="foneCelular" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                            <input id="foneCelular" type="text" name="foneCelular" autofocus class="form-control @error('foneCelular') is-invalid @enderror field__input a-field__input" placeholder="Fone Celular" style="width: 15rem;" value="{{ old('foneCelular') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Fone Celular</span>
                            </span>
                        </label>
                        <label for="foneComercial" class="field a-field a-field_a2 page__field" style=" margin-left: 30px;">
                            <input id="foneComercial" type="text" name="foneComercial" autofocus class="form-control @error('foneComercial') is-invalid @enderror field__input a-field__input" placeholder="Fone Comercial*" style="width: 15rem;" value="{{ old('foneComercial') }}">
                            <span class="a-field__label-wrap">
                              <span class="a-field__label">Fone Comercial*</span>
                            </span>
                        </label>
                      </div>
                    </div>
              </div>
            </div>
        </div>
        <div class="form-group row mb-0" style="margin-top: 10px; margin-left: 10rem"> <!-- Button -->
          <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary btn-primary-lmts" >
              {{ __('Salvar') }}
            </button>

          </div>
        </div>
      </form>
    </div>
</div>
<script type="text/javascript" >


</script>


    @endsection
