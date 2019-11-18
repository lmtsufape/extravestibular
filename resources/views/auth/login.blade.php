@extends('layouts.viewLogin')
@section('titulo','Entrar')

@section('content')

<style media="screen">
  #login{
    height: 100vh;
  }
  #btn{
    margin-top: -12%;
    margin-left: 60%;
  }
  #link{
    margin-left: 12%;
    margin-top: 5%;
  }
  @media screen and (max-width: 576px){
    #login{
      height: 105vh;
    }
    #btn{
      margin-top: -10%;
      margin-left: 60%;
    }
    #link{
      margin-top: 10%;
      margin-left: 3%;

    }

  }
</style>
<!-- box-shadow: inset 0 0 7px rgba(0,0,0,0.5); -->

<div class="container-fluid" style=" box-shadow: inset 0 0 7px rgba(0,0,0,0.5);">
  <div id="row1" class="row" style="">


    <!-- editais -->
    <div id="editais" class="col-sm-9  container-fluid" style="">
        <!-- titulo editais Abertos -->
        <div class="titulo-tabela-lmts">
          <h2>Editais Abertos</h2>
        </div><!-- end titulo editais Abertos -->
        <!-- table editais abertos  -->
        <table class="table table-ordered table-hover">
          <?php $editaisAbertos = true;
                $editaisAbertosFlag = true;
                $editaisFinalizadosFlag = true; ?>
          @foreach ($editais as $edital)
            <?php if($edital->resultadoFinal <= $mytime){
              $editaisAbertos = false;
            }
            else{
              $editaisAbertos = true;
            }
            ?>
            @if($editaisAbertos)
              @if($editaisAbertosFlag)
                <tr style="background-color: #F7F7F7">
                  <th> Nome</th><?php $editaisAbertosFlag = false;?>
                  <th style="width:10%"> Publicado em </th>
                  <th> Arquivo </th>
                </tr>
              @endif
            @else
              @if($editaisFinalizadosFlag)
                </table>
                <div class="titulo-tabela-lmts">
                  <h2>Editais Finalizados</h2>
                </div>
                <table class="table table-ordered table-hover">
                  <tr style="background-color: #F7F7F7">
                    <th> Nome</th><?php $editaisFinalizadosFlag = false;?>
                    <th> Publicado em </th>
                    <th> Arquivo </th>
                  </tr>
              @endif
            @endif
            <tr>

              <td style="width: 60rem">
                 <a>
                   <?php
                     $nomeEdital = explode(".pdf", $edital->nome);
                     echo ($nomeEdital[0]);
                    ?>
                 </a>
              </td>
              <td> <!-- data -->
                <?php
                  $date = date_create($edital->dataPublicacao);
                 ?>
                <a>{{ date_format($date , 'd/m/y')  }}</a>
              </td>
              <td> <!-- Download -->
                <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_parent">Baixar Edital</a>
              </td>

            </tr>
          @endforeach

        </table>

      <div class="card-body">
        {{ $editais->links() }}
      </div>

    </div><!-- end editais -->

    <!-- login -->
    <div id="login" class="col-sm-3" style="background-color:#EEE;">
      <form method="POST" action="{{ route('loginApi') }}">
          @csrf

        <!-- nome entrar -->
        <div class="row justify-content-center" style="">
          <h2 class="text-center">Entrar</h2>
        </div><!-- end nome entrar -->

        <!-- email -->
        <div class="row justify-content-center" style="">
          <div class="col-md-8">
              <span class="a-field__label-wrap">
                <span class="a-field__label">E-mail</span>
              </span>
              <label for="email" class="field a-field a-field_a3 page__field" style="width:100%">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror field__input a-field__input"
              name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">

              </label>
              @error('email')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
        </div><!-- end email -->

        <!-- senha -->
        <div class="row justify-content-center">
          <div class="col-md-8">
              <span class="a-field__label-wrap">
                <span class="a-field__label">Senha</span>
              </span>
              <label for="password" class="field a-field a-field_a3 page__field" style="width:100%" >
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror field__input a-field__input"
              name="password" required autocomplete="current-password" placeholder="Senha">

              </label>
              @error('password')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
        </div><!-- end senha -->

        <!-- row lembre-se de mim | Esqueceu senha -->
        <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                      {{ __('Lembre-se de mim') }}
                  </label>
              </div>
              @if (Route::has('password.request'))
              <a class="btn btn-link" href="#" style="color: #1B2E4F; opacity: 0">
                {{ __('Esqueceu sua senha?   ') }}
              </a>
              @endif
          </div>
        </div><!-- end row lembre-se de mim | Esqueceu senha -->

        <!-- botões -->
        <div class="container">

          <div id="link" class="col-sm-5">
            <a class="menu-principal" href="{{route('register')}}" style="">Cadastrar</a>
          </div>

          <div id="btn" class="col-sm-3" style="margin-top: -25px">
              <button type="submit" class="btn btn-primary"  style="background-color: #1B2E4F; border-color: #d3e0e9">
                  {{ __('Entrar') }}
              </button>
          </div>
        </div><!-- end botões -->



      </form>
    </div><!-- end login -->


  </div>
</div>

@endsection
