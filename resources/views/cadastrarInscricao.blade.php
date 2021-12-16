@extends('layouts.app')
@section('titulo','Inscrição')
@section('navbar')
    <!-- Home / Detalhes do Edital / Fazer Inscrição -->
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
      <a class="nav-link">Fazer Inscrição</a>
    </li>
@endsection
@section('content')

<style type="text/css">

@media screen and (max-width:576px) {
  div#divCidade{
    margin-top: 5%;
  }

  div#divUf{
    margin-top: 5%;
  }
}
</style>

<div class="container">
  <form id="formCadastro" autocomplete="off" method="POST" action="{{ route('cadastroInscricao') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="editalId" value="{{$editalId}}" />
    <input id="tipo" type="hidden" name="tipo" value=""/>
    <div class="row" style="margin-top:5%">
        <div class="card " style="width: 30%; margin-left: 70%;">
            <div class="card-header"><span style="color: red; font-weight: bold;">*</span> Campo obrigatório</div>
        </div>
      <div class="card " style="width: 100%;">
          <div class="card-header">{{ __('Comprovante') }}</div>
          <div class="card-body">

            @if($comprovante == 'deferida')
              <div class="row justify-content-center" >
                <label for="comprovante" class="">{{ __('Comprovante:') }}</label>

                <div class="justify-content-center">
                  <strong>Isento de pagamento</strong>
                  <input id="comprovante" type="hidden" name="comprovante" value="isento">
                </div>
              </div>
            @else
              <div class="row justify-content-center">
                <div class="alert alert-warning alert-dismissible fade show col-sm-12" role="alert">
                  <strong>Atenção!</strong> Os documentos precisam ser legíveis.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="col-sm-10">
                  <label for="comprovante" style="font-weight: bold"><span style="color: red; font-weight: bold;">* </span>Selecione o comprovante gerado pelo pagamento da taxa do tipo de inscrição:</label>
                </div>

              </div>
              <div class="row justify-content-center">
                <div class="col-sm-10">
                  <div class="custom-file" style="width: 100%;">
                    <input disabled type="hidden" value="aux" id="comprovante">
                    <input id='elementoComprovante'  onclick="comprovanteSelecionado({{$editalId}})"  type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="comprovante" value="{{ old('comprovante') }}">
                    <label style="">Anexar comprovante de pagamento (Aceito arquivo .pdf de até 64 mb).</label>
                    @error('comprovante')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
            @endif
          </div>
      </div>
    </div>
    <div  id="formulario" style="display: <?php if($comprovante != 'deferida') { echo('none'); }?> ;">
      <div class="row" style="margin-top: 5%">
        <div class="card" style="width: 100%;">
            <div class="card-header">{{ __('Inscrição') }}</div>
            <div class="card-body">

                <div class="row">
                  <label for="tipoInscricao" class="col-sm-4 col-form-label text-sm-right" ><span style="color: red; font-weight: bold;">* </span>Tipo de Inscrição:</label>
                  <div class="col-sm-8">
                    <input <?php if(old('tipo') == 'reintegracao')        {echo('checked');} ?> onclick="escolherTipo('reintegracao')" 			   type="radio" name="tipoInscricao" > Reintegração <br>
                    <input <?php if(old('tipo') == 'transferenciaExterna'){echo('checked');} ?> onclick="escolherTipo('transferenciaExterna')"  type="radio" name="tipoInscricao" > Transferencia Externa <br>
                    <input <?php if(old('tipo') == 'portadorDeDiploma')   {echo('checked');} ?> onclick="escolherTipo('portadorDeDiploma')" 		 type="radio" name="tipoInscricao" > Portador de Diploma <br>
                  </div>
                </div>


                <input disabled type="hidden" id="antigaOpcao" value="{{old('tipo')}}">
                <div id="alerta-documentos" class="alert alert-warning alert-dismissible fade show col-sm-12" role="alert" style="display: none">
                  <strong>Atenção!</strong> Os documentos precisam ser legíveis.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div id="rg" class="form-group row" style="display: none">      <!-- Arquivo rg -->
                    <label for="rg" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('RG:') }}</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input required type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="rg">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('rg')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="cpf" class="form-group row" style="display: none">      <!-- Arquivo cpf -->
                    <label for="cpf" class="col-sm-4 col-form-label text-md-right">{{ __('CPF:') }}</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="cpf">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('cpf')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="quitacaoEleitoral" class="form-group row" style="display: none">      <!-- Arquivo quitacaoEleitoral -->
                    <label for="quitacaoEleitoral" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Certidão de quitação eleitoral:') }}</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input required type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="quitacaoEleitoral">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('quitacaoEleitoral')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="reservista" class="form-group row" style="display: none">      <!-- Arquivo reservista -->
                    <label for="reservista" class="col-sm-4 col-form-label text-md-right">{{ __('Reservista para o sexo masculino (só para candidatos de 18 a 45 anos):') }}</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="reservista">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('reservista')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="certidaoNascimento" class="form-group row" style="display: none">      <!-- Arquivo certidaoNascimento -->
                    <label for="certidaoNascimento" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Certidão de nascimento ou registro de casamento:') }}</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input required type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="certidaoNascimento">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('certidaoNascimento')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="historicoEnsinoMedio" class="form-group row" style="display: none" >      <!-- Arquivo historicoEnsinoMedio -->
                    <label for="historicoEnsinoMedio" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Histórico e Certificado de conclusão do ensino médio com carimbo e assinatura da instituição legíveis:') }}</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="historicoEnsinoMedio">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('historicoEnsinoMedio')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="declaracaoENADE" class="form-group row" style="display: none" >      <!-- Arquivo declaracaoENADE -->
                    <label for="declaracaoENADE" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Declaração de regularidade com o Exame Nacional de Desempenho dos Estudantes (ENADE). A declaração não será necessária se a informação de regularidade com o ENADE estiver no histórico escolar:') }}</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="declaracaoENADE">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('declaracaoENADE')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="historicoEscolar" class="form-group row" style="display: none" >      <!-- Arquivo historico escolar -->
                    <label for="Historico escolar" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold; display: inline">* </span><p style="display: inline" id="pHistoricoGraduacao">{{ __('Histórico escolar do curso de graduação:') }}</p></label>


                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="historicoEscolar">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('historicoEscolar')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="declaracaoDeVinculo" class="form-group row" style="display: none">    <!-- Arquivo declaração de vinculo -->
                    <label for="Declaracao de Viculo" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Declaração de vínculo:') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="declaracaoDeVinculo">
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('declaracaoDeVinculo')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="programaDasDisciplinas" class="form-group row" style="display: none"> <!-- Arquivo programa das disciplinas -->
                    <label for="Programa das Disciplinas" class="col-sm-4 col-form-label text-md-right">{{ __('Programa das disciplinas: ') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="programaDasDisciplinas" >
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('programaDasDisciplinas')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="curriculo" class="form-group row" style="display: none">              <!-- Arquivo curriculo -->
                    <label for="Curriculo" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Documento acadêmico que contenha o Currículo do curso original, caso o histórico escolar não demonstre:') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="curriculo" >
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('curriculo')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                    </div>

                <div id="enem" class="form-group row" style="display: none">                   <!-- Arquivo enenm -->
                    <label for="ENEM" class="col-sm-4 col-form-label text-md-right">{{ __('Documento com a Nota do Exame Nacional do Ensino Médio a partir da edição de 2010:') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="enem" >
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('enem')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="diploma" class="form-group row" style="display: none">                   <!-- Arquivo diploma -->
                    <label for="Diploma" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Diploma:') }}</label>

                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="diploma" >
                        <label style="">Aceito arquivo .pdf de até 64 mb</label>
                      </div>
                      @error('diploma')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>

                <div id="declaracaoDeVeracidade" class="form-group row">      <!-- Arquivo declaracaoDeVeracidade -->
                  <label for="declaracaoDeVeracidade" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Declaração de veracidade:') }}</label>
                  <div class="col-sm-7">
                    <div class="row">
                      <div class="col-sm-1">
                        <input type="checkbox" id="declaracaoDeVeracidade" name="declaracaoDeVeracidade" required>
                      </div>
                      <div class="col-sm-11" style="position: relative; left: -25px;">
                        <label for="declaracaoDeVeracidade">Declaro que as informações acima prestadas são verdadeiras, e assumo a inteira responsabilidade pelas mesmas.</label>
                      </div>
                    </div>
                    @error('declaracaoDeVeracidade')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">                                                   <!-- Curso -->
                    <label for="Curso" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Curso pretendido:') }}</label>

                    <div class="col-sm-8" id="selectCurso">

                      <select class="form-control col-sm-10" name="curso" style="width: 100%" id="idSelecionarCurso" onChange="selecionarCurso({{$editalId}})">
                        <?php
                        foreach ($cursosDisponiveis as $curso) {
                          if($curso[0] != '#'){
                            if($curso[0] != ''){
                              if($curso[2] == old('curso')) {
                                echo('<option selected value=' . $curso[2] . '>' . $curso[0] . '</option>');
                              } else {
                                echo('<option value=' . $curso[2] . '>' . $curso[0] . '</option>');
                              }
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                </div>

                <div class="form-group row">                                                   <!-- Turno -->
                    <label for="Turno" class="col-sm-4 col-form-label text-md-right"><span style="color: red; font-weight: bold;">* </span>{{ __('Turno:') }}</label>

                    <div class="col-sm-8">
                      <select class="form-control col-sm-10" name="turno" id="id_turnos">
                      </select>
                    </div>
                </div>

                {{--<div class="form-group row justify-content-center">
                  <div class="col-sm-10">                                                   <!-- Polo -->
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="polo" class="field a-field a-field_a2 page__field" style="width: 100%">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label">Polo (apenas aluno EAD):</span>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 autocomplete">
                          <input id="polo" type="text" name="polo" autofocus class="form-control @error('polo') is-invalid @enderror field__input a-field__input" placeholder="Polo (apenas aluno EAD):" style="width: 100%;" value="{{ old('polo') }}" style="width:100%">

                      </div>
                    </div>

                    @error('polo')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>--}}

            </div>
        </div>
      </div>
      <div class="row" style="margin-top:5%">
        <div class="card" style=" width: 100%">
            <div class="card-header">{{ __('Dados da Instituições de Ensino Superior de Origem') }}</div>
            <div class="card-body">
              <div class="card-body">
                <div class="form-group row">                                                   <!-- Curso de origem -->


                  <label for="cursoDeOrigem" class="field a-field a-field_a2 page__field" style="width: 100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>Nome Completo do Curso de Origem:</span>
                    </span>
                  </label>
                    <input id="cursoDeOrigem" type="text" name="cursoDeOrigem" class="form-control @error('cursoDeOrigem') is-invalid @enderror field__input a-field__input" placeholder="EX: Bacharelado em Ciências da Computação" style="width: 100%;" value="{{ old('cursoDeOrigem') }}">
                  @error('cursoDeOrigem')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group row">                                                   <!-- Instituição de origem -->
                  <label for="instituicaoDeOrigem" class="field a-field a-field_a2 page__field" style="width: 100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>Nome Completo da Instituição de Origem:</span>
                    </span>
                  </label>
                    <input id="instituicaoDeOrigem" type="text" name="instituicaoDeOrigem" autofocus class="form-control @error('instituicaoDeOrigem') is-invalid @enderror field__input a-field__input" placeholder="EX: Universidade Federal Rural de Pernambuco" style="width: 100%;" value="{{ old('instituicaoDeOrigem') }}">
                  @error('instituicaoDeOrigem')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group row">                                                   <!-- Natureza da IES -->
                  <label for="naturezaDaIes" class="field a-field a-field_a2 page__field" style="width: 100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>Natureza da Instituição de Ensino Superior:</span>
                    </span>
                  </label>
                    <select class="form-control col-sm-10" name="naturezaDaIes">
                      <option <?php if(old('naturezaDaIes') == 'Pública'){ echo('selected'); } ?> value="Pública">Pública</option>
                      <option <?php if(old('naturezaDaIes') == 'Privada'){ echo('selected'); } ?> value="Privada">Privada</option>
                    </select>
                  @error('naturezaDaIes')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group row">
                  <div class="" style="">
                    <label for="endereco" class="field a-field a-field_a3 page__field" style="width: 100%;">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>CEP</span>
                      </span>
                    </label>
                      <input onblur="pesquisacep(this.value);" id="cep" type="text" name="cep" autofocus class="form-control field__input a-field__input" placeholder="CEP" maxlength="9" >
                  </div>
                </div>
                <div class="form-group row">  <!-- Endereço/Nº -->

                  <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-12">
                      <label for="endereco" class="field a-field a-field_a2 page__field" style="width: 100%">
                          <span class="a-field__label-wrap">
                            <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>Rua</span>
                          </span>
                      </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <input id="rua" type="text" name="endereco" autofocus class="form-control @error('endereco') is-invalid @enderror field__input a-field__input" placeholder="Rua" style="width: 100%;" value="{{ old('endereco') }}">
                    </div>
                  </div>

                    @error('endereco')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-2">


                    <label for="num" class="field a-field a-field_a2 page__field" style="">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>Número</span>
                        </span>
                    </label>
                        <input id="num" type="text" name="num" autofocus class="form-control @error('num') is-invalid @enderror field__input a-field__input" placeholder="Número" style="width: 100%;" value="{{ old('num') }}">
                    @error('num')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">  <!-- Bairro/Cidade/Uf -->
                  <div class="col-sm-5" id="divBairro">
                    <label for="bairro" class="field a-field a-field_a2 page__field" style="width: 100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>Bairro</span>
                        </span>
                    </label>
                        <input id="bairro" type="text" name="bairro" autofocus class="form-control @error('bairro') is-invalid @enderror field__input a-field__input" placeholder="Bairro" style="width: 100%" value="{{ old('bairro') }}">
                    @error('bairro')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-5" id="divCidade">
                    <label for="cidade" class="field a-field a-field_a2 page__field" style="width: 100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>Cidade</span>
                        </span>
                    </label>
                        <input id="cidade" type="text" name="cidade" autofocus class="form-control @error('cidade') is-invalid @enderror field__input a-field__input" placeholder="Cidade" style="width: 100%" value="{{ old('cidade') }}">
                    @error('cidade')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-2" id="divUf">
                    <label for="uf" class="field a-field a-field_a2 page__field" style="width: 100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label"><span style="color: red; font-weight: bold;">* </span>UF</span>
                        </span>
                    </label>
                        <input id="uf" type="text" name="uf" autofocus class="form-control @error('uf') is-invalid @enderror field__input a-field__input" placeholder="UF" style="width: 100%" value="{{ old('uf') }}">
                    @error('uf')
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
    </div>
      <div class="row justify-content-center">
          <div class="">
            <button id="button" onclick="event.preventDefault();confirmar();" class="btn btn-primary btn-primary-lmts" style="margin-top:20px;">
              {{ __('Finalizar') }}
            </button>
          </div>
      </div>


    </div>
  </form>
</div>

<script type="text/javascript" >

    function selecionarCurso(editalId){
        var historySelectList = $('select#idSelecionarCurso');
        var $curso = $('option:selected', historySelectList).val();
        limparTurnos();

        $.ajax({
            url:'ajax-listar-turnos',
            type:"get",
            data: {"curso": $curso, "edital" : editalId},
            dataType:'json',

            complete: function(data) {
                if(data.responseJSON.success){
                    for(var i = 0; i < data.responseJSON.valorTurnos.length; i++){
                        if("{{old('turno')}}" == data.responseJSON.valorTurnos[i]) {
                            var html = `<option selected value="`+data.responseJSON.valorTurnos[i]+`">`+data.responseJSON.nomesTurnos[i]+`</option>`;
                        } else {
                            var html = `<option value="`+data.responseJSON.valorTurnos[i]+`">`+data.responseJSON.nomesTurnos[i]+`</option>`;
                        }
                        $('#id_turnos').append(html);
                    }
                }
            }
        });
    }

    function limparTurnos() {
        var turnos = document.getElementById('id_turnos');
        turnos.innerHTML = "";
    }

  function mostrarComuns() {
    document.getElementById("rg").style.display = "";
    document.getElementById("cpf").style.display = "";
    document.getElementById("quitacaoEleitoral").style.display = "";
    document.getElementById("reservista").style.display = "";
    document.getElementById("certidaoNascimento").style.display = "";
    document.getElementById("alerta-documentos").style.display = "";
  }

  function escolherTipo(x) {
    if (x == "reintegracao") {
      mostrarComuns();
      document.getElementById("tipo").value = "reintegracao";

      document.getElementById("historicoEscolar").style.display = "";
      document.getElementById("declaracaoENADE").style.display = "none";
      document.getElementById('pHistoricoGraduacao').innerHTML = 'Histórico Escolar do curso de graduação (UFAPE  ou  antiga  UAG/UFRPE) atualizado:';
      document.getElementById("curriculo").style.display = "none";
      document.getElementById("declaracaoDeVinculo").style.display = "none";
      document.getElementById("programaDasDisciplinas").style.display = "none";
      document.getElementById("historicoEnsinoMedio").style.display = "none";
      document.getElementById("enem").style.display = "none";
      document.getElementById("diploma").style.display = "none";

      if(document.getElementById("comprovante").value == 'isento'){
        document.getElementById("formulario").style.display = "";
      }

    }
    // if (x == "transferenciaInterna") {
    //   document.getElementById("tipo").value = "transferenciaInterna";
    //   document.getElementById("historicoEscolar").style.display = "";
    //   document.getElementById("declaracaoDeVinculo").style.display = "";
    //   document.getElementById("enem").style.display = "none";
    //   document.getElementById("curriculo").style.display = "none";
    //   document.getElementById("programaDasDisciplinas").style.display = "none";
    //   document.getElementById("diploma").style.display = "none";


    //   if(document.getElementById("comprovante").value == 'isento'){
    //     document.getElementById("formulario").style.display = "";
    //   }
    // }
    if (x == "transferenciaExterna") {
      mostrarComuns();
      document.getElementById("tipo").value = "transferenciaExterna";

      document.getElementById("declaracaoENADE").style.display = "";
      document.getElementById("historicoEscolar").style.display = "";
      document.getElementById('pHistoricoGraduacao').innerHTML = 'Histórico Escolar do curso de graduação atualizado, com indicativo da média global, formalmente oficializado pela IFES de origem:';
      document.getElementById("curriculo").style.display = "";
      document.getElementById("declaracaoDeVinculo").style.display = "";
      document.getElementById("programaDasDisciplinas").style.display = "";
      document.getElementById("historicoEnsinoMedio").style.display = "";
      document.getElementById("enem").style.display = "none";
      document.getElementById("diploma").style.display = "none";


      if(document.getElementById("comprovante").value == 'isento'){
        document.getElementById("formulario").style.display = "";
      }
    }
    if (x == "portadorDeDiploma") {
      mostrarComuns();
      document.getElementById("tipo").value = "portadorDeDiploma";

      document.getElementById("diploma").style.display = "";
      document.getElementById("historicoEscolar").style.display = "";
      document.getElementById('pHistoricoGraduacao').innerHTML = 'Histórico Escolar do curso de graduação, com indicativo da média global:';
      document.getElementById("programaDasDisciplinas").style.display = "";
      document.getElementById("declaracaoENADE").style.display = "none";
      document.getElementById("curriculo").style.display = "none";
      document.getElementById("declaracaoDeVinculo").style.display = "none";
      document.getElementById("enem").style.display = "none";
      document.getElementById("historicoEnsinoMedio").style.display = "none";

      if(document.getElementById("comprovante").value == 'isento'){
        document.getElementById("formulario").style.display = "";
      }
    }
  }

  var antigaOpcao = document.getElementById("antigaOpcao");
  if(antigaOpcao.value != null){
    escolherTipo(antigaOpcao.value);
  }

  function confirmar(){
    if(confirm("Tem certeza que deseja finalizar?") == true) {
      document.getElementById("formCadastro").submit();
   }
  }

  function comprovanteSelecionado(editalId){
    document.getElementById("formulario").style.display = "";
    this.selecionarCurso(editalId);
  }


  //cep
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

  var polos = ["Limoeiro","Carpina","Vitória da Conquista","Afrânio","Surubim","Gravatá","Ilhéus","Palmares","Pesqueira","Camaçari","Tabira","Trindade",]


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

  autocomplete(document.getElementById("polo"), polos);

</script>


    @endsection
