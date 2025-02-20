@extends('layouts.app')
@section('titulo','Homologar Inscrição')
@section('navbar')
    <!-- Home / Detalhes do edital / Homologar Inscrição -->
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
      @if($tipo == 'classificacao')
        <a class="nav-link">Classificar Inscrições</a>
      @else
        <a class="nav-link">Homologar Inscrição</a>
      @endif
    </li>

@endsection
@section('content')
<style>
  h2{
    margin-left: -2%;
  }
</style>
<div class="container">
  <!-- row titulo -->
  <div class="row justify-content-center">
    <div class=" col-sm-9 titulo-tabela-lmts">
      <h2>Inscrições Pendentes</h2>
    </div>
  </div><!-- end row titulo -->

  <!-- tabela -->
  <div class="row justify-content-center">
    <table class="table table-ordered table-hover col-sm-9">
      <tr>
        <th> Nome </th>
        <th> CPF </th>
        <th> </th>
      </tr>
      @foreach ($inscricoes as $inscricao)
      <tr>
        <td>
         <a >
           {{$inscricao->user->dadosUsuario->nome}}
         </a>
        </td>
        <td>
         <a >
           {{$inscricao->user->dadosUsuario->cpf}}
         </a>
        </td>

        <td>
          <form method="get" action="{{ route('inscricaoEscolhida') }}" enctype="multipart/form-data"> <!-- Isenção -->

            <div class="col-md-8 offset-md-4">
                <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                <input type="hidden" name="tipo" value="{{$tipo}}">
                <button type="submit" class="btn btn-primary btn-primary-lmts">
                    {{ __('Selecionar') }}
                </button>

            </div>
          </form>
        </td>
      </tr>

      @endforeach
    </table>

</div><!-- end tabela -->
<div class="row justify-content-center">
    {{-- $inscricoes->appends(['editalId' => $editalId, 'tipo' => 'homologarInscricoes'])->links() --}}
</div>

  @if($tipo == 'homologacao')
    <!-- titulo -->
    <div class="row justify-content-center">
      <div class="col-sm-9 titulo-tabela-lmts">
        <h2>Inscrições Classificadas</h2>
      </div>
    </div><!-- end titulo -->

    <!-- tabela -->
    <div class="row justify-content-center">
    <table class="table table-ordered table-hover col-sm-9">
      <tr>
        <th> Nome </th>
        <th> CPF </th>
        <th> Parecer </th>
        <th> </th>
      </tr>
      @foreach ($homologadas as $inscricao)
      <tr>
        <td>
         <a >
           {{$inscricao->user->dadosUsuario->nome}}
         </a>
        </td>
        <td>
         <a >
           {{$inscricao->user->dadosUsuario->cpf}}
         </a>
        </td>
        <td>
         <a >
           <?php if($inscricao->homologado == 'aprovado') { echo('Aprovado'); } else{ echo('Rejeitado'); } ?>
         </a>
        </td>

        <td>
          <form method="get" action="{{ route('inscricaoEscolhida') }}" enctype="multipart/form-data"> <!-- Isenção -->

            <div class="col-md-8 offset-md-4">
                <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                <input type="hidden" name="tipo" value="homologacao">
                <button type="submit" class="btn btn-primary btn-primary-lmts">
                    {{ __('Editar') }}
                </button>

            </div>
          </form>
        </td>
      </tr>

      @endforeach
    </table>

    </div><!-- end tabela -->
    <div class="row justify-content-center">
        {{-- $homologadas->appends(['editalId' => $editalId, 'tipo' => 'homologarInscricoes'])->links() --}}
    </div>
  @endif

  @if($tipo == 'classificacao')
    <!-- titulo -->
    <div class="row justify-content-center">
      <div class="col-sm-9 titulo-tabela-lmts">
        <h2>Inscrições Classificadas</h2>
      </div>
    </div><!-- end titulo -->

    <!-- tabela -->
    <div class="row justify-content-center">
    <table class="table table-ordered table-hover col-sm-9">
      <tr>
        <th> Nome </th>
        <th> CPF </th>
        <th> Nota </th>
        <th> Posição </th>
        <th> Situação </th>
        <th> </th>
      </tr>
      @foreach ($inscricoesClassificadas as $inscricao)
      <tr>
        <td>
         <a >
           {{$inscricao->user->dadosUsuario->nome}}
         </a>
        </td>
        <td>
         <a >
           {{$inscricao->user->dadosUsuario->cpf}}
         </a>
        </td>
        <td>
         <a >
           {{$inscricao->nota}}
         </a>
        </td>
        <td>
         <a >
           {{$inscricao->classificacao}}
         </a>
        </td>
        <td>
         <a >
           {{$inscricao->situacao}}
         </a>
        </td>

        <td>
          <form method="get" action="{{ route('inscricaoEscolhida') }}" enctype="multipart/form-data"> <!-- Isenção -->

            <div class="col-md-8 offset-md-4">
                <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                <input type="hidden" name="tipo" value="editarClassificacao">
                <button type="submit" class="btn btn-primary btn-primary-lmts">
                    {{ __('Editar') }}
                </button>

            </div>
          </form>
        </td>
      </tr>

      @endforeach
    </table>

    {{ $inscricoes->links() }}
    </div><!-- end tabela -->
  @endif
</div><!-- end container-->

@endsection
