@extends('layouts.app')
@section('titulo', 'Listar analistas cadastrados no edital')
@section('navbar')
    <li class="nav-item active">
        <a class="nav-link"
            style="color: black"
            href="{{ route('home') }}"
            onclick="event.preventDefault();document.getElementById('VerEditais').submit();">
            {{ __('Home') }}
        </a>
        <form id="VerEditais"
            action="{{ route('home') }}"
            method="GET"
            style="display: none;">
        </form>
    </li>
    <li class="nav-item active">
        <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
        <a class="nav-link"
            href="detalhes"
            style="color: black"
            onclick="event.preventDefault(); document.getElementById('detalhesEdital').submit();">
            {{ __('Detalhes do Edital') }}
        </a>
        @if (Auth::check())
            <form id="detalhesEdital"
                action="{{ route('detalhesEdital') }}"
                method="GET"
                style="display: none;">
            @else
                <form id="detalhesEdital"
                    action="{{ route('detalhesEditalServidor') }}"
                    method="GET"
                    style="display: none;">
        @endif
        <input type="hidden"
            name="editalId"
            value="{{ $edital->id }}">

        </form>
    </li>
    <li class="nav-item active">
        <a class="nav-link">/</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link">Analistas do edital</a>
    </li>
@endsection
@section('content')

    <div class="container">
        <!-- row titulo -->
        <div class="row justify-content-center">
            <div class="titulo-tabela-lmts col-sm-12">
                <h3>
                    Analistas
                </h3>
                <button id="buttonModal"
                    type="button"
                    class="btn btn-primary btn-primary-lmts"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    style="margin-top:-40px; float:right">
                    Cadastrar analista
                </button>
            </div><!-- end Título analista -->
        </div>
        <!--end lista analista  -->

        <!-- tabela -->
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($edital->analistas as $analista)
                        <tr>
                            <td>
                                @if($analista->user->dadosUsuario)
                                    {{ $analista->user->dadosUsuario->nome}}
                                @endif
                            </td>
                            <td>{{ $analista->user->email }}</td>
                            <td>
                                <form action="{{route('analistas.destroy', $analista)}}"
                                    method="POST"
                                    id="apagarAnalista">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button"
                                    class="btn btn-link"
                                    onclick="event.preventDefault();confirmarApagar();">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                Nenhum analista cadastrado no edital
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Novo Analista -->
    <div class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form method="POST"
            action="{{ route('analistas.store', $edital) }}"
            id="formAnalista">
            @csrf
            <div class="modal-dialog modal-dialog-centered"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="exampleModalLabel">Nova Analista</h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="row justify-content-center"
                                style="">
                                <div class="col-sm-12">
                                    <input id="email"
                                        type="email"
                                        name="email"
                                        class="field__input a-field__input form-control @error('email') is-invalid @enderror"
                                        placeholder="Email"
                                        value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <span class="invalid-feedback"
                                            role="alert"
                                            style="overflow: visible; display:block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            style="border-radius: 50px;margin-top:40px;">
                            Fechar
                        </button>
                        <button type="submit"
                            id="finalizarModal"
                            class="btn btn-primary btn-primary-lmts"
                            style="margin-top: 8%">
                            {{ __('Enviar') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- End Modal -->
    @if (session()->has('jsAlert'))
        <script>
            alert('{{ session()->get('jsAlert') }}');
        </script>
    @endif
    <script type="text/javascript">
        function confirmarApagar() {
            if (confirm("Tem certeza que deseja excluir?") == true) {
                document.getElementById('apagarAnalista').submit();
            }
        }
    </script>
@endsection
