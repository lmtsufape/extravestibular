@extends('layouts.app')
@section('titulo','Homologar Isenção')
@section('navbar')
    <!-- Home/  Detalhes do edital / Homologar Isenção -->
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
      <a class="nav-link">Homologar Isenção</a>
    </li>
@endsection
@section('content')

<!-- container -->
<div class="container">
  <!-- row -->
    <div class="row justify-content-center">
      <!-- col titulo tabela lmts -->
      <div class="col-sm-12">
        <div class="titulo-tabela-lmts">
          <h2>Pedidos de isenção abertos.</h2>
        </div>
      </div><!-- end col titulo tabela lmts -->
    </div><!-- end row -->

    <!-- row -->
    <div class="row justify-content-center">
      <!-- col tabela -->
      <div class="col-sm-12">
        <table class="table table-ordered table-hover">
          <tr>
            <th> Nome </th>
            <th> CPF </th>
            <th> </th>
          </tr>
          @forelse ($isencoes as $isencao)
          <tr>
            <td> <!-- ID -->
             <a >
               {{$isencao->user->dadosUsuario->nome}}
             </a>
            </td>
            <td> <!-- ID -->
             <a >
               {{$isencao->user->dadosUsuario->cpf}}
             </a>
            </td>


            <td> <!-- Isenção -->
              <form method="GET" action="{{ route('isencaoEscolhida') }}" enctype="multipart/form-data"> <!-- Isenção -->
                <div class="col-md-8 offset-md-4">
                  <input type="hidden" name="isencaoId" value="{{$isencao->id}}">
                  <input type="hidden" name="editalId" value="{{$editalId}}">
                  <button type="submit" class="btn btn-primary btn-primary-lmts">
                      {{ __('Selecionar') }}
                  </button>

                </div>
              </form>
            </td>
          </tr>
          @empty
          <tr>
              <td colspan="3">
                  Nenhum pedido de isenção em aberto
              </td>
          </tr>
          @endforelse

          {{-- $isencoes->links() --}}
        </table>
      </div><!-- end col tabela -->
    </div><!-- end row -->

    <div class="row justify-content-center">
        <!-- col titulo tabela lmts -->
        <div class="col-sm-12">
          <div class="titulo-tabela-lmts">
            <h2>Pedidos de isenção avaliados.</h2>
          </div>
        </div><!-- end col titulo tabela lmts -->
      </div><!-- end row -->
      <!-- row -->
      <div class="row justify-content-center">
        <!-- col tabela -->
        <div class="col-sm-12">
          <table class="table table-ordered table-hover">
            <tr>
              <th> Nome </th>
              <th> CPF </th>
              <th> </th>
            </tr>
            @foreach ($isencoesHomologadas as $isencao)
            <tr>
              <td> <!-- ID -->
               <a >
                 {{$isencao->user->dadosUsuario->nome}}
               </a>
              </td>
              <td> <!-- ID -->
               <a >
                 {{$isencao->user->dadosUsuario->cpf}}
               </a>
              </td>
              <td> <!-- Isenção -->
                <form method="GET" action="{{ route('visualizarIsencao') }}"> <!-- Isenção -->
                  <div class="col-md-8 offset-md-4">
                    <input type="hidden" name="isencaoId" value="{{$isencao->id}}">
                    <input type="hidden" name="editalId" value="{{$editalId}}">
                    <button type="submit" class="btn btn-primary btn-primary-lmts">
                        {{ __('Visualizar') }}
                    </button>

                  </div>
                </form>
              </td>
            </tr>
            @endforeach
            {{-- $isencoes->links() --}}
          </table>
        </div><!-- end col tabela -->
      </div><!-- end row -->


</div><!-- end container -->
@endsection
