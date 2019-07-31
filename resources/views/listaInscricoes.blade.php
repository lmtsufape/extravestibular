@extends('layouts.app')
@section('titulo','Homologar Inscrição')
@section('navbar')
    Homologar Inscrição
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inscrições') }}</div>
                  <div class="form-group row">
                      <?php
                      foreach ($inscricoes as $inscricao) {
                        ?>
                        <form method="POST" action={{ route('inscricaoEscolhida') }} enctype="multipart/form-data">
                              @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{$inscricao->id}}
                                <input type="hidden" name="inscricaoId" value="{{$inscricao->id}}">
                                <input type="hidden" name="tipo" value="{{$tipo}}">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Selecionar esta inscrição') }}
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
