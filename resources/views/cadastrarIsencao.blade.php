@extends('layouts.app')
@section('titulo','Requerimento de Isenção')
@section('navbar')
    <!-- Home / Detalhes do edital / Requerimento de Isenção -->
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
      <a class="nav-link">Requerimento de Isenção</a>
    </li>
@endsection
@section('content')
<style>

</style>

<!-- container -->
<div class="container">
  <!-- row titulo dados de usuário -->
  <div class="row " style="margin-bottom: 20px;">
    <!-- título Dados de Usuário-->
    <div class="titulo-tabela-lmts">
        <h3>
          Declaração do Candidato nos Termos da Lei (Obrigatório)
        </h3>
    </div><!-- end título Dados de Usuário-->
  </div><!-- end row titulo dados de usuário-->

  <!-- form -->
  <form id="formCadastro" method="POST" action="{{ route('cadastroIsencao') }}" enctype="multipart/form-data">
    @csrf
    <!-- row parágrafo -->
    <div class="row">
      <div class="col-sm-12">
        <p><strong>O(a) candidato(a) declara, sob as penas da lei e da perda dos direitos decorrentes da sua inscrição,
        serem verdadeiras as informações, os dados e os documentos apresentados, prontificando-se a fornecer outros
        documentos comprobatórios, sempre que solicitados pela Universidade Federal do Agreste de Pernambuco. Nos termos da lei,
        o candidato se enquadra na situação:</strong></p>
      </div>
    </div><!-- end row parágrafo -->

    <!-- checkboxRenda -->
    <div class="row justify-content-center">
      <div class="col-sm-10">
        <input <?php if(old('checkboxRenda')){echo('checked');} ?> id="checkboxRenda" onclick="escolher('renda')" name="checkboxRenda"  value="rendaFamiliar" type="checkbox" > Renda familiar per capita igual ou inferior a um salário mínimo e meio. <br>
      </div>
    </div><!-- end checkboxRenda -->
    <!-- checkboxEnsino -->
    <div class="row justify-content-center">
      <div class="col-sm-10">
        <input <?php if(old('checkboxEnsino')){echo('checked');}?> id="checkboxEnsino" onclick="escolher('ensino')" name="checkboxEnsino" value="ensinoMedio" type="checkbox" > Ter cursado o ensino médio completo em escola da rede pública ou como bolsista integral em escola da rede privada. <br>
      </div>
    </div><!-- end checkboxEnsino -->

    <!-- card Histórico escolar -->
    <div class="row justify-content-center" style="">
      <div id="historicoEscolar" class="card" style="width: 100%;margin-top: 10px; display:none;">
          <div class="card-header" style="width: 100%">
            {{ __('Histórico Escolar (Obrigatório)') }}
          </div>

          <div class="card-body" style="width: 100%;">
            <div class="form-group row">      <!-- Arquivo Histórico Escolar -->

              <div class="alert alert-warning alert-dismissible fade show col-sm-12" role="alert">
                <strong>Atenção!</strong> Os documentos precisam ser legíveis.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <label for="Histórico Escolar" class="col-sm-12">{{ __('Histórico escolar*') }}</label>
              <div class="custom-file col-sm-12">
                <input id="input" type="file" class="filestyle rounded-pill" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="historicoEscolar">
                @error('historicoEscolar')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
      </div>
    </div><!-- end card Histórico escolar -->

    <!-- card dados economicos Obrigatórios -->
    <div class="row">
      <div id="dadosEconomicos" class="card" style="width: 100%; margin-top: 10px; display: none"><!--display: none -->
          <div class="card-header">
            {{ __('Dados Econômicos (Obrigatório)') }}
          </div>

          <div class="card-body">
              <div class="row justify-content-center">  <!-- row Nome | CPF-->
                <!-- nome -->
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-sm-12">
                      <label for="nomeDadoEconomico" class="field a-field a-field_a2 page__field" style="width:100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Nome*</span>
                        </span>
                      </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <input value="{{ old('nomeDadoEconomico') }}" id="nomeDadoEconomico" type="text" name="nomeDadoEconomico" autofocus class="field__input a-field__input form-control @error('nomeDadoEconomico') is-invalid @enderror" placeholder="Nome" style="width:100%">
                        @error('nomeDadoEconomico')
                        <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                  </div>


                </div><!-- end nome -->

                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-12">
                      <label for="cpfDadoEconomico" class="field a-field a-field_a2 page__field" style="width:100%">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">CPF*</span>
                      </span>

                    </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <input maxlength="11" value="{{ old('cpfDadoEconomico') }}" id="cpfDadoEconomico" type="text" name="cpfDadoEconomico" autofocus class="field__input a-field__input form-control @error('cpfDadoEconomico') is-invalid @enderror" placeholder="CPF" style="width: 100%;">
                      @error('cpfDadoEconomico')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>


                </div>

              </div> <!-- end row Nome | CPF-->

              <!-- row Parentesco/Renda/Fonte -->
              <div class="row justify-content-center">
                <!-- parentesco -->
                <div class="col-sm-4">
                  <div class="row justify-content-center">
                    <div class="col-sm-12">
                      <label for="parentescoDadoEconomico" class="field a-field a-field_a2 page__field" style=" width:100%">
                        <span class="a-field__label-wrap">
                          <span class="a-field__label">Parentesco*</span>
                        </span>
                      </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <input value="{{ old('parentescoDadoEconomico') }}" id="parentescoDadoEconomico" type="text" name="parentescoDadoEconomico" autofocus class="field__input a-field__input form-control @error('parentescoDadoEconomico') is-invalid @enderror" placeholder="Parentesco" style=" width:100%">
                      @error('parentescoDadoEconomico')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                </div><!-- end parentesco -->
                <!-- renda -->
                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-12">
                      <label for="rendaDadoEconomico" class="field a-field a-field_a2 page__field" style="width:100%">
                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Renda*</span>
                      </span>

                    </label>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <input value="{{ old('rendaDadoEconomico') }}" id="rendaDadoEconomico" type="text" name="rendaDadoEconomico" autofocus class="field__input a-field__input form-control @error('rendaDadoEconomico') is-invalid @enderror" placeholder="Renda" style="width:100%">
                      @error('rendaDadoEconomico')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>


                </div><!-- end renda -->
                <!-- fonte pagadora -->
                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-12">
                    <label for="fontePagadoraDadoEconomico" class="field a-field a-field_a2 page__field" style="width:100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Fonte Pagadora*</span>
                    </span>

                  </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                    <input value="{{ old('fontePagadoraDadoEconomico') }}" id="fontePagadoraDadoEconomico" type="text" name="fontePagadoraDadoEconomico" autofocus class="field__input a-field__input form-control @error('fontePagadoraDadoEconomico') is-invalid @enderror" placeholder="Fonte Pagadora" style="width:100%">
                    @error('fontePagadoraDadoEconomico')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>
                  </div>
                </div><!-- end fonte pagadora -->
                <div class="row">
                  <div class="alert alert-warning alert-dismissible fade show col-sm-12" role="alert">
                    <strong>Atenção!</strong> Os documentos precisam ser legíveis.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="col-sm-12">
                    <label for="comprovante" style="font-weight: bold">Selecione o documento com o número do NIS:</label>
                  </div>

                  <div class="col-sm-12">
                    <div class="custom-file" style="width: 100%;">
                      <input disabled type="hidden" value="aux" id="comprovante">
                      <input id='elementoComprovante' type="file" class="filestyle" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn-primary-lmts" name="nis" value="{{ old('nis') }}">
                      <label style="">(aceito arquivo .pdf de até 2 mb).</label>
                      @error('nis')
                      <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>


              </div><!-- end row Parentesco/Renda/Fonte -->
          </div>
      </div>
    </div><!-- end card dados economicos Obrigatórios -->

    <!-- card dados economicos do núcleo familiar -->
    <div class="row">
      <!-- card -->
      <div id="nucleo" class="card" style="width: 100%;margin-top: 10px; display: none"><!--display: none -->
        <!-- card-header -->
          <div class="card-header">
            {{ __('Dados Econômicos do Núcleo Familiar (Opcional)') }}
          </div><!-- end card-header -->
          <!-- card-body -->
          <div class="card-body">
            <div class="row justify-content-center">  <!-- row Nome | CPF-->
              <!-- nome -->
              <div class="col-sm-8">

                <div class="row">
                  <div class="col-sm-12">
                    <label for="nomeNucleoFamiliar" class="field a-field a-field_a2 page__field" style="width:100%">

                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Nome</span>
                      </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('nomeNucleoFamiliar') }}" id="nomeNucleoFamiliar" type="text" name="nomeNucleoFamiliar" autofocus class="field__input a-field__input form-control @error('nomeNucleoFamiliar') is-invalid @enderror" placeholder="Nome" style="width:100%">
                    @error('nomeNucleoFamiliar')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div><!--end nome -->

              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="cpfNucleoFamiliar" class="field a-field a-field_a2 page__field" style="width:100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">CPF</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input maxlength="11" value="{{ old('cpfNucleoFamiliar') }}" id="cpfNucleoFamiliar" type="text" name="cpfNucleoFamiliar" autofocus class="field__input a-field__input form-control @error('cpfNucleoFamiliar') is-invalid @enderror" placeholder="CPF" style="width:100%">
                    @error('cpfNucleoFamiliar')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div>

            </div><!-- end row Nome | CPF-->

            <!-- row Parentesco/Renda/Fonte -->
            <div class="row" style="">
              <!-- parentesco -->
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="parentescoNucleoFamiliar" class="field a-field a-field_a2 page__field" style=" width: 100%;">

                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Parentesco</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('parentescoNucleoFamiliar') }}" id="parentescoNucleoFamiliar" type="text" name="parentescoNucleoFamiliar" autofocus class="field__input a-field__input form-control @error('parentescoNucleoFamiliar') is-invalid @enderror" placeholder="Parentesco" style="width:100%">
                    @error('parentescoNucleoFamiliar')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>


              </div><!-- end parentesco -->

              <!-- renda -->
              <div class="col-sm-4">

                <div class="row">
                  <div class="col-sm-12">
                    <label for="rendaNucleoFamiliar" class="field a-field a-field_a2 page__field" style=" width: 100%;">

                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Renda</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('rendaNucleoFamiliar') }}" id="rendaNucleoFamiliar" type="text" name="rendaNucleoFamiliar" autofocus class="field__input a-field__input form-control @error('rendaNucleoFamiliar') is-invalid @enderror" placeholder="Renda" style="width:100%">
                    @error('rendaNucleoFamiliar')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div><!-- end renda -->

              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="fontePagadoraNucleoFamiliar" class="field a-field a-field_a2 page__field" style=" width: 100%;">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Fonte Pagadora</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('fontePagadoraNucleoFamiliar') }}" id="fontePagadoraNucleoFamiliar" type="text" name="fontePagadoraNucleoFamiliar" autofocus class="field__input a-field__input form-control @error('fontePagadoraNucleoFamiliar') is-invalid @enderror" placeholder="Fonte Pagadora" style="width:100%">
                    @error('fontePagadoraNucleoFamiliar')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div>
            </div><!-- end row Parentesco/Renda/Fonte -->
          </div><!-- end card-body -->
      </div><!-- end card -->
    </div><!-- end card dados economicos do núcleo familiar -->

    <!-- row -->
    <div class="row">
      <!-- card -->
      <div id="nucleo1" class="card" style="width: 100%;margin-top: 10px; display: none"><!--display: none -->
        <!-- card-header -->
          <div class="card-header">
            {{ __('Dados Econômicos do Núcleo Familiar (Opcional)') }}
          </div><!-- end card-header -->
          <!-- card-body -->
          <div class="card-body">
            <!-- row Nome | CPF-->
            <div class="row justify-content-center">
              <!-- nome -->
              <div class="col-sm-8">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="nomeNucleoFamiliar1" class="field a-field a-field_a2 page__field" style="width:100%">

                      <span class="a-field__label-wrap">
                        <span class="a-field__label">Nome</span>
                      </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('nomeNucleoFamiliar1') }}" id="nomeNucleoFamiliar1" type="text" name="nomeNucleoFamiliar1" autofocus class="field__input a-field__input form-control @error('nomeNucleoFamiliar1') is-invalid @enderror" placeholder="Nome" style="width:100%">
                    @error('nomeNucleoFamiliar1')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>


              </div><!-- end nome -->
              <!-- cpf -->
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="cpfNucleoFamiliar1" class="field a-field a-field_a2 page__field" style="width:100%">

                    <span class="a-field__label-wrap">
                      <span class="a-field__label">CPF</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input maxlength="11" value="{{ old('cpfNucleoFamiliar1') }}" id="cpfNucleoFamiliar1" type="text" name="cpfNucleoFamiliar1" autofocus class="field__input a-field__input form-control @error('cpfNucleoFamiliar1') is-invalid @enderror" placeholder="CPF" style="width:100%">
                    @error('cpfNucleoFamiliar1')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div><!-- end cpf -->


            </div><!-- end row Nome | CPF-->

            <div class="row justify-content-center">  <!-- Parentesco/Renda/Fonte -->
              <!-- parentesco -->
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="parentescoNucleoFamiliar1" class="field a-field a-field_a2 page__field" style="width:100%;">

                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Parentesco</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('parentescoNucleoFamiliar1') }}" id="parentescoNucleoFamiliar1" type="text" name="parentescoNucleoFamiliar1" autofocus class="field__input a-field__input form-control @error('parentescoNucleoFamiliar1') is-invalid @enderror" placeholder="Parentesco" style="width: 100%;">
                    @error('parentescoNucleoFamiliar1')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div><!-- end parentesco -->
              <!-- renda -->
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="rendaNucleoFamiliar1" class="field a-field a-field_a2 page__field" style="width:100%">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Renda</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('rendaNucleoFamiliar1') }}" id="rendaNucleoFamiliar1" type="text" name="rendaNucleoFamiliar1" autofocus class="field__input a-field__input form-control @error('rendaNucleoFamiliar1') is-invalid @enderror" placeholder="Renda" style="width:100%">
                    @error('rendaNucleoFamiliar1')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div><!-- end renda -->
              <div class="col-sm-4">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="fontePagadoraNucleoFamiliar1" class="field a-field a-field_a2 page__field" style="width:100%;">
                    <span class="a-field__label-wrap">
                      <span class="a-field__label">Fonte Pagadora</span>
                    </span>
                  </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input value="{{ old('fontePagadoraNucleoFamiliar1') }}" id="fontePagadoraNucleoFamiliar1" type="text" name="fontePagadoraNucleoFamiliar1" autofocus class="field__input a-field__input form-control @error('fontePagadoraNucleoFamiliar1') is-invalid @enderror" placeholder="Fonte Pagadora" style="width:100%">
                    @error('fontePagadoraNucleoFamiliar1')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

              </div>
            </div><!-- end Parentesco/Renda/Fonte -->
          </div><!-- end card-body -->
      </div><!--end card -->
    </div><!-- end row -->

    <!-- botão finalizar -->
    <div class="row justify-content-center" style="margin-top: 20px">
        <div class="">
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input id="tipo" type="hidden" name="tipo" value="">
            <button id="finalizar" disabled onclick="event.preventDefault();confirmar();" class="btn btn-primary btn-primary-lmts">
                {{ __('Finalizar') }}
            </button>

        </div>
    </div><!-- end botão finalizar -->
  </form><!-- end form -->

</div><!-- end container -->


<script type="text/javascript" >

function confirmar(){
  if(confirm("Tem certeza que deseja finalizar?") == true) {
    document.getElementById("formCadastro").submit();
 }
}

function checkTrueRenda(){
  if (document.getElementById("checkboxRenda").checked == true ) {
    document.getElementById("finalizar").disabled = false;
    document.getElementById("tipo").value = "rendaFamiliar";
    document.getElementById("dadosEconomicos").style.display = "";
    document.getElementById("nucleo").style.display = "";
    document.getElementById("nucleo1").style.display = "";
  }
}

function checkTrueEnsino(){
  if(document.getElementById("checkboxEnsino").checked == true ){
    document.getElementById("tipo").value = "ensinoMedio";
    document.getElementById("finalizar").disabled = false;
    document.getElementById("historicoEscolar").style.display = "";
  }
}

function checkTrueAmbos(){
  if(document.getElementById("checkboxRenda").checked == true && document.getElementById("checkboxEnsino").checked == true){
    document.getElementById("finalizar").disabled = false;
    document.getElementById("tipo").value = "ambos";
    document.getElementById("dadosEconomicos").style.display = "";
    document.getElementById("nucleo").style.display = "";
    document.getElementById("nucleo1").style.display = "";
    document.getElementById("historicoEscolar").style.display = "";

  }
}

function escolher(x) {
	if (x == "renda") {
    if(document.getElementById("checkboxRenda").checked == true){
      document.getElementById("dadosEconomicos").style.display = "";
      document.getElementById("nucleo").style.display = "";
      document.getElementById("nucleo1").style.display = "";
    }
    else{
      document.getElementById("dadosEconomicos").style.display = "none";
      document.getElementById("nucleo").style.display = "none";
      document.getElementById("nucleo1").style.display = "none";
    }

	}
	if (x == "ensino") {
    if(document.getElementById("checkboxEnsino").checked == true){
      document.getElementById("historicoEscolar").style.display = "";
    }
    else{
      document.getElementById("historicoEscolar").style.display = "none";

    }
	}
  if(document.getElementById("checkboxRenda").checked == true && document.getElementById("checkboxEnsino").checked == true){
    document.getElementById("finalizar").disabled = false;
    document.getElementById("tipo").value = "ambos";
  }
  else if (document.getElementById("checkboxRenda").checked == true ) {
    document.getElementById("finalizar").disabled = false;
    document.getElementById("tipo").value = "rendaFamiliar";
  }
  else{
    document.getElementById("tipo").value = "ensinoMedio";
    document.getElementById("finalizar").disabled = false;
  }

  if(document.getElementById("checkboxRenda").checked == false && document.getElementById("checkboxEnsino").checked == false){
    document.getElementById("finalizar").disabled = true;
  }

}

checkTrueRenda();
checkTrueEnsino();
checkTrueAmbos();

</script>

@endsection
