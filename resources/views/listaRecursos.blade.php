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
                  <div class="form-group row">
                      <?php
                      foreach ($recursos as $recurso) {
                        ?>
                        <form method="POST" action={{ route('recursoEscolhido') }} enctype="multipart/form-data">
                              @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{$recurso->id}}
                                <input type="hidden" name="recursoId" value="{{$recurso->id}}">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Selecionar este recurso') }}
                                </button>

                            </div>
                        </div>
                      </form>
                    <?php } ?>


                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
