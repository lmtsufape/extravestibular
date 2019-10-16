@extends('layouts.app')
@section('titulo','Homologar Recurso')
@section('navbar')
    <!-- Home / Detalhes do edital / Homologar Recurso / {{$recurso->cpfEdital}} -->
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
         {{ __('Homologar Recurso') }}
      </a>
      <form id="classificar" method="GET" action="{{route('editalEscolhido')}}">
          <input type="hidden" name="editalId" value="{{$editalId}}">
          <input type="hidden" name="tipo" value="homologarRecursos">
      </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link">{{$recurso->user->dadosUsuario->cpf}}</a>
    </li>
@endsection
@section('content')

<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action={{ route('homologarRecurso') }} enctype="multipart/form-data" id="formHomologacao">
        @csrf
        <div class="col-md-8">
            <div class="card" style="width: 70rem; margin-left: 0PX">
                <div class="card-header">{{ __('Homologar recurso') }}</div>
                <div class="card-body">
                  <div class="form-group row">
                        <div class="form-group row"  >
                            <div class="col-md-11 " style="margin-left: 10rem;">
                              A Preg,
                              <br>
                              <br>
                              <a style="font-weight: bold">
                                {{$recurso->user->dadosUsuario->nome}}, CPF {{$recurso->user->dadosUsuario->cpf}},
                              </a>
                              <br>
                              <br>
                              interpões contra o resultado:
                              <br>
                              <br>
                              <a style="font-weight: bold">
                                @if($recurso->tipo == 'taxa')
                                  da Isenção da Taxa de Inscrição de Processo Seletivo
                                @else
                                  da seleção para ingresso extra para UFRPE no curso {{$recurso->curso}}
                                @endif
                                .
                              </a>
                              <br>
                              <br>
                              Pelos seguinto motivos:
                              <br>
                              <br>
                              <a style="font-weight: bold">
                                {{$recurso->motivo}}
                              </a>
                            </div>
                        </div>

                  </div>
                  <div class="form-group row justify-content-center" style="font-weight: bold; margin-left: 25.5rem;">

                    <div class="col-md-11">
                        <input onclick="selectCheck('aprovado')" type="radio" name="radioRecurso" value="aprovado"> Aprovado
                        <br>
                        <input onclick="selectCheck('rejeitado')" type="radio" name="radioRecurso" value="rejeitado"> Rejeitado
                    </div>

                  </div>
                  <div class="form-group" id="motivoRejeicao" style=" display: none;">
                    <label for="motivoRejeicao" class="col-md-4 col-form-label text-md-right"  style="margin-left: -60px;">{{ __('Motivos da Rejeição:') }}</label>

                    <div class="col-md-6" style="margin-left: 10px">
                      <textarea form ="formHomologacao" name="motivoRejeicao" id="taid" cols="115" ></textarea>

                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group row mb-0" style="margin-left: 20rem; margin-top: 10px">
              <div class="col-md-8 offset-md-4">
                <input type="hidden" name="recursoId" value="{{$recurso->id}}">
                <button id="buttonFinalizar" type="submit" class="btn  btn-primary btn-primary-lmts" >
                  {{ __('Finalizar') }}
                </button>

              </div>
            </div>

      </form>
    </div>
</div>


<script type="text/javascript" >
function selectCheck(x){
  if(x == 'rejeitado'){
    document.getElementById("motivoRejeicao").style.display = ''
  }
}
</script>
@endsection
