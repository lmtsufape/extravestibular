@extends('layouts.viewLogin')
@section('titulo','Cadastrar')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row" style="display: none">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="." class="form-control @error('name') is-invalid @enderror" name="name" s>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Endereço de E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-primary-lmts">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 -->

<style media="screen">
  #margin{
    margin-bottom: 20px;
  }
  #login{
    background-color: #fff;
    height: 80vh;
    box-shadow: inset 0 0 7px rgba(0,0,0,0.5);
  }
  
  @media screen and (max-width:576px){
    #login{
      background-color: #fff;
      height: 90vh;
      box-shadow: inset 0 0 7px rgba(0,0,0,0.5);
    }
    #link{
        margin-left: 50%;
    }
    #botao{
        margin-left: 110%;
    }
  }
</style>

<div class="container-fluid">
  <div class="row justify-content-center"  style="background-color: #ccc;">
    <!-- cadastro -->
    <div id="login" class="col-sm-4">
      <div class="row justify-content-center" style="margin-top:50px">
        <h1>Cadastro</h1>
      </div><!-- end titulo-->
      <!-- row nome -->
      <div class="row justify-content-center" style="margin-top:50px">
        <form action="{{ route('register') }}" method="POST">
          @csrf

          <!-- Form Nome -->

          <div class="form-group row formulario-centro" style="display:none">
              <div class="col-md-9">
                  <label for="name" class="field a-field a-field_a3 page__field ">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nome</span>
                    </span>
                  <input id="name" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                  name="name" value=".">

                  </label>
                  @error('email')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
          </div>

          <!-- Form E-mail -->
          <div id="margin" class="row">
              <div class="col-sm-12">
                  <label for="email" class="field a-field a-field_a3 page__field ">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">E-mail</span>
                    </span>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
                  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

                  </label>
                  @error('email')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
          </div><!-- end Form E-mail -->

          <!-- Senha -->
          <div id="margin" class="row">
            <div class="col-md-12">
                <label for="password" class="field a-field a-field_a3 page__field" >
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Senha</span>
                  </span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                name="password" required autocomplete="current-password" placeholder="Senha">

                </label>
                @error('password')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div><!-- end Senha -->

          <!-- confirmar senha -->
          <div id="margin" class="row">
            <div class="col-md-12">
                <label for="password-confirm" class="field a-field a-field_a3 page__field" >
                  <span class="a-field__label-wrap">
                    <span class="a-field__label">Confirmar Senha</span>
                  </span>
                <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror field__input a-field__input"
                name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">

                </label>
                @error('password')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div><!-- end confirmar senha -->

          <!-- botoes -->
          <div id="margin" class="row">
            <div class="offset-sm-1" style="margin-top:5px">
                <a id="link" class="menu-principal" href="{{  route('login')}}" style="color: #1B2E4F;">Voltar</a>
            </div>

            <div class="offset-sm-4" style="">
                <button id="botao" type="submit" class="btn btn-primary"  style="background-color: #1B2E4F; border-color: #d3e0e9">
                    {{ __('Cadastrar') }}
                </button>
            </div>
          </div><!-- botoes -->


        </form>

      </div><!-- end row nome -->

    </div><!-- end cadastro-->
  </div>

</div><!-- end container-->

<!-- <div class="background" >


    <div class="background">
        <div class="centro " style="box-shadow: inset 0 0 7px rgba(0,0,0,0.5);">
                <h2 class="row d-flex justify-content-center" >Cadastro</h2>

                <form action="{{ route('register') }}" method="POST">

                  @csrf
                        <div class="form-group"> -->



                            <!--
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                            -->

                    <!-- Form Nome -->

                    <!-- <div class="form-group row formulario-centro" style="display:none">
                        <div class="col-md-9">
                            <label for="name" class="field a-field a-field_a3 page__field ">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror field__input a-field__input"
                            name="name" value=".">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Nome</span>
                            </span>
                            </label>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> -->






                    <!-- Form E-mail -->
                    <!-- <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="email" class="field a-field a-field_a3 page__field ">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">E-mail</span>
                            </span>
                            </label>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> -->


                    <!-- Form Senha -->
                    <!-- <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="password" class="field a-field a-field_a3 page__field" >
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
                            name="password" required autocomplete="current-password" placeholder="Senha">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Senha</span>
                            </span>
                            </label>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> -->

                    <!-- Form Confirmar Senha -->
                    <!-- <div class="form-group row formulario-centro">

                        <div class="col-md-9">
                            <label for="password-confirm" class="field a-field a-field_a3 page__field" >
                            <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror field__input a-field__input"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">

                            <span class="a-field__label-wrap">
                                <span class="a-field__label">Confirmar Senha</span>
                            </span>
                            </label>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> -->

                    <!-- Botões -->
                    <!-- <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:20px; margin-left:-30px">
                                <div class="col-md-6 " style="">
                                    <a class="menu-principal" href="{{  route('login')}}" style="color: #1B2E4F; margin-left: -20px">Voltar</a>
                                </div>

                                <div class="col-md-6 " style="margin-left: -30px; margin-top: -4px">
                                    <button type="submit" class="btn btn-primary"  style="margin-left: 60px;background-color: #1B2E4F; border-color: #d3e0e9">
                                        {{ __('Entrar') }}
                                    </button>
                                </div>
                        </div>

                    </div>




              </form>
          </div>
      </div> -->


@endsection
