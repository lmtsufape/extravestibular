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
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input type="hidden" name="mytime" value="{{$mytime}}">

        </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
      <a class="nav-link" style="color: black" href="classificar"
         onclick="event.preventDefault();
                       document.getElementById('classificar').submit();">
         {{ __('Homologar Inscrições') }}
      </a>
      <form id="classificar" method="GET" action="{{route('editalEscolhido')}}">
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input type="hidden" name="tipo" value="homologarInscricoes">
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

  @media screen and (max-width:576px){
    #label{
      margin-left: -3%;
    }
  }
</style>
{{-- container --}}
<div class="container">
  {{-- row card dados pessoais do candidato --}}
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
                      <span class="a-field__label">Fone Residencial*</span>
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
                      <span class="a-field__label">Fone Comercial*</span>
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
                    <span class="a-field__label">Tipo de Matricula</span>
                  </span>
                </label>
                <input disabled id="Tipo de Matricula" type="text" name="Curso Pretendido" autofocus class="form-control field__input a-field__input" placeholder="Tipo de Matricula" value="{{ $inscricao->tipo }}">
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

      </div><!-- end card dados inscrição-->
    </div><!-- end card-->
  </div><!-- end row -->

  
  <div class="row" styles="<?php if($tipo != 'homologacao'){ echo("display: none");} ?>">
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

        <div class="row justify-content-center" style="margin-top:20px">
          
            <input onclick="selectCheck('aprovado')" id="selectDadosDoCursoAprovado" type="radio" name="radioDadosDoCurso" value="aprovado"> <h4 style="margin-left:1%">Aprovado</h4>
            
            <input style="margin-left:3%" onclick="selectCheck('rejeitado')" id="selectDadosDoCursoRejeitado"  type="radio" name="radioDadosDoCurso" value="rejeitado"> <h4 style="margin-left:1%">Rejeitado</h4>
          
        </div>

      </div><!-- end card-body -->
    </div><!-- end card -->
  </div><!-- end row-->


  <div class="row justify-content-center">
    <div class="card">
      <div class="card-header">{{ __('Documentos') }}</div>
      <div class="card-body">
          
        <div class="row justify-content-center">
          <div style="margin-top:-100px">
            <table class="table table-responsive table-ordered table-hover">
                <tr>
                  <th>Requisito</th>
                  <th>Dados</th>
                  <th style="text-align: center">Aprovado</th>
                  <th style="text-align: center">Rejeitado</th>
                </tr>
                <tr <?php if($inscricao->declaracaoDeVinculo == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                      <td>
                        <label for="declaracaoDeVinculo" >{{ __('Declaração de Vínculo') }}</label>
                      </td>
                      <div class="col-md-6">
                          <td>
                            <a href="{{ route('download', ['file' => $inscricao->declaracaoDeVinculo])}}" target="_blank">Abrir arquivo</a>
                          </td>
                          <td style="text-align: center">
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioDeclaracaoDeVinculo" id="selectDeclaracaoDeVinculoAprovado" <?php if($inscricao->declaracaoDeVinculo == ''){echo('checked="true"');} ?> >
                          </td>
                          <td style="text-align: center">
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioDeclaracaoDeVinculo" id="selectDeclaracaoDeVinculoRejeitado">
                          </td>
                      </div>
                  </div>
                </tr>
                <tr <?php if($inscricao->historicoEscolar == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="historicoEscolar" >{{ __('Histórico Escolar') }}</label>
                    </td>
                      <div class="col-md-6">
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                        </td>
                        <td style="text-align: center">
                          <input onclick=<?php if($tipo == 'drca'){echo("selectCheckDRCA('aprovado')");}else{ echo("selectCheck('aprovado')");} ?>  type="radio" name="radioHistoricoEscolar" id="selectHistoricoEscolarAprovado" <?php if($inscricao->historicoEscolar == ''){echo('checked="true"');} ?> >
                        </td>
                        <td style="text-align: center">
                          <input onclick=<?php if($tipo == 'drca'){echo("selectCheckDRCA('rejeitado')");}else{ echo("selectCheck('rejeitado')");} ?>  type="radio" name="radioHistoricoEscolar" id="selectHistoricoEscolarRejeitado" >
                        </td>
                      </div>
                  </div>
                </tr>
                <tr <?php if($inscricao->programaDasDisciplinas == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="programaDasDisciplinas" >{{ __('Programa das Disciplinas') }}</label>
                    </td>
                      <div class="col-md-6">
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->programaDasDisciplinas])}}" target="_blank">Abir arquivo</a>
                        </td>
                        <td style="text-align: center">
                          <input onclick="selectCheck('aprovado')"  type="radio" name="radioProgramaDasDisciplinas" id="selectProgramaDasDisciplinasAprovado" <?php if($inscricao->programaDasDisciplinas == ''){echo('checked="true"');} ?> >
                        </td>
                        <td style="text-align: center">
                          <input onclick="selectCheck('rejeitado')"  type="radio" name="radioProgramaDasDisciplinas" id="selectProgramaDasDisciplinasRejeitado">
                        </td>
                      </div>
                  </div>
                </tr>
                <tr <?php if($inscricao->curriculo == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="curriculo" >{{ __('Curriculo') }}</label>
                    </td>
                      <div class="col-md-6">
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->curriculo ])}}" target="_blank">Abrir arquivo</a>
                        </td>
                        <td style="text-align: center">
                          <input onclick="selectCheck('aprovado')"  type="radio" name="radioCurriculo" id="selectCurriculoAprovado" <?php if($inscricao->curriculo == ''){echo('checked="true"');} ?> >
                        </td>
                        <td style="text-align: center">
                          <input onclick="selectCheck('rejeitado')"  type="radio" name="radioCurriculo" id="selectCurriculoRejeitado">
                        </td>
                      </div>
                  </div>
                </tr>
                <tr <?php if($inscricao->enem == ''){echo('style="display: none"');} ?> >
                  <div class="form-group row" >
                    <td>
                      <label for="enem" >{{ __('ENEM') }}</label>
                    </td>
                      <div class="col-md-6">
                        <td>
                          <a href="{{ route('download', ['file' => $inscricao->enem ])}}" target="_blank">Abrir arquivo</a>
                        </td>
                        <td style="text-align: center">
                          <input onclick="selectCheck('aprovado')"  type="radio" name="radioEnem" id="selectEnemAprovado" <?php if($inscricao->enem == ''){echo('checked="true"');} ?> >
                        </td>
                        <td style="text-align: center">
                          <input onclick="selectCheck('rejeitado')"  type="radio" name="radioEnem" id="selectEnemRejeitado">
                        </td>
                      </div>
                  </div>
                </tr>

                @if($tipo == 'homologacao')
                  <tr>
                    <div class="form-group row" >
                      <td>
                        <label for="comprovante" >{{ __('Comprovante') }}</label>
                      </td>
                        <div class="col-md-6">
                          <td>
                            @if($inscricao->comprovante == 'isento')
                              <a>Isento</a>
                            @else
                              <a href="{{ route('download', ['file' => $inscricao->comprovante ])}}" target="_blank">Abrir arquivo</a>
                            @endif
                          </td>
                          <td style="text-align: center">
                            <input onclick="selectCheck('aprovado')"  type="radio" name="radioComprovante" id="selectComprovanteAprovado" <?php if($inscricao->comprovante == 'isento'){echo('checked="true"');} ?> >
                          </td>
                          <td style="text-align: center">
                            <input onclick="selectCheck('rejeitado')"  type="radio" name="radioComprovante" id="selectComprovanteRejeitado">
                          </td>
                        </div>
                    </div>
                  </tr>
                @endif

              </table><!-- end table -->

            </div><!-- end col-->
          </div><!-- end row-->
          <div class="row">
            <div class="col-sm-12">
                <form method="POST" action={{ route('homologarInscricao') }} enctype="multipart/form-data" id="formHomologacao">
                  @csrf
                  <div class="form-group" id="motivoRejeicao" style=" display: none;">
                    <div class="row">
                      <div class="col-sm-12">
                        <label id="label" for="motivoRejeicao">{{ __('Justificativa da Rejeição:') }}</label>
                      </div>
                      
                    </div>
                    <div class="row justify-content-center">
                      <div>
                        <textarea form ="formHomologacao" name="motivoRejeicao" id="taid" cols="115" style="width:100%"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- end row motivos -->
              <div class="row">

                <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                <input id="homologado" type="hidden" name="homologado" value="">
                <input id="tipo" type="hidden" name="tipo" value="{{$tipo}}">
              </div>
              <div class="row justify-content-center">
                <div>
                  <button id="buttonFinalizar" type="submit" class="btn btn-primary btn-primary-lmts" disabled="true">
                    {{ __('Finalizar') }}
                  </button>
                </div>
              </div>
            </form>
      </div><!-- end card-body -->
    </div><!-- end card-->
  </div><!-- end row -->
</div><!-- end container-->


<script type="text/javascript" >
function checkFinalizar(){
  if(document.getElementById("selectHistoricoEscolarAprovado").checked || document.getElementById("selectHistoricoEscolarRejeitado").checked){
    if(document.getElementById("selectDeclaracaoDeVinculoAprovado").checked || document.getElementById("selectDeclaracaoDeVinculoRejeitado").checked){
      if(document.getElementById("selectProgramaDasDisciplinasAprovado").checked || document.getElementById("selectProgramaDasDisciplinasRejeitado").checked){
        if(document.getElementById("selectCurriculoAprovado").checked || document.getElementById("selectCurriculoRejeitado").checked){
          if(document.getElementById("selectEnemAprovado").checked || document.getElementById("selectEnemRejeitado").checked){
            if(document.getElementById("selectDadosPessoaisAprovado").checked || document.getElementById("selectDadosPessoaisRejeitado").checked){
              if(document.getElementById("selectDadosDoCursoAprovado").checked || document.getElementById("selectDadosDoCursoRejeitado").checked){
                if(document.getElementById("selectInscricaoAprovado").checked || document.getElementById("selectInscricaoRejeitado").checked){
                  if(document.getElementById("selectComprovanteAprovado").checked || document.getElementById("selectComprovanteRejeitado").checked){
                    document.getElementById("buttonFinalizar").disabled = false;
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}

function checkAprovado(){
  if(document.getElementById("selectHistoricoEscolarAprovado").checked){
    if(document.getElementById("selectDeclaracaoDeVinculoAprovado").checked){
      if(document.getElementById("selectProgramaDasDisciplinasAprovado").checked){
        if(document.getElementById("selectCurriculoAprovado").checked){
          if(document.getElementById("selectEnemAprovado").checked){
            if(document.getElementById("selectDadosPessoaisAprovado").checked){
              if(document.getElementById("selectDadosDoCursoAprovado").checked){
                if(document.getElementById("selectInscricaoAprovado").checked){
                  if(document.getElementById("selectComprovanteAprovado").checked){
                    document.getElementById("homologado").value = 'aprovado';
                    document.getElementById("motivoRejeicao").value = '';
                    document.getElementById("motivoRejeicao").style.display = 'none';
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}


function selectCheckDRCA(x){
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = '';
    document.getElementById("homologado").value = 'rejeitado';
    document.getElementById("buttonFinalizar").disabled = false;
  }
  else{
    document.getElementById("homologado").value = 'aprovado';
    document.getElementById("motivoRejeicao").value = '';
    document.getElementById("motivoRejeicao").style.display = 'none';
    document.getElementById("buttonFinalizar").disabled = false;
  }
}


function selectCheck(x){
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = '';
    document.getElementById("homologado").value = 'rejeitado';
  }
  checkAprovado();
  checkFinalizar();
}





</script>
@endsection
