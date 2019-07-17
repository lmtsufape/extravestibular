@extends('layouts.app')
@section('titulo','Editais')
@section('navbar')
    Inscrição
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editais') }}</div>
                  <div class="form-group row">
                      <?php
                      foreach ($editais as $edital) {
                        ?>
                        <form method="POST" action={{ route('editalEscolhido') }} enctype="multipart/form-data">
                              @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{$edital}}
                                <input type="hidden" name="editalId" value="{{$edital->id}}">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar Inscrição neste Edital') }}
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
