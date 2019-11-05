@extends('layouts.app')
@section('titulo','Homologar Recurso')
@section('navbar')
    <!-- Home / Detalhes do edital / Homologar Recurso -->
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
      <a class="nav-link">Homologar Recurso</a>
    </li>
@endsection
@section('content')
<div class="container" style="padding-bottom: 5%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- <div class="card" > -->
                <div class="titulo-tabela-lmts" style="width: 94%">
                  <h2>Recursos abertos</h2>
                </div>
                <div class="card-body">
                  <table class="table table-ordered table-hover">
                    <tr>
                      <th> Nome </th>
                      <th> CPF </th>
                      <th> </th>
                    </tr>
                    @foreach ($recursos as $recurso)
                      <tr>
                        <td> <!--  -->
                         <a >
                           {{$recurso->user->dadosUsuario->cpf}}
                         </a>
                        </td>
                        <td> <!--  -->
                         <a >
                           {{$recurso->user->dadosUsuario->cpf}}
                         </a>
                        </td>
                        <td> <!--  -->
                          <form method="POST" action="{{ route('recursoEscolhido') }}" enctype="multipart/form-data"> <!-- Isenção -->
                            @csrf
                            <div class="col-md-8 offset-md-4">
                              <input type="hidden" name="recursoId" value="{{$recurso->id}}">
                              <button type="submit" class="btn btn-primary btn-primary-lmts">
                                  {{ __('Selecionar') }}
                              </button>

                            </div>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </table>
                {{ $recursos->links() }}
              </div>
            <!-- </div> -->
        </div>
    </div>
</div>

@endsection
