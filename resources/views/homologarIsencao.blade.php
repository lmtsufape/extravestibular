@extends('layouts.app')
@section('titulo','Homologar Isenção')
@section('navbar')
    <!-- Home / Detalhes do edital / Homologar Isenção / {{$isencao->cpfCandidato}} -->
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
         {{ __('Homologar Isenção') }}
      </a>
      <form id="classificar" method="GET" action="{{route('editalEscolhido')}}">
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input type="hidden" name="tipo" value="homologarIsencao">
      </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">{{$isencao->user->dadosUsuario->cpf}}</a>
    </li>
@endsection
@section('content')

<style>
  .card{
    width: 100%;
  }

  @media screen and (max-width: 576px){
    #label{
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

          @if($isencao->tipo == "ambos")
            <div class="row justify-content-center">
              <div class="col-sm-12">
                I - o candidato declara-se impossibilitado de arcar com o pagamento da taxa de inscrição e comprovar renda familiar mensal igual inferior a um salário mínimo e meio.
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-sm-12">
                II – ter cursado o ensino médio completo em escola da rede pública ou como bolsista integral em escola da rede privada.
              </div>
            </div>
          @elseif($isencao->tipo == "renda")
            <div class="row justify-content-center">
              <div class="col-sm-12">
                I - o candidato declara-se impossibilitado de arcar com o pagamento da taxa de inscrição e comprovar renda familiar mensal igual inferior a um salário mínimo e meio.
              </div>
            </div>
          @else
            <div class="row justify-content-center">
              <div class="col-sm-12">
                II – ter cursado o ensino médio completo em escola da rede pública ou como bolsista integral em escola da rede privada.
              </div>
            </div>
          @endif
        </div>
      </div><!-- end card-body -->
    </div><!-- end card -->
  </div><!-- end row card-->


  <div class="row justify-content-center">
      @if($isencao->tipo == "ambos")
        <div class="card" style="">
          <div class="card-header">{{ __('Arquivos anexados pelo candidato') }}</div>
          <div class="card-body">
            <div class="row justify-content-center" >
                <h3 for="historicoEscolar" style="">{{ __('Histórico Escolar') }}</h3>
            </div>
            <br>
            <div class="row justify-content-center">
              <h5>
                <a style="" href="{{ route('download', ['file' => $isencao->historicoEscolar])}}" target="_new">Abrir arquivo</a>
              </h5>
            </div>
          </div><!-- end card body-->
        </div>
        <div class="card" style="">
            <div class="card-header">{{ __('Dados econômicos') }}</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-2"><h5>Nome:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->nomeDadoEconomico}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>CPF:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->cpfDadoEconomico}} </h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Parentesco:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->parentescoDadoEconomico}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Renda Mensal:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->rendaDadoEconomico}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Fonte pagadora:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->fontePagadoraDadoEconomico}}</h4></div>
              </div>
            </div><!-- end card-body -->
        </div><!-- end card-->
        <div class="card" style="">
            <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-2"><h5>Nome:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->nomeNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>CPF:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->cpfNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Parentesco:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->parentescoNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Renda mensal:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->rendaNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Fonte pagadora:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->fontePagadoraNucleoFamiliar}}</h4></div>
              </div>
            </div><!-- end card-body-->
        </div><!-- end card-->
        <div class="card" style="">
            <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-2"><h5>Nome:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->nomeNucleoFamiliar1}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>CPF:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->cpfNucleoFamiliar1}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Parentesco:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->parentescoNucleoFamiliar1}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Renda mensal:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->rendaNucleoFamiliar1}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Fonte pagadora:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->fontePagadoraNucleoFamiliar1}}</h4></div>
              </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
      @elseif($isencao->tipo == "ensinoMedio")
        <div class="card">
            <div class="card-header">{{ __('Arquivos anexados pelo candidato') }}</div>
            <div class="card-body">
              <div class="row justify-content-center" >
                  <h3 for="historicoEscolar" style="">{{ __('Histórico Escolar') }}</h3>
              </div>
              <br>
              <div class="row justify-content-center">
                <h5>
                  <a style="" href="{{ route('download', ['file' => $isencao->historicoEscolar])}}" target="_new">Abrir arquivo</a>
                </h5>
              </div>
            </div><!-- end card-body -->
        </div><!-- end card-->

      @else
        <div class="card" style="">
            <div class="card-header">{{ __('Dados econômicos') }}</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-2"><h5>Nome:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->nomeDadoEconomico}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>CPF:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->cpfDadoEconomico}} </h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Parentesco:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->parentescoDadoEconomico}} </h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Renda mensal:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->rendaDadoEconomico}} </h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Fonte pagadora:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->fontePagadoraDadoEconomico}}</h4></div>
              </div>


            </div><!-- end card-body -->
        </div><!-- end card -->
        <div class="card">
            <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-2"><h5>Nome:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->nomeNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>CPF:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->cpfNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Parentesco:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->parentescoNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Renda mensal:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->rendaNucleoFamiliar}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Fonte pagadora:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->fontePagadoraNucleoFamiliar}}</h4></div>
              </div>
            </div><!-- end card-body -->
        </div><!-- end card-->


        <div class="card">
            <div class="card-header">{{ __('Dados econômicos do núcleo familiar') }}</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-2"><h5>Nome:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->nomeNucleoFamiliar1}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>CPF:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->cpfNucleoFamiliar1}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Parentesco:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->parentescoNucleoFamiliar1}} </h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Renda mensal:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->rendaNucleoFamiliar1}}</h4></div>
              </div>
              <div class="row">
                <div class="col-sm-2"><h5>Fonte pagadora:</h5></div>
                <div class="col-sm-10"><h4 style="font-weight:bold">{{$isencao->fontePagadoraNucleoFamiliar1}}</h4></div>
              </div>
            </div><!-- end card-body-->
        </div><!--end card-->
        @endif

      </div><!-- end row card-->


      <form method="POST" action="{{ route('homologarIsencao') }}" enctype="multipart/form-data" id="formHomologacao">
        @csrf

        <div class="row justify-content-center">

            <div class="card">
              <div class="card-header">{{ __('Parecer') }}</div>
              <div class="card-body">
                <div class="row justify-content-center" style="margin-top:20px">
                  <div class="col-sm-1">
                    <input onclick="selectCheck('aprovado')" type="radio" name="resultado" value="deferida">
                  </div>
                  <div id="label" class="col-sm-2" style="margin-left:-5%"><h4>Deferida</h4></div>
                  <div class="col-sm-1">
                    <input id="radioIndeferida" @error('motivoRejeicao') checked @enderror onclick="selectCheck('rejeitado')" type="radio" name="resultado" value="indeferida">
                  </div>
                  <div id="label" class="col-sm-2" style="margin-left:-5%"><h4>Indeferida</h4></div>

                </div>



                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group" id="motivoRejeicao" style=" display: none; ">
                      <div class="row justify-content-left">
                        <div class="col-sm-6">
                          <label for="motivoRejeicao" class="col-form-label text-md-right" >{{ __('Justificativa:') }}</label>

                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <textarea class=" form-control @error('motivoRejeicao') is-invalid @enderror" form ="formHomologacao" name="motivoRejeicao" id="taid" style="width:100%" ></textarea>
                            @error('motivoRejeicao')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                </div>



            </div><!-- end card-body -->
          </div><!-- end card-->

      </div><!-- end row-->
      <div class="row justify-content-center" style="margin-top:20px;">
          <input type="hidden" name="isencaoId" value="{{$isencao->id}}">
          <button id="buttonFinalizar" onclick="event.preventDefault();confirmar();" class="btn btn-primary btn-primary-lmts" >
            {{ __('Finalizar') }}
          </button>
      </div>
  </form>

</div><!-- end container-->



<script type="text/javascript" >

function confirmar(){
      if(confirm("Tem certeza que deseja finalizar?") == true) {
        document.getElementById("formHomologacao").submit();
     }
    }

function selectCheck(x){
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = ''
  }
  if(x == 'aprovado'){
    document.getElementById("motivoRejeicao").style.display = 'none'
  }
}

function checkIndeferido(){
  if(document.getElementById("radioIndeferida").checked == true){
    document.getElementById("motivoRejeicao").style.display = ''

  }
}

checkIndeferido();

</script>
@endsection
