@extends('layouts.app')
@section('titulo','Entrar')

@section('content')
<div class="info" >
    <div class="info-texto" >
        <div style="">
          <div class="card">
              <div class="titulo-tabela-lmts">
                <h2>Editais Abertos</h2>
              </div>
              <div class="card-body">
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
                          <th> Publicado em </th>
                          <th> Arquivo </th>
                        </tr>
                      @endif
                    @else
                      @if($editaisFinalizadosFlag)
                      </table>
                      </div>
                      <div class="titulo-tabela-lmts">
                        <h2>Editais Finalizados</h2>
                      </div>
                      <div class="card-body">
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
                        <div class="hover-popup-lmts">   <!-- time line  class="hover-popup-lmts"-->
                         <a>
                           <?php
                             $nomeEdital = explode(".pdf", $edital->nome);
                             echo ($nomeEdital[0]);
                            ?>
                           <span>
                             <img src="<?php
                              if($edital->inicioIsencao > $mytime){
                                echo (asset('images/timeline1.png'));
                              }

                              elseif(($edital->inicioIsencao <= $mytime) && ($edital->fimIsencao >= $mytime)){
                                  echo (asset('images/timeline2.png'));
                              }

                              elseif(($edital->inicioRecursoIsencao <= $mytime) && ($edital->fimRecursoIsencao >= $mytime)){
                                  echo (asset('images/timeline3.png'));

                              }

                              elseif(($edital->inicioInscricoes <= $mytime) && ($edital->fimInscricoes >= $mytime)){
                                  echo (asset('images/timeline4.png'));

                              }
                              elseif(($edital->inicioRecurso <= $mytime) && ($edital->fimRecurso >= $mytime)){
                                  echo (asset('images/timeline5.png'));
                              }
                              elseif($edital->fimRecurso <= $mytime){
                                echo (asset('images/timeline6.png'));
                              }


                             ?>" alt="image" height="140"/>
                           </span>
                         </a>

                        </div>
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
              </div>
              <div class="card-body">
                {{ $editais->links() }}
              </div>
          </div>
        </div>


    </div>


    <div class="info-login" style="box-shadow: inset 0 0 7px rgba(0,0,0,0.5);">

            <h2 class="text-center">Entrar</h2>

            <form method="POST" action="{{ route('loginApi') }}">
                @csrf
                <div class="form-group">
                    <!--
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                    -->

                    <!-- Form E-mail -->
                    <div class="form-group row formulario-centro">

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
                    </div>


                </div>

                <!-- Form Senha -->
                <div class="form-group row formulario-centro">

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
                </div>
                <div class="form-group row formulario-centro" style="padding-left:70px">
                        <div class="col-md-6 ">
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
                    </div>

                    <div class="form-group row mb-0 justify-content-center ">
                        <div class="row " style="margin-top:20px">
                                <div class="col-md-6 " style="">
                                <a class="menu-principal" href="{{route('register')}}" style="color: #1B2E4F; margin-left: 10px">Cadastrar</a>
                                </div>

                                <div class="col-md-6 " style="margin-left: -14px; margin-top: -4px">
                                    <button type="submit" class="btn btn-primary"  style="margin-left: 100px;background-color: #1B2E4F; border-color: #d3e0e9">
                                        {{ __('Entrar') }}
                                    </button>
                                </div>
                        </div>

                </div>

            </form>
    </div>
</div>
@endsection
