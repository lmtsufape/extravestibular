@extends('layouts.app')
@section('titulo', 'Home')
@section('navbar')
    <li class="nav-item active">
        <a class="nav-link"
            style="color: black"
            href="{{ route('home') }}"
            onclick="event.preventDefault();
                         document.getElementById('VerEditais').submit();">
            {{ __('Home') }}
        </a>
        <form id="VerEditais"
            action="{{ route('home') }}"
            method="GET"
            style="display: none;">

        </form>
    </li>

@endsection
@section('content')

    <style type="text/css">
        @media screen and (max-width: 576px) {

            .table {
                font-size: 75%;
                height: 100%;
                width: 100%;
            }

        }

    </style>
    <?php
    // dd(session()->all());
    ?>
    <div class="container">

        <!-- div contem as tabelas -->
        <div id="tabelas"
            class="col-sm-12"
            style="width: 100%;margin: auto; background-color: #white">
            <div class="row">
                <!-- Título: EDITAIS ABERTOS -->
                <div class="titulo-tabela-lmts">
                    <h2>Editais Abertos</h2>
                </div>
                <table class="table table-ordered table-hover">
                    <?php $editaisAbertos = true;
                    $editaisAbertosFlag = true;
                    $editaisFinalizadosFlag = true; ?>
                    @foreach ($analistas as $analista)
                        <?php
                        $edital = $analista->edital;
                        if ($edital->resultadoFinal <= $mytime) {
                            $editaisAbertos = false;
                        } else {
                            $editaisAbertos = true;
                        }
                        ?>
                        @if ($editaisAbertos)
                            @if ($editaisAbertosFlag)
                                <tr style="background-color: #F7F7F7">
                                    <th style="width: 55%"> Nome</th><?php $editaisAbertosFlag = false; ?>
                                    <th style="width: 15%"> Publicação </th>
                                    <th style="width: 15%"> Arquivo </th>
                                    <th style="width: 15%"> Erratas </th>
                            @endif
                        @else
                            @if ($editaisFinalizadosFlag)
                </table>
                <div class="titulo-tabela-lmts">
                    <h2>Editais Finalizados</h2>
                </div>
                <table class="table table-ordered table-hover">
                    <tr style="background-color: #F7F7F7">
                        <th style="width: 55%"> Nome</th><?php $editaisFinalizadosFlag = false; ?>
                        <th style="width: 15%"> Publicação </th>
                        <th style="width: 15%"> Arquivo </th>
                        <th style="width: 15%"> Erratas </th>
                    </tr>
                    @endif
                    @endif
                    <tr>
                        <td>
                            <a href="{{route('analistas.edital', $edital)}}">
                                <?php
                                $nomeEdital = explode('.pdf', $edital->nome);
                                echo $nomeEdital[0];
                                ?>
                            </a>
                        </td>
                        <td>
                            <!-- data -->
                            <?php
                            $date = date_create($edital->dataPublicacao);
                            ?>
                            <a>{{ date_format($date, 'd/m/y') }}</a>
                        </td>
                        <td>
                            <!-- Download -->
                            <a href="{{ route('download', ['file' => $edital->pdfEdital]) }}"
                                target="_new">Baixar</a>
                        </td>
                        <td style="overflow: auto;">
                            <!-- Download Errata -->
                            <?php
                            $erratas = $edital->errata;
                            ?>
                            @if ($erratas->count() == 1)
                                @foreach ($erratas as $key)
                                    <a href="{{ route('download', ['file' => $key->arquivo]) }}"
                                        target="_new">{{ $key->nome }}</a>
                                @endforeach
                                .
                            @else
                                <?php $primeiraErrata = true; ?>
                                @foreach ($erratas as $key)
                                    @if ($primeiraErrata)
                                        <?php $primeiraErrata = false; ?>
                                        <a href="{{ route('download', ['file' => $key->arquivo]) }}"
                                            target="_new">{{ $key->nome }}</a>
                                    @else
                                        ;<a href="{{ route('download', ['file' => $key->arquivo]) }}"
                                            target="_new"> {{ $key->nome }}</a>
                                    @endif
                                @endforeach
                                .
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        <div class="col-md-8">
            {{-- {{ $editais->links() }} --}}
        </div>
    </div>


    @if (session()->has('jsAlert'))
        <script>
            alert('{{ session()->get('jsAlert') }}');
        </script>
    @endif
@endsection
