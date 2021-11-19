<!DOCTYPE html>
<!-- Versão 19.0528-1625 -->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Titulo -->
    <title>@yield('titulo') | Extra Vestibular</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/field-animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylelmts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app-style.css') }}" rel="stylesheet">

    <script type="text/javascript">

    </script>

    <style type="text/css">

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
            <li style="margin-right: 0%; margin-left: -2%; border-right:1px ;height: 120px">
              @if(Auth::check())
                <a href="{{ route("home") }}"><img src="{{asset('images/logo.png')}}" style = "margin-left: 15px ; margin-top:1.2% " height="70%" align = "left" ></a>
              @else
                <a href="{{ route("homeApi") }}"><img src="{{asset('images/logo.png')}}" style = "margin-left: 15px; margin-top:1.2% " height="70%" align = "left" ></a>
              @endif
            </li>
        </ul>
      </div>
@if(Auth::check())
      <!-- barra de menu -->

      <nav class="navbar navbar-expand-lg" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);" role="navigation">
        <a class="navbar-brand" href="{{ route('home') }}" style="color: white; font-weight: bold;">
          <img src="{{asset('images/home.png')}}" height="30" class="d-inline-block align-top" alt="">

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
                         {{ __('EDITAIS PUBLICADOS') }}
                      </a>
                      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

                      </form>
                  </li>

                  <li class="separador-lmts"> <!-- separador -->
                    |
                  </li>

                  @if(!is_null(Auth::user()->dados))
                    <li class="nav-item active"> <!-- Ver Dados do Perfil -->
                        <a class="nav-link" href="{{ route('editarDadosUsuario') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('cadastroDadosUsuario').submit();">
                           {{ __('EDITAR DADOS DE USUÁRIO') }}
                        </a>
                        <form id="cadastroDadosUsuario" action="{{ route('editarDadosUsuario') }}" method="GET" style="display: none;">

                        </form>
                    </li>
                  @endif
                @endif
                @if(Auth::user()->tipo == 'PREG')
                  <!-- Visão PREG -->

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('home') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('EDITAIS PUBLICADOS') }}
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
                @endif
                @if(Auth::user()->tipo == 'DRCA')
                  <!-- Visão DRCA -->

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('home') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('EDITAIS PUBLICADOS') }}
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
                         {{ __('EDITAIS PUBLICADOS') }}
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

        <nav class="navbar navbar-expand-lg" role="navigation" style="height: 30px;font-size: 12px; background-color: #EEEEEE"><!-- Navegação -->
          <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-auto">
              @yield('navbar')
            </ul>
          </div>
        </nav>

        @endif
      @endif

      <br>
@endif

@if(!is_null(session('tipo')))
      <!-- barra de menu -->

      <nav class="navbar navbar-expand-lg" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);" role="navigation">
        <a class="navbar-brand" href="{{ route('homeApi') }}" style="color: white; font-weight: bold;">
          <img src="{{asset('images/home.png')}}" height="30" class="d-inline-block align-top" alt="">

        </a>
          <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-auto">

              <!-- Visão PREG -->
                @if(session('tipo') == 'PREG')

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('homeApi') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('EDITAIS PUBLICADOS') }}
                      </a>
                      <form id="VerEditais" action="{{ route('homeApi') }}" method="GET" style="display: none;">

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

                @endif
                @if(session('tipo') == 'DRCA')
                  <!-- Visão DRCA -->

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('homeApi') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('EDITAIS PUBLICADOS') }}
                      </a>
                      <form id="VerEditais" action="{{ route('homeApi') }}" method="GET" style="display: none;">

                      </form>
                  </li>

                @endif
                @if(session('tipo') == 'coordenador')
                  <!-- Visão coordenador -->

                  <li class="nav-item active"> <!-- Ver Editais -->
                      <a class="nav-link" href="{{ route('homeApi') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('VerEditais').submit();">
                         {{ __('EDITAIS PUBLICADOS') }}
                      </a>
                      <form id="VerEditais" action="{{ route('homeApi') }}" method="GET" style="display: none;">

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

            </ul>

          </div>

          <div class="nav navbar-nav navbar-right" >
            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">


                <!-- Visão PREG -->
                @if(session('tipo') == 'PREG')
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
                @if(session('tipo') == 'DRCA')
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
                @if(session('tipo') == 'coordenador')
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

            </ul>
          </div>
        </nav>


      @php($url = str_replace(URL::to('/'),'',URL::current()))


      @if(!($url == '/login'))
        @if(!($url == '/register'))
        <nav class="navbar navbar-expand-lg" role="navigation" style="height: 30px;font-size: 12px; background-color: #EEEEEE"><!-- Navegação -->
          <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-auto">
              @yield('navbar')
            </ul>
          </div>
        </nav>
        @endif
      @endif

      <br>
@endif
<!-- page-container -->
      <div id="container-fluid" style="background-color:#FFFFFF">
        <div id="content-wrap">
          @yield('content')
        <!-- <div id="footer-brasil"></div> -->
        </div>
        <div>
          @component('components.footer-brasil')
          @endcomponent
        </div>
      </div>



    </div>
  </div>



  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/bootstrap-filestyle.min.js')}}"> </script>

</body>


<!-- <script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script> -->

</html>
