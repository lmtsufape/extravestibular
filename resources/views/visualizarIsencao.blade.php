@extends('layouts.app')
@section('titulo', 'Homologar Isenção')
@section('navbar')
    <!-- Home / Detalhes do edital / Homologar Isenção / {{ $isencao->cpfCandidato }} -->
    <li class="nav-item active">
        <a class="nav-link"
            style="color: black"
            href="{{ route('home') }}"
            onclick="event.preventDefault();
                               document.getElementById('VerEditais').submit();">
            {{ __('Home') }}
        </a>
        <form id="VerEditais"
            action="{{ route('home') }}"
            method="GET"
            style="display: none;">

        </form>
    </li>
    <li class="nav-item active">
        <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link"
            href="detalhes"
            style="color: black"
            onclick="event.preventDefault(); document.getElementById('detalhesEdital').submit();">
            {{ __('Detalhes do Edital') }}
        </a>
        @if (Auth::check())
            <form id="detalhesEdital"
                action="{{ route('detalhesEdital') }}"
                method="GET"
                style="display: none;">
            @else
                <form id="detalhesEdital"
                    action="{{ route('detalhesEditalServidor') }}"
                    method="GET"
                    style="display: none;">
        @endif
        <input type="hidden"
            name="editalId"
            value="{{ $editalId }}">
        <input type="hidden"
            name="mytime"
            value="{{ $mytime }}">

        </form>
    </li>
    <li class="nav-item active">
        <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link"
            style="color: black"
            href="classificar"
            onclick="event.preventDefault();
                               document.getElementById('classificar').submit();">
            {{ __('Homologar Isenção') }}
        </a>
        <form id="classificar"
            method="GET"
            action="{{ route('editalEscolhido') }}">
            <input type="hidden"
                name="editalId"
                value="{{ $editalId }}">
            <input type="hidden"
                name="tipo"
                value="homologarIsencao">
        </form>
    </li>
    <li class="nav-item active">
        <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link">{{ $isencao->user->dadosUsuario->cpf }}</a>
    </li>
@endsection
@section('content')

    <style>
        .card {
            width: 100%;
        }

        @media screen and (max-width: 576px) {
            #label {
                float: left;
            }
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Declaração') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="">
                            <h4>DECLARAÇÃO DO CANDIDATO NOS TERMOS DA LEI:</h4>
                        </div>
                    </div><!-- end row declaracao-->
                    <div class="row justify-content-center">

                        @if ($isencao->tipo == 'ambos')
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    I - o candidato declara-se impossibilitado de arcar com o pagamento da taxa de inscrição
                                    e comprovar renda familiar mensal igual inferior a um salário mínimo e meio.
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    II – ter cursado o ensino médio completo em escola da rede pública ou como bolsista
                                    integral em escola da rede privada.
                                </div>
                            </div>
                        @elseif($isencao->tipo == "renda")
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    I - o candidato declara-se impossibilitado de arcar com o pagamento da taxa de inscrição
                                    e comprovar renda familiar mensal igual inferior a um salário mínimo e meio.
                                </div>
                            </div>
                        @else
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    II – ter cursado o ensino médio completo em escola da rede pública ou como bolsista
                                    integral em escola da rede privada.
                                </div>
                            </div>
                        @endif
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end row card-->


        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Dados Pessoais do Candidato') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <!-- row nome cpf-->
                        <div class="col-sm-9">
                            <label for="nome"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Nome</span>
                                </span>
                            </label>
                            <input disabled
                                id="nome"
                                type="text"
                                name="nome"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="Nome"
                                value="{{ $isencao->user->dadosusuario->nome }}">
                        </div><!-- end nome-->

                        <div class="col-sm-3">
                            <label for="cpf"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">CPF</span>
                                </span>
                            </label>
                            <input disabled
                                id="cpf"
                                type="text"
                                name="cpf"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="CPF"
                                value="{{ $isencao->user->dadosusuario->cpf }}">

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
                                value="{{ $isencao->user->email }}">
                        </div>
                    </div>
                    {{-- row rg oe uf te dn --}}
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <label for="rg"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">RG</span>
                                </span>
                            </label>
                            <input disabled
                                id="rg"
                                type="text"
                                name="rg"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="RG"
                                value="{{ $isencao->user->dadosusuario->rg }}">
                        </div>

                        <div class="col-sm-2">
                            <label for="orgaoEmissor"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Orgão Emissor</span>
                                </span>
                            </label>
                            <input disabled
                                id="orgaoEmissor"
                                type="text"
                                name="orgaoEmissor"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="Orgão Emissor"
                                value="{{ $isencao->user->dadosusuario->orgaoEmissor }}">
                        </div>

                        <div class="col-sm-1">
                            <label for="orgaoEmissorUF"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">UF</span>
                                </span>
                            </label>
                            <input disabled
                                id="orgaoEmissorUF"
                                type="text"
                                name="orgaoEmissorUF"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="UF"
                                value="{{ $isencao->user->dadosusuario->orgaoEmissorUF }}">
                        </div>

                        <div class="col-sm-2">
                            <label for="tituloEleitoral"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Título Eleitoral</span>
                                </span>
                            </label>
                            <input disabled
                                id="tituloEleitoral"
                                type="text"
                                name="tituloEleitoral"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="Título Eleitoral"
                                value="{{ $isencao->user->dadosusuario->tituloEleitoral }}">
                        </div>

                        <div class="col-sm-3">
                            <label for="nascimento"
                                class="field a-field a-field_a1 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Data de Nascimento</span>
                                </span>
                            </label>
                            <input disabled
                                id="nascimento"
                                type="date"
                                name="nascimento"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="Data de Nascimento"
                                value="{{ $isencao->user->dadosusuario->nascimento }}">
                        </div>
                    </div>{{-- row rg oe uf te dn --}}

                    {{-- row filiação --}}
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <label for="filiacao"
                                class="field a-field a-field_a1 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Filiação</span>
                                </span>
                            </label>
                            <input disabled
                                id="filiacao"
                                type="text"
                                name="filiacao"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="Filiação"
                                value="{{ $isencao->user->dadosusuario->filiacao }}">
                        </div>
                    </div>{{-- end row filiação --}}

                    {{-- row rua numero --}}
                    <div class="row justify-content-center">

                        <div class="col-sm-10">
                            <label for="endereco"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Rua</span>
                                </span>
                            </label>
                            <input disabled
                                id="endereco"
                                type="text"
                                name="endereco"
                                autofocus
                                class="form-control field__input a-field__input"
                                placeholder="Endereço"
                                value="{{ $isencao->user->dadosusuario->endereco }}">
                        </div>

                        <div class="col-sm-2">
                            <label for="num"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Nº</span>
                                </span>
                            </label>
                            <input disabled
                                id="num"
                                type="text"
                                name="num"
                                autofocus
                                class=" form-control field__input a-field__input"
                                placeholder="Nº"
                                value="{{ $isencao->user->dadosusuario->num }}">
                        </div>

                    </div>{{-- end row rua numero --}}

                    {{-- row bairro cidade uf --}}
                    <div class="row justify-content-center">
                        <div class="col-sm-5">
                            <label for="bairro"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Bairro</span>
                                </span>
                            </label>
                            <input disabled
                                id="bairro"
                                type="text"
                                name="bairro"
                                autofocus
                                class=" form-control field__input a-field__input"
                                placeholder="Bairro"
                                value="{{ $isencao->user->dadosusuario->bairro }}">
                        </div>
                        <div class="col-sm-5">
                            <label for="cidade"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Cidade</span>
                                </span>
                            </label>
                            <input disabled
                                id="cidade"
                                type="text"
                                name="cidade"
                                autofocus
                                class=" form-control field__input a-field__input"
                                placeholder="Cidade"
                                value="{{ $isencao->user->dadosusuario->cidade }}">
                        </div>
                        <div class="col-sm-2">
                            <label for="uf"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">UF</span>
                                </span>
                            </label>
                            <input disabled
                                id="uf"
                                type="text"
                                name="uf"
                                autofocus
                                class=" form-control field__input a-field__input"
                                placeholder="UF"
                                value="{{ $isencao->user->dadosusuario->uf }}">
                        </div>
                    </div>{{-- end row bairro cidade uf --}}


                    <div class="row justify-content-center">
                        <div class="col-sm-4"
                            style="<?php if (is_null($isencao->user->dadosusuario->foneResidencial)) {
                                echo 'display: none';
                            } ?>">
                            <label for="foneResidencial"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Fone Residencial</span>
                                </span>
                            </label>
                            <input disabled
                                id="foneResidencial"
                                type="text"
                                name="foneResidencial"
                                autofocus
                                class=" form-control field__input a-field__input"
                                placeholder="Fone Residencial*"
                                value="{{ $isencao->user->dadosusuario->foneResidencial }}">
                        </div>
                        <div class="col-sm-4"
                            style="<?php if (is_null($isencao->user->dadosusuario->foneCelular)) {
                                echo 'display: none';
                            } ?>">
                            <label for="foneCelular"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Fone Celular</span>
                                </span>
                            </label>
                            <input disabled
                                id="foneCelular"
                                type="text"
                                name="foneCelular"
                                autofocus
                                class=" form-control field__input a-field__input"
                                placeholder="Fone Celular"
                                value="{{ $isencao->user->dadosusuario->foneCelular }}">
                        </div>
                        <div class="col-sm-4"
                            style="<?php if (is_null($isencao->user->dadosusuario->foneComercial)) {
                                echo 'display: none';
                            } ?>">
                            <label for="foneComercial"
                                class="field a-field a-field_a2 page__field">
                                <span class="a-field__label-wrap">
                                    <span class="a-field__label">Fone Comercial</span>
                                </span>
                            </label>
                            <input disabled
                                id="foneComercial"
                                type="text"
                                name="foneComercial"
                                autofocus
                                class=" form-control field__input a-field__input"
                                placeholder="Fone Comercial*"
                                value="{{ $isencao->user->dadosusuario->foneComercial }}">
                        </div>
                    </div><!-- end row telefone-->
                </div><!-- end card-body -->
            </div>
            @if ($isencao->tipo == 'ambos')
                <div class="card"
                    style="">
                    <div class="card-header">{{ __('Arquivos anexados pelo candidato') }}</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <h3 for="historicoEscolar"
                                style="">{{ __('Histórico Escolar') }}</h3>
                        </div>
                        <div class="row justify-content-center">
                            <h5>
                                <a style=""
                                    href="{{ route('download', ['file' => $isencao->historicoEscolar]) }}"
                                    target="_new">Abrir arquivo</a>
                            </h5>
                        </div>
                        @if ($isencao->nis)
                            <div class="row justify-content-center pt-3">
                                <h3 for="nis"
                                    style="">{{ __('NIS') }}</h3>
                            </div>
                            <div class="row justify-content-center pt-0">
                                <h5>
                                    <a style=""
                                        href="{{ route('download', ['file' => $isencao->nis]) }}"
                                        target="_new">Abrir arquivo</a>
                                </h5>
                            </div>
                        @endif
                    </div><!-- end card body-->
                </div>
                <div class="card"
                    style="">
                    <div class="card-header">{{ __('Dados econômicos') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Nome:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->nomeDadoEconomico }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>CPF:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->cpfDadoEconomico }} </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Parentesco:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->parentescoDadoEconomico }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Renda Mensal:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->rendaDadoEconomico }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Fonte pagadora:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->fontePagadoraDadoEconomico }}</h4>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card-->
                <div class="card"
                    style="">
                    <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Nome:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->nomeNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>CPF:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->cpfNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Parentesco:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->parentescoNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Renda mensal:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->rendaNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Fonte pagadora:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->fontePagadoraNucleoFamiliar }}</h4>
                            </div>
                        </div>
                    </div><!-- end card-body-->
                </div><!-- end card-->
                <div class="card"
                    style="">
                    <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Nome:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->nomeNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>CPF:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->cpfNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Parentesco:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->parentescoNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Renda mensal:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->rendaNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Fonte pagadora:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->fontePagadoraNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            @elseif($isencao->tipo == "ensinoMedio")
                <div class="card">
                    <div class="card-header">{{ __('Arquivos anexados pelo candidato') }}</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <h3 for="historicoEscolar"
                                style="">{{ __('Histórico Escolar') }}</h3>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <h5>
                                <a style=""
                                    href="{{ route('download', ['file' => $isencao->historicoEscolar]) }}"
                                    target="_new">Abrir arquivo</a>
                            </h5>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card-->

            @else
                <div class="card"
                    style="">
                    <div class="card-header">{{ __('Dados econômicos') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Nome:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->nomeDadoEconomico }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>CPF:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->cpfDadoEconomico }} </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Parentesco:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->parentescoDadoEconomico }} </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Renda mensal:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->rendaDadoEconomico }} </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Fonte pagadora:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->fontePagadoraDadoEconomico }}</h4>
                            </div>
                        </div>


                    </div><!-- end card-body -->
                </div><!-- end card -->
                <div class="card">
                    <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Nome:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->nomeNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>CPF:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->cpfNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Parentesco:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->parentescoNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Renda mensal:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->rendaNucleoFamiliar }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Fonte pagadora:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->fontePagadoraNucleoFamiliar }}</h4>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card-->
                <div class="card">
                    <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Nome:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->nomeNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>CPF:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->cpfNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Parentesco:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->parentescoNucleoFamiliar1 }} </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Renda mensal:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->rendaNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <h5>Fonte pagadora:</h5>
                            </div>
                            <div class="col-sm-10">
                                <h4 style="font-weight:bold">{{ $isencao->fontePagadoraNucleoFamiliar1 }}</h4>
                            </div>
                        </div>
                    </div><!-- end card-body-->
                </div>
                <!--end card-->
                <!-- card Documentos -->
                <div id="margin"
                    class="card">
                    <div class="card-header">{{ __('Documentos') }}</div>
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <table class="table table-ordered table-hover">
                                <tr>
                                    <th>Requisito</th>
                                    <th>Dados</th>
                                </tr>
                                <tr <?php if ($isencao->nis == '') {
    echo 'style="display: none"';
} ?>>
                                    <div class="form-group row">
                                        <td>
                                            <label for="nis">{{ __('NIS') }}</label>
                                        </td>
                                        <div class="col-md-6">
                                            <td>
                                                <a href="{{ route('download', ['file' => $isencao->nis]) }}"
                                                    target="_blank">Abrir arquivo</a>
                                            </td>

                                        </div>
                                    </div>
                                </tr>
                            </table>
                        </div>

                    </div><!-- end card-body -->
                </div><!-- end card Documentos -->
            @endif

        </div><!-- end row card-->
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">{{ __('Parecer') }}</div>
                    <div class="card-body">
                        <div class="row justify-content-center"
                            style="margin-top:20px">
                            <div class="col-sm-1">
                                <input
                                    @if($isencao->parecer == 'deferida')
                                        checked
                                    @endif
                                    disabled
                                    type="radio">
                            </div>
                            <div id="label"
                                class="col-sm-2"
                                style="margin-left:-5%">
                                <h4>Deferida</h4>
                            </div>
                            <div class="col-sm-1">
                                <input id="radioIndeferida"
                                    disabled
                                    @if($isencao->parecer == 'indeferida')
                                        checked
                                    @endif
                                    type="radio">
                            </div>
                            <div id="label"
                                class="col-sm-2"
                                style="margin-left:-5%">
                                <h4>Indeferida</h4>
                            </div>
                        </div>
                        @if ($isencao->parecer == 'indeferida')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"
                                    id="motivoRejeicao">
                                    <div class="row justify-content-left">
                                        <div class="col-sm-6">
                                            <label for="motivoRejeicao"
                                                class="col-form-label text-md-right">{{ __('Justificativa:') }}</label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-12">
                                            <textarea class=" form-control @error('motivoRejeicao') is-invalid @enderror"
                                                form="formHomologacao"
                                                name="motivoRejeicao"
                                                disabled
                                                id="taid"
                                                style="width:100%">{{$isencao->motivoRejeicao}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div><!-- end card-body -->
                </div><!-- end card-->
            </div><!-- end row-->
    </div><!-- end container-->
@endsection
