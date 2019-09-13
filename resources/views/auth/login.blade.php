@extends('layouts.app')
@section('titulo','Entrar')
@section('navbar')
    Entrar
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header">{{ __('Entrar') }}</div>

                <div class="card-body " style="margin-left: 3rem">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row justify-content-center" >

                            <div class="col-md-6">
                              <label for="email" class="field a-field a-field_a3 page__field ">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">E-mail</span>
                                </span>
                              </label>
                              @error('email')
                              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-md-6">
                              <label for="password" class="field a-field a-field_a3 page__field" >
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input" name="password" required autocomplete="current-password" placeholder="Senha">

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
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Lembre-se de mim') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #1B2E4F;">
                                  {{ __('Esqueceu sua senha?   ') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6">
                              <a class="menu-principal" href="{{ route('register') }}" style="color: #1B2E4F;">Cadastrar</a>
                                <button type="submit" class="btn btn-primary" style="margin-left: 100px;background-color: #1B2E4F; border-color: #d3e0e9">
                                    {{ __('Entrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
