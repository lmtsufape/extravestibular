<!DOCTYPE html>
<!-- Versão 19.0528-1625 -->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>@yield('titulo') | Extra Vestibular</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">

    <script type="text/javascript">

    </script>

    <style type="text/css">
        .panel-default > .panel-heading {
            color: #fff;
            background-color: #1B2E4F;
            border-color: #d3e0e9;
        }
        /* Select2 Selects CSS - Start */
        .select2-container--bootstrap .select2-selection--single .select2-selection__placeholder  {
            color: #555;
        }
        .select2-container--bootstrap .select2-results__option {
            color: #555;
            background-color: #fff;
        }
        .select2-container--bootstrap .select2-results__option--highlighted[aria-selected] {
            color: #fff;
            background-color: #bbb;
        }
        .select2-container--bootstrap .select2-selection--single {
            height: 36px;
            padding: 6px 18px;
            margin-left: 0px;
        }
        /* Select2 Selects CSS - End */
        #termo {
          width: 100%;
          font-size: 16px;
          padding: 12px 20px 12px 40px;
          border: 1px solid #ddd;
          margin-bottom: 12px;
        }
        .navbar-default .navbar-nav > .dropdown > a:focus, .navbar-default .navbar-nav > .dropdown > a:hover {
            color: #fff;
            background-color: #1B2E4F;
        }
        .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
            color: #000;
            background-color: #fff;
        }
        .navbar-default .navbar-nav > a, .navbar-default .navbar-nav > li > a {
            color: #fff;
        }
        .navbar-default .navbar-nav > li > a:hover, {
            color: #fff;
            background-color: #fff;
        }
        .dropdown-menu > li > a:hover {
            background-color: #cccccc;
        }
        .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-text {
            color: #000;
            background-color: #fff;
        }
        #footer-brasil {
           background: none repeat scroll 0% 0% #1B2E4F;
           min-width: 100%;
           position: absolute;
           bottom: 0;
           width: 100%;
        }
        #page-container {
          position: relative;
          min-height: 100vh;
        }
        #content-wrap {
          padding-bottom: 2.5rem;    /* Footer height */
        }
        @media (max-width: 1024px) {
          #barra-logos{display: none;}
          .btn-toggle{display: block;}
        }
        @media only screen and (max-width: 1024px) {
        	/* Force table to not be like tables anymore */
        	#tabela table,
        	#tabela thead,
        	#tabela tbody,
          #tabela tfoot,
        	#tabela th,
        	#tabela td,
        	#tabela tr {
        		display: block;
        	}
        	/* Hide table headers (but not display: none;, for accessibility) */
        	#tabela thead tr {
        		position: absolute;
        		top: -9999px;
        		left: -9999px;
        	}
        	#tabela tr { border: 1px solid #ccc; }
        	#tabela td {
        		/* Behave  like a "row" */
        		border: none;
        		border-bottom: 1px solid #eee;
        		position: relative;
        		padding-left: 50%;
        		white-space: normal;
        		text-align:left;
        	}
        	#tabela td:before {
        		/* Now like a table header */
        		position: absolute;
        		/* Top/left values mimic padding */
        		top: 6px;
        		left: 6px;
        		width: 45%;
        		padding-right: 10px;
        		white-space: nowrap;
        		text-align:left;
        		font-weight: bold;
        	}
        	/*
        	Label the data
        	*/
        	#tabela td:before { content: attr(data-title); }
        }
        .dropbtn {
          background-color: #3097D1;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }
        .dropbtndisabled {
          background-color: #8eb4cb;;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }
        /* The container <div> - needed to position the dropdown content */
        .dropdown {
          position: relative;
          display: inline-block;
        }
        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #8eb4cb;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        /* Links inside the dropdown */
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}
        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
          display: block;
        }
        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
          background-color: #3097D1;
        }
    </style>

</head>
<body>

  <div id="page-container">
   <div id="content-wrap">
      <div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
        <ul id="menu-barra-temp" style="list-style:none;">
            <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
                <a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
            </li>
            <li>
            <a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
            </li>
        </ul>
      </div>

      <!-- Barra de Logos -->
      <div id="barra-logos" class-"container" style="background:#FFFFFF; margin-top: 1px; height: 200px; padding: 10px 0 10px 0">
        <ul id="logos" style="list-style:none;">
            <li style="margin-right:140px; margin-left:110px; border-right:1px">
                <a href="{{ route("home") }}"><img src="{{asset('images/extraVestibular.png')}}" style = "margin-left: 8px; margin-top:5px " height="170px" align = "left" ></a>

                <a target="_blank" href="http://lmts.uag.ufrpe.br/"><img src="{{asset('images/lmts3.png')}}" style = "margin-left: 8px; margin-top:65px " height="80" align = "right" ></a>

                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 65px" height="70" align = "right" >
                <a target="_blank" href="http://ww3.uag.ufrpe.br/"><img src="{{asset('images/uag.png')}}" style = "margin-left: 10px; margin-top: 65px" height="80" width="70" align = "right" ></a>

                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 65px" height="70" align = "right" >
                <a target="_blank" href="http://www.ufrpe.br/"><img src="{{asset('images/ufrpe.png')}}" style = "margin-left: 15px; margin-right: -10px; margin-top: 65px " height="80" width="70" align = "right"></a>
            </li>
        </ul>
      </div>

      <!-- barra de menu -->
      <nav class="navbar navbar-default" style="background-color: #1B2E4F; border-color: #d3e0e9" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" >
            <ul class="nav navbar-nav">
                @if(Auth::check())
                    <?php /*<li><a class="menu-principal" href="{{ route("home") }}">Início</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('fazerInscricao') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('fazerInscricao-form').submit();">
                            {{ __('Fazer Inscrição') }}
                        </a>

                        <form id="fazerInscricao-form" action="{{ route('fazerInscricao') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    */?>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

                <li>
                    <a href="{{ route('listaEditais') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('listaEditais-form').submit();">
                        {{ __('Fazer Inscrição') }}
                    </a>

                    <form id="listaEditais-form" action="{{ route('listaEditais') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

                <li>
                    <a href="{{ route('novoEdital') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('novoEdital-form').submit();">
                        {{ __('Novo edital') }}
                    </a>

                    <form id="novoEdital-form" action="{{ route('novoEdital') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

                <?php /*<!--<li class="dropdown">
                  <a href="{{ route("grupoConsumo.listar") }}" class="menu-principal dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Grupos de Consumo <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                      <li>
                          <a href="{{ route("grupoConsumo.listar") }}">Meus Grupos de Consumo</a>
                      </li>
                      <li>
                          <a href="{{ route("consumidor.grupo.buscar") }}">Entrar em Grupo de Consumo</a>
                      </li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="{{ route("loja") }}" class="menu-principal dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Loja <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                      <li>
                          <a href="{{ route("loja") }}">Comprar</a>
                      </li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="menu-principal dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>
                  <ul style="" class="dropdown-menu" role="menu">
                    <li><a href="{{ route("consumidor.meusPedidos") }}">Meus Pedidos</a></li>
                    <li><a href="{{ route("consumidor.editarCadastro") }}">Meus Dados</a></li>
                    <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Sair
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>*/ ?>
              @else
                <li><a class="menu-principal" href="{{ route('login') }}">Entrar</a></li>
                <li><a class="menu-principal" href="{{ route('register') }}">Cadastrar</a></li>
              @endif
            </ul>
          </div>
        </nav>

      @php($url = str_replace(URL::to('/'),'',URL::current()))

      @if(!($url == '/home'))
        @if(!($url == '/login'))
          @if(!($url == '/register'))

            <div style="margin-top: -30px" class="container">
              <hr>
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <div class="collapse navbar-collapse" >
                              <ul class="nav navbar-nav">
                                  @yield('navbar')
                              </ul>
                          </div>
                      </div>
                  </div>
              <hr>
            </div>

          @endif
        @endif
      @endif

      @yield('content')

    </div>

    <div id="footer-brasil"></div>
    <!-- <footer id="footer-brasil"></footer> -->

  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

</body>


<script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>
</html>
