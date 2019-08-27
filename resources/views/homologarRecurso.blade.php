@extends('layouts.app')
@section('titulo','Homologar Recurso')
@section('navbar')
    Homologar Recurso
@endsection
@section('content')

<div class="container" style="width: 100rem;">
    <div class="row justify-content-center">
      <form method="POST" action={{ route('homologarRecurso') }} enctype="multipart/form-data">
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
                                {{$recurso->nome}}, CPF {{$recurso->cpf}},
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
                                processo Nº {{$recurso->processo}}.
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
                        <input type="radio" name="radioRecurso" value="aprovado"> Aprovado
                        <br>
                        <input type="radio" name="radioRecurso" value="rejeitado"> Rejeitado
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

</script>
@endsection
