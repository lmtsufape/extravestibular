@extends('layouts.app')
@section('titulo','Homologar Recurso')
@section('navbar')
    Homologar Recurso
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recursos abertos') }}</div>
                <div class="card-body">
                  <table class="table table-ordered table-hover">
                    @foreach ($recursos as $recurso)
                    <tr>
                      <td> <!-- ID -->
                       <a >
                         {{$recurso->id}}
                       </a>
                      </td>

                      <td> <!-- Tipo -->
                       <a >
                         {{$recurso->tipo}}
                       </a>
                      </td>

                      <td> <!-- Isenção -->
                        <form method="POST" action={{ route('recursoEscolhido') }} enctype="multipart/form-data"> <!-- Isenção -->
                          @csrf
                          <div class="col-md-8 offset-md-4">
                            <input type="hidden" name="recursoId" value="{{$recurso->id}}">
                            <button type="submit" class="btn btn-primary btn-primary-lmts">
                                {{ __('Selecionar este recurso') }}
                            </button>

                          </div>
                        </form>
                      </td>
                    </tr>

                    @endforeach

                {{ $recursos->links() }}
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
