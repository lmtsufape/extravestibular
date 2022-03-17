@extends('layouts.app')
@section('titulo','Homologar Inscrição')
@section('navbar')
    <!-- Home / Detalhes do edital / Homologar Inscrição / {{$inscricao->cpfCandidato}} -->
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
          <input type="hidden" name="editalId" value="{{$inscricao->editalId}}">

        </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">{{$inscricao->user->dadosUsuario->cpf}}</a>
    </li>
@endsection
@section('content')
<style>
  #label{
    margin-left: 3%;
  }
  .card{
    width: 100%;
  }

  @media screen and (max-width:576px){
    #label{
      margin-left: -3%;
    }
  }
</style>
{{-- container --}}
<div class="container">
  {{-- row card dados pessoais do candidato --}}
  <form method="POST" action="{{ route('homologarInscricao') }}" enctype="multipart/form-data" id="formHomologacao">
    @csrf
    <div class="row justify-content-center">
      {{-- card dados pessoais do candidato --}}
      <div class="card">
        <div class="card-header">{{ __('Dados Pessoais do Candidato') }}</div>
        <div class="card-body">
          <div class="row justify-content-center"><!-- row nome cpf-->
              <div class="col-sm-9">
                  <label for="nome" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nome</span>
                    </span>
                  </label>
                  <input disabled id="nome" type="text" name="nome" autofocus class="form-control field__input a-field__input" placeholder="Nome"  value="{{ $dados->nome }}">
                </div><!-- end nome-->

                <div class="col-sm-3">
                    <label for="cpf" class="field a-field a-field_a2 page__field">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">CPF</span>
                        </span>
                      </label>
                      <input disabled id="cpf" type="text" name="cpf" autofocus class="form-control field__input a-field__input" placeholder="CPF" value="{{ $dados->cpf }}">

                  </div><!-- enc dpf-->
          </div><!-- row nome cpf-->
          <div class="row">
            <div class="col-sm-12">
                <label for="rg"
                    class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                        <span class="a-field__label">Email</span>
                    </span>
                </label>
                <input disabled
                    id="rg"
                    type="text"
                    name="rg"
                    autofocus
                    class="form-control field__input a-field__input"
                    placeholder="RG"
                    value="{{ $usuario->email }}">
            </div>
        </div>
          {{-- row rg oe uf te dn --}}
          <div class="row justify-content-center">
              <div class="col-sm-4">
                  <label for="rg" class="field a-field a-field_a2 page__field" >
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">RG</span>
                    </span>
                  </label>
                  <input disabled id="rg" type="text" name="rg" autofocus class="form-control field__input a-field__input" placeholder="RG" value="{{ $dados->rg }}">
              </div>

              <div class="col-sm-2">
                  <label for="orgaoEmissor" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Orgão Emissor</span>
                      </span>
                    </label>
                    <input disabled id="orgaoEmissor" type="text" name="orgaoEmissor" autofocus class="form-control field__input a-field__input" placeholder="Orgão Emissor" value="{{ $dados->orgaoEmissor }}">
              </div>

              <div class="col-sm-1">
                  <label for="orgaoEmissorUF" class="field a-field a-field_a2 page__field" >
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">UF</span>
                      </span>
                    </label>
                    <input disabled id="orgaoEmissorUF" type="text" name="orgaoEmissorUF" autofocus class="form-control field__input a-field__input" placeholder="UF" value="{{ $dados->orgaoEmissorUF }}">
              </div>

              <div class="col-sm-2">
                  <label for="tituloEleitoral" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Título Eleitoral</span>
                      </span>
                    </label>
                    <input disabled id="tituloEleitoral" type="text" name="tituloEleitoral" autofocus class="form-control field__input a-field__input" placeholder="Título Eleitoral"  value="{{ $dados->tituloEleitoral }}">
              </div>

              <div class="col-sm-3">
                  <label for="nascimento" class="field a-field a-field_a1 page__field" >
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Data de Nascimento</span>
                      </span>
                    </label>
                    <input disabled id="nascimento" type="date" name="nascimento" autofocus class="form-control field__input a-field__input" placeholder="Data de Nascimento"  value="{{ $dados->nascimento }}">
              </div>
          </div>{{-- row rg oe uf te dn --}}

          {{-- row filiação --}}
          <div class="row justify-content-center">
              <div class="col-sm-12">
                  <label for="filiacao" class="field a-field a-field_a1 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Filiação</span>
                    </span>
                  </label>
                  <input disabled id="filiacao" type="text" name="filiacao" autofocus class="form-control field__input a-field__input" placeholder="Filiação" value="{{ $dados->filiacao }}">
                </div>
          </div>{{-- end row filiação --}}

          {{-- row rua numero --}}
          <div class="row justify-content-center">

              <div class="col-sm-10">
                  <label for="endereco" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Rua</span>
                    </span>
                  </label>
                  <input disabled id="endereco" type="text" name="endereco" autofocus class="form-control field__input a-field__input" placeholder="Endereço" value="{{ $dados->endereco }}">
              </div>

              <div class="col-sm-2">
                  <label for="num" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nº</span>
                    </span>
                  </label>
                  <input disabled id="num" type="text" name="num" autofocus class=" form-control field__input a-field__input" placeholder="Nº" value="{{ $dados->num }}">
                </div>

          </div>{{-- end row rua numero --}}

          {{-- row bairro cidade uf--}}
          <div class="row justify-content-center">
            <div class="col-sm-5">
              <label for="bairro" class="field a-field a-field_a2 page__field" >
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Bairro</span>
                </span>
              </label>
              <input disabled id="bairro" type="text" name="bairro" autofocus class=" form-control field__input a-field__input" placeholder="Bairro" value="{{ $dados->bairro }}">
            </div>
            <div class="col-sm-5" >
              <label for="cidade" class="field a-field a-field_a2 page__field" >
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Cidade</span>
                </span>
              </label>
              <input disabled id="cidade" type="text" name="cidade" autofocus class=" form-control field__input a-field__input" placeholder="Cidade" value="{{ $dados->cidade }}">
            </div>
            <div class="col-sm-2">
              <label for="uf" class="field a-field a-field_a2 page__field" >
                <span class="a-field__label-wrap">
                  <span class="a-field__label">UF</span>
                </span>
              </label>
              <input disabled id="uf" type="text" name="uf" autofocus class=" form-control field__input a-field__input" placeholder="UF" value="{{ $dados->uf }}">
            </div>
          </div>{{-- end row bairro cidade uf--}}


          <div class="row justify-content-center">
              <div class="col-sm-4" style="<?php if(is_null($dados->foneResidencial)){echo("display: none");}  ?>">
                  <label for="foneResidencial" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Fone Residencial</span>
                      </span>
                    </label>
                    <input disabled id="foneResidencial" type="text" name="foneResidencial" autofocus class=" form-control field__input a-field__input" placeholder="Fone Residencial*" value="{{ $dados->foneResidencial }}">
                </div>
                <div class="col-sm-4" style="<?php if(is_null($dados->foneCelular)){echo("display: none");}  ?>">
                  <label for="foneCelular" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Fone Celular</span>
                      </span>
                    </label>
                    <input disabled id="foneCelular" type="text" name="foneCelular" autofocus class=" form-control field__input a-field__input" placeholder="Fone Celular" value="{{ $dados->foneCelular }}">
                </div>
                <div class="col-sm-4" style="<?php if(is_null($dados->foneComercial)){echo("display: none");}  ?>">
                  <label for="foneComercial" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Fone Comercial</span>
                      </span>
                    </label>
                    <input disabled id="foneComercial" type="text" name="foneComercial" autofocus class=" form-control field__input a-field__input" placeholder="Fone Comercial*" value="{{ $dados->foneComercial }}">
                </div>
          </div><!-- end row telefone-->
        </div><!-- end card-body -->
      </div><!-- end dados pessoais do candidato-->
    </div>{{--end row card dados pessoais do candidato --}}

    <div class="row">
      <div class="card">
        <div class="card-header">{{ __('Dados da inscrição') }}</div>
        {{-- card dados inscrição --}}
        <div class="card-body">
          <div class="row">
              <div class="col-sm-12">
                  <label for="Tipo de Matricula" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Tipo de Matrícula</span>
                    </span>
                  </label>
                  <input disabled id="Tipo de Matricula" type="text" name="Curso Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Tipo de Matrícula" value="<?php
                                                                                                                                                                                                 if($inscricao->tipo == 'reintegracao'){
                                                                                                                                                                                                   echo('Reintegração');
                                                                                                                                                                                                 }
                                                                                                                                                                                                 elseif($inscricao->tipo == 'transferenciaInterna'){
                                                                                                                                                                                                   echo('Transferência Interna');
                                                                                                                                                                                                 }
                                                                                                                                                                                                 elseif($inscricao->tipo == 'transferenciaExterna'){
                                                                                                                                                                                                   echo('Transferência Externa');
                                                                                                                                                                                                 }
                                                                                                                                                                                                 elseif($inscricao->tipo == 'portadorDeDiploma'){
                                                                                                                                                                                                   echo('Portador de Diploma');
                                                                                                                                                                                                 }
                                                                                                                                                                                                ?>">
                </div><!-- end tipo de matrícula-->
          </div><!-- end row-->

          <div class="row">
              <div class="col-sm-9">
                  <label for="Curso Pretendido" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Curso Pretendido</span>
                    </span>
                  </label>
                  <input disabled id="Curso Pretendido" type="text" name="Curso Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Curso Pretendido" value="{{ $curso }}">
                </div>
                <div class="col-sm-3">
                  <label for="Turno" class="field a-field a-field_a2 page__field" >
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Turno</span>
                    </span>
                  </label>
                  <input disabled id="Turno" type="text" name="Turno" autofocus class="form-control field__input a-field__input" placeholder="Turno" value="{{ $inscricao->turno }}">
                </div>


          </div>
          <div class="row">
            <div class="col-sm-9">
              <label class="field a-field a-field_a2 page__field">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Segunda opção</span>
                </span>
              </label>
              <input disabled type="text" autofocus class="form-control field__input a-field__input" placeholder="Curso Pretendido" value="{{ $curso2 }}">
            </div>
            <div class="col-sm-3">
              <label for="Turno" class="field a-field a-field_a2 page__field" >
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Turno</span>
                </span>
              </label>
              <input disabled id="Turno" type="text" name="Turno" autofocus class="form-control field__input a-field__input" placeholder="Turno" value="{{ $inscricao->turno_segunda_opcao }}">
            </div>
          </div>
        </div><!-- end card dados inscrição-->
      </div><!-- end card-->
    </div><!-- end row -->


    <div class="row" styles="<?php if($inscricao->tipo != 'homologacao'){ echo("display: none");} ?>">
      <div class="card">
        <div class="card-header">{{ __('Dados do Curso / Instituição de Origem') }}</div>
        <div class="card-body">
          <div class="row justify-content-center">

            <div class="col-sm-12">
              <label for="Curso de Origem" class="field a-field a-field_a2 page__field">
                <span class="a-field__label-wrap">
                  <span class="a-field__label">Curso de Origem</span>
                </span>
              </label>
              <input disabled id="Curso de Origem" type="text" name="Curso de Origem" autofocus class="form-control field__input a-field__input" placeholder="Curso de Origem" value="{{ $inscricao->cursoDeOrigem }}">
            </div>
          </div><!-- end row curso de origem-->


          <div class="row justify-content-center">
              <div class="col-sm-9">
                  <label for="Instituição de Origem" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Instituição de de Origem</span>
                    </span>
                  </label>
                  <input disabled id="Instituição de de Origem" type="text" name="Instituição de Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Instituição de de Origem"  value="{{ $inscricao->instituicaoDeOrigem }}">
                </div>
                <div class="col-sm-3">
                  <label for="Natureza da IES" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Natureza da IES</span>
                      </span>
                    </label>
                    <input disabled id="Natureza da IES" type="text" name="Natureza da IES" autofocus class="form-control field__input a-field__input" placeholder="Natureza da IES" value="{{ $inscricao->naturezaDaIes }}">
                </div>
          </div><!-- end row instituicao e IES-->

          <div class="row justify-content-center">
              <div class="col-sm-10">
                  <label for="endereco" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Endereço</span>
                    </span>
                  </label>
                  <input disabled id="endereco" type="text" name="endereco" autofocus class="form-control field__input a-field__input" placeholder="Endereço"  value="{{ $inscricao->endereco }}">
                </div>
                <div class="col-sm-2">
                  <label for="num" class="field a-field a-field_a2 page__field" >
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nº</span>
                    </span>
                  </label>
                  <input disabled id="num" type="text" name="num" autofocus class=" form-control field__input a-field__input" placeholder="Nº" value="{{ $inscricao->num }}">
                </div>
          </div><!-- end row -->

          <div class="row justify-content-center">
              <div class="col-sm-5">
                  <label for="bairro" class="field a-field a-field_a2 page__field" >
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Bairro</span>
                    </span>
                  </label>
                  <input disabled id="bairro" type="text" name="bairro" autofocus class=" form-control field__input a-field__input" placeholder="Bairro" value="{{ $inscricao->bairro }}">
                </div>
                <div class="col-sm-5">
                  <label for="cidade" class="field a-field a-field_a2 page__field" >
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Cidade</span>
                      </span>
                    </label>
                    <input disabled id="cidade" type="text" name="cidade" autofocus class=" form-control field__input a-field__input" placeholder="Cidade" value="{{ $inscricao->cidade }}">
                </div>
                <div class="col-sm-2">
                  <label for="uf" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">UF</span>
                      </span>
                    </label>
                    <input disabled id="uf" type="text" name="uf" autofocus class=" form-control field__input a-field__input" placeholder="UF" value="{{ $inscricao->uf }}">
                </div>

          </div><!-- end row-->
        </div><!-- end card-body -->
      </div><!-- end card -->
    </div><!-- end row-->

    <div class="row" styles="">
      <div class="card" style="width: 100%">
        <div class="card-header">{{ __('Dados da Instituição que cursou o Ensino Médio') }}</div>
        <div class="card-body">
          <div class="row justify-content-center">
              <div class="col-sm-9">
                  <label for="Instituição de Origem" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Instituição</span>
                    </span>
                  </label>
                  <input disabled id="Instituição de de Origem" type="text" name="Instituição de Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Instituição de de Origem"  value="{{ $inscricao->escola_em }}">
                </div>
                <div class="col-sm-3">
                  <label for="Natureza da IES" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Natureza da Instituição</span>
                      </span>
                    </label>
                    <input disabled id="Natureza da IES" type="text" name="Natureza da IES" autofocus class="form-control field__input a-field__input" placeholder="Natureza da IES" value="{{ $inscricao->natureza_em }}">
                </div>
          </div><!-- end row instituicao e IES-->

          <div class="row justify-content-center">
              <div class="col-sm-10">
                  <label for="endereco" class="field a-field a-field_a2 page__field">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Endereço</span>
                    </span>
                  </label>
                  <input disabled id="endereco" type="text" name="endereco" autofocus class="form-control field__input a-field__input" placeholder="Endereço"  value="{{ $inscricao->endereco_em }}">
                </div>
                <div class="col-sm-2">
                  <label for="num" class="field a-field a-field_a2 page__field" >
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Nº</span>
                    </span>
                  </label>
                  <input disabled id="num" type="text" name="num" autofocus class=" form-control field__input a-field__input" placeholder="Nº" value="{{ $inscricao->num_em }}">
                </div>
          </div><!-- end row -->

          <div class="row justify-content-center">
              <div class="col-sm-5">
                  <label for="bairro" class="field a-field a-field_a2 page__field" >
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Bairro</span>
                    </span>
                  </label>
                  <input disabled id="bairro" type="text" name="bairro" autofocus class=" form-control field__input a-field__input" placeholder="Bairro" value="{{ $inscricao->bairro_em }}">
                </div>
                <div class="col-sm-5">
                  <label for="cidade" class="field a-field a-field_a2 page__field" >
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Cidade</span>
                      </span>
                    </label>
                    <input disabled id="cidade" type="text" name="cidade" autofocus class=" form-control field__input a-field__input" placeholder="Cidade" value="{{ $inscricao->cidade_em }}">
                </div>
                <div class="col-sm-2">
                  <label for="uf" class="field a-field a-field_a2 page__field">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">UF</span>
                      </span>
                    </label>
                    <input disabled id="uf" type="text" name="uf" autofocus class=" form-control field__input a-field__input" placeholder="UF" value="{{ $inscricao->uf_em }}">
                </div>

          </div><!-- end row-->
        </div><!-- end card-body -->
      </div><!-- end card -->
    </div><!-- end row-->

    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">{{ __('Documentos') }}</div>
        <div class="card-body">

          <div class="row">
            <div class="col-sm-12 mt-0" style="width:100%">
              <table class="table table-ordered table-hover">
                  <thead>
                    <tr>
                      <th>Requisito</th>
                      <th>Dados</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr <?php if($inscricao->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="declaracaoDeVinculo" >{{ __('Declaração de Vínculo') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->historicoEnsinoMedio == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="historicoEnsinoMedio" >{{ __('Histórico e Certificado de conclusão do ensino médio') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->historicoEnsinoMedio])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->certidaoNascimento == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="certidaoNascimento" >{{ __('Certidão de nascimento ou registro de casamento') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->certidaoNascimento])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->reservista == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="reservista" >{{ __('Reservista') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->reservista])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->quitacaoEleitoral == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="quitacaoEleitoral" >{{ __('Certidão de quitação eleitoral') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->quitacaoEleitoral])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->diploma == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="quitacaoEleitoral" >{{ __('Diploma  de  curso  de  graduação') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->diploma])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->cpf == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="cpf" >{{ __('CPF') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->cpf])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->rg == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="rg" >{{ __('RG') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->rg])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->declaracaoENADE == null){echo('style="display: none"');} ?> >
                      <div>
                          <td>
                            <label for="declaracaoENADE" >{{ __('Declaração de regularidade com o Exame Nacional de Desempenho dos Estudantes (ENADE).') }}</label>
                          </td>
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->declaracaoENADE])}}" target="_blank">Abrir arquivo</a>
                          </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->historicoEscolar == ''){echo('style="display: none"');} ?> >
                      <div>
                        <td>
                          <label for="historicoEscolar" >{{ __('Histórico escolar do curso de graduação') }}</label>
                        </td>
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                        </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >

                      <div>
                        <td>
                          <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                        </td>
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                        </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->curriculo == ''){echo('style="display: none"');} ?> >
                      <div>
                        <td>
                          <label for="curriculo" >{{ __('Curriculo') }}</label>
                        </td>
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->curriculo ])}}" target="_blank">Abrir arquivo</a>
                        </td>
                      </div>
                    </tr>
                    <tr <?php if($inscricao->enem == ''){echo('style="display: none"');} ?> >
                      <div>
                        <td>
                          <label for="enem" >{{ __('ENEM') }}</label>
                        </td>
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->enem ])}}" target="_blank">Abrir arquivo</a>
                        </td>
                      </div>
                    </tr>


                    @if($inscricao->tipo == 'homologacao')
                      <tr>
                        <div>
                          <td>
                            <label for="comprovante" >{{ __('Comprovante') }}</label>
                          </td>
                          <td>
                            @if($inscricao->comprovante == 'isento')
                              <a>Isento</a>
                            @else
                              <a href="{{ route('download', ['file' => $inscricao->comprovante ])}}" target="_blank">Abrir arquivo</a>
                            @endif
                          </td>

                        </div>
                      </tr>
                    @endif

                  </tbody>
                </table><!-- end table -->

              </div><!-- end col-->
            </div><!-- end row-->
        </div><!-- end card-body -->
      </div><!-- end card-->
    </div><!-- end row -->
      <div class="row justify-content-center">

                <div class="card" style="width: 100%">
                  <div class="card-header">{{ __('Parecer') }}</div>
                  <div class="card-body">
                    @if($inscricao->homologado != 'nao')
                            <div class="row justify-content-center" style="margin-top:20px">
                            <div class="col-sm-1">
                                <input disabled id="radioDeferida" @if($inscricao->homologado == 'aprovado') checked @endif type="radio">
                            </div>
                            <div id="label" class="col-sm-2" style="margin-left:-5%"><h4>Deferida</h4></div>
                            <div class="col-sm-1">
                                <input disabled id="radioIndeferida" type="radio" @if($inscricao->homologado == 'rejeitado') checked @endif>
                            </div>
                            <div id="label" class="col-sm-2" style="margin-left:-5%"><h4>Indeferida</h4></div>

                            </div>
                            @if($inscricao->homologado == 'rejeitado')
                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group" id="motivoRejeicao">
                                    <div class="row justify-content-left">
                                        <div class="col-sm-6">
                                        <label for="motivoRejeicao" class="col-form-label text-md-right" >{{ __('Justificativa:') }}</label>

                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-12">
                                            <textarea disabled class=" form-control" form ="formHomologacao" name="motivoRejeicao" id="taid" style="width:100%" >{{$inscricao->motivoRejeicao}}</textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endif
                    @else
                                <h4>Processando</h4>
                    @endif



                </div><!-- end card-body -->
              </div><!-- end card-->

    </div><!-- end row-->
  </form>
</div><!-- end container-->
@endsection
