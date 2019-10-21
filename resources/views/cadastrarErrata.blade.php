@extends('layouts.app')
@section('titulo','Cadastrar Errata')
@section('navbar')
    <!-- Home / Detalhes do edital / Requerimento de Recurso -->
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
      <a class="nav-link">Cadastrar Errata</a>
    </li>
@endsection
@section('content')

<div class="container" style="width: 100%;margin-left: 10%;">
    <div class="row justify-content-center">
        <div class="col-md-8 justify-content-center">
          <form method="POST" action="{{ route('cadastroErrata') }}" enctype="multipart/form-data" id="formRecurso">
            @csrf
            <div class="card" style="width: 150%;">
                <div class="card-header">{{ __('Cadastrar Errata') }}</div>
                <div class="card-body">
                      <div class="card-body">
                          <input type="hidden" name="editalId" value="{{$editalId}}" />

                          <div class="form-group row justify-content-left">  <!-- Nome -->
                            <label for="nome" class="field a-field a-field_a2 page__field">
                                <input id="nome" type="text" name="nome" autofocus class="field__input a-field__input" placeholder="Nome" style="width: 470%;">
                                <span class="a-field__label-wrap">
                                  <span class="a-field__label">Nome</span>
                                </span>
                            </label>
                          </div>

                          <div class="form-group row justify-content-left">
                              <label for="motivo" class=""  style="">{{ __('Descrição:') }}</label>

                              <div class="" style="">
                                <textarea form ="formRecurso" name="descricao" id="taid" cols="111" ></textarea>

                              </div>
                          </div>


                      </div>
                </div>
            </div>
            <div style="width: 150%;">
              <div class="form-group row justify-content-center" style="padding: 10px">
                <div class="">
                  <button type="submit" class="btn btn-primary btn-primary-lmts">
                    {{ __('Finalizar') }}
                  </button>

                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>

<script type="text/javascript" >



</script>


    @endsection
