@extends('layouts.app')
@section('titulo','Homologar Inscrição')
@section('navbar')
    Home/Detalhes do edital/Homologar Inscrição
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inscrições') }}</div>
                <div class="card-body">
                  <table class="table table-ordered table-hover">
                    @foreach ($inscricoes as $inscricao)
                    <tr>
                      <td> <!-- ID -->
                       <a >
                         {{$inscricao->cpfCandidato}}
                       </a>
                      </td>

                      <td> <!-- Isenção -->
                        <form method="get" action={{ route('inscricaoEscolhida') }} enctype="multipart/form-data"> <!-- Isenção -->
                          @csrf
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

                {{ $inscricoes->links() }}
              </div>
        </div>
    </div>
</div>
@endsection
