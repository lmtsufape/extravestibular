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
    <link href="{{ asset('css/field-animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylelmts.css') }}" rel="stylesheet">

    <script type="text/javascript">

    </script>

    <style type="text/css">
        .panel-default > .panel-heading {
            color: #fff;
            background-color: #1B2E4F;
            border-color: #d3e0e9;
        }

        .nav-link {
          color: white;
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
      <div id="barra-logos" lass-"container" style="background:#FFFFFF; margin-top: 1px; height: 150px; padding: 10px 0 10px 0">
        <ul id="logos" style="list-style:none;">
            <li style="margin-right:140px; margin-left:110px; border-right:1px ;height: 120px">
                <a href="{{ route("home") }}"><img src="{{asset('images/logo.png')}}" style = "margin-left: 8px; margin-top:5px " height="120px" align = "left" ></a>

                <a target="_blank" href="http://lmts.uag.ufrpe.br/"><img src="{{asset('images/lmts.jpg')}}" style = "margin-left: 8px; margin-top:30px " height="70"  align = "right" ></a>

                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70" align = "right" >
                <a target="_blank" href="http://www.preg.ufrpe.br/"><img src="{{asset('images/logoPreg.png')}}" style = "margin-left: 10px; margin-top: 30px" height="70" width="150" align = "right" ></a>


                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70" align = "right" >
                <a target="_blank" href="http://ww3.uag.ufrpe.br/"><img src="{{asset('images/uag.png')}}" style = "margin-left: 10px; margin-top: 30px" height="70" width="50" align = "right" ></a>

                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70" align = "right" >
                <a target="_blank" href="http://www.ufrpe.br/"><img src="{{asset('images/ufrpe.png')}}" style = "margin-left: 15px; margin-right: -10px; margin-top: 30px " height="70" width="50" align = "right"></a>
            </li>
        </ul>
      </div>
      <!-- barra de menu -->

      <nav class="navbar navbar-expand-lg" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);" role="navigation">
        <a class="navbar-brand" href="{{ route('home') }}" style="color: white; font-weight: bold;">
          <img src="{{asset('images/logoBranco.png')}}" height="30" class="d-inline-block align-top" alt="">

        </a>
          <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-auto">
              @if(Auth::check())
                <!-- Visão Candidato -->
                @if(Auth::user()->tipo == 'candidato')

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('home') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('EDITAIS') }}
                      </a>
                      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

                      </form>
                  </li>

                  <li class="separador-lmts"> <!-- separador -->
                    |
                  </li>

                  <li class="nav-item active"> <!-- Ver Dados do Perfil -->
                      <a class="nav-link" href="{{ route('verDadosUsuario') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('cadastroDadosUsuario').submit();">
                         {{ __('DADOS DE USUÁRIO') }}
                      </a>
                      <form id="cadastroDadosUsuario" action="{{ route('verDadosUsuario') }}" method="GET" style="display: none;">

                      </form>
                  </li>

                @endif
                @if(Auth::user()->tipo == 'PREG')
                <!-- Visão PREG -->

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('home') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('EDITAIS') }}
                      </a>
                      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

                      </form>
                  </li>

                  <li class="separador-lmts"> <!-- separador -->
                    |
                  </li>

                  <li class="nav-item active"> <!-- Novo Edital -->
                    <a class="nav-link" href="{{ route('novoEdital') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('novoEdital-form').submit();">
                       {{ __('NOVO EDITAL') }}
                    </a>
                    <form id="novoEdital-form" action="{{ route('novoEdital') }}" method="GET" style="display: none;">

                    </form>
                  </li>

                  <li class="separador-lmts"> <!-- separador -->
                    |
                  </li>

                  <li class="nav-item active"> <!-- Gerar Classificação -->
                      <a class="nav-link" href="{{ route('listaEditais') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('listaEditais-form6').submit();">
                         {{ __('GERAR CLASSIFICAÇÃO') }}
                      </a>
                      <form id="listaEditais-form6" action="{{ route('listaEditais') }}" method="POST" style="display: none;">
                            @csrf
                          <input type="hidden" name="tipo" value="gerarClassificacao">
                      </form>
                  </li>

                @endif
                @if(Auth::user()->tipo == 'DRCA')
                <!-- Visão DRCA -->

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('home') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('Editais') }}
                      </a>
                      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

                      </form>
                  </li>


                @endif
                @if(Auth::user()->tipo == 'coordenador')
                <!-- Visão coordenador -->

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('home') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('Editais') }}
                      </a>
                      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

                      </form>
                  </li>

                  <!-- <li class="nav-item active">  Classificar Inscrições
                      <a class="nav-link" href="{{ route('listaEditais') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('listaEditais-form3').submit();">
                         {{ __('Classificar Inscrições') }}
                      </a>
                      <form id="listaEditais-form3" action="{{ route('listaEditais') }}" method="POST" style="display: none;">
                          @csrf
                          <input type="hidden" name="tipo" value="classificarInscricoes">
                      </form>
                  </li> -->

                @endif
              @endif
            </ul>

          </div>

          <div class="nav navbar-nav navbar-right" >
            <ul class="nav navbar-nav">
                @if(Auth::check())
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
                <!-- Visão Candidato -->
                @if(Auth::user()->tipo == 'candidato')
                  <li> <!--  logout   -->
                      <a class="nav-link"  href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                         {{ __('Sair') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>

                @endif
                <!-- Visão PREG -->
                @if(Auth::user()->tipo == 'PREG')
                  <li> <!--  logout   -->
                      <a class="nav-link"  href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                         {{ __('Sair') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>

                @endif
                <!-- Visão DRCA -->
                @if(Auth::user()->tipo == 'DRCA')
                  <li> <!--  logout   -->
                      <a class="nav-link"  href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                         {{ __('Sair') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>

                @endif
                <!-- Visão coordenador -->
                @if(Auth::user()->tipo == 'coordenador')
                  <li> <!--  logout   -->
                      <a class="nav-link"  href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                         {{ __('Sair') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>

                @endif
              @endif
            </ul>
          </div>
        </nav>


      @php($url = str_replace(URL::to('/'),'',URL::current()))


      @if(!($url == '/login'))
        @if(!($url == '/register'))
          <a class="badge badge-primary badge-lmts" style="color:white"> @yield('navbar') </a>
        @endif
      @endif

      <br>
      @yield('content')

    </div>
  </div>




  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/bootstrap-filestyle.min.js')}}"> </script>

</body>

<!--- <div id="footer-brasil"></div>-->

<script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

</html>
