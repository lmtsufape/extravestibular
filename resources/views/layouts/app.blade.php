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
    <!-- responsividade separador navbar -->
    <style type="text/css">
    #footer-lmts{
      padding-top: 5%;
    }

      @media screen and (max-width: 576px) {
        .separador-lmts{
          display: none;
        }
        #footer-lmts{
          padding-top: 20%;
        }
      }

      @media screen and (max-width: 768px) {
        .separador-lmts{
          display: none;
        }
        #footer-lmts{
          padding-top: 20%;
        }
      }
    </style>

</head>
<body>

  <div id="page-container">
   <div id="content-wrap">
      <!-- Barra de Brasil -->
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
      <div id="barra-logos" lass-"container" style="background:#FFFFFF; margin-top: 1px; height: 150px; padding: 10px 0 10px 0;">
        <ul id="logos" style="list-style:none;">
            <li style="margin-right: 0%; margin-left: -2%; border-right:1px ;height: 120px">
              @if(Auth::check())
                <a href="{{ route("home") }}"><img src="{{asset('images/logo.png')}}" style = "margin-left: 15px ; margin-top:1.2% " height="70%" align = "left" ></a>
              @else
                <a href="{{ route("homeApi") }}"><img src="{{asset('images/logo.png')}}" style = "margin-left: 15px; margin-top:1.2% " height="70%" align = "left" ></a>
              @endif
                <a target="_blank" href="http://lmts.uag.ufrpe.br/"><img src="{{asset('images/lmts.jpg')}}" style = "margin-left: 8px; margin-top:30px " height="70%"  align = "right" ></a>

                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70%" align = "right" >
                <a target="_blank" href="http://www.preg.ufrpe.br/"><img src="{{asset('images/logoPreg.png')}}" style = "margin-left: 10px; margin-top: 30px" height="70%"  align = "right" ></a>


                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70%" align = "right" >

                <a target="_blank" href="http://ww3.uag.ufrpe.br/"><img src="{{asset('images/uag.png')}}" style = "margin-left: 10px; margin-top: 30px" height="60%" align = "right" ></a>


                <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70%" align = "right" >
                <a target="_blank" href="http://www.ufrpe.br/"><img src="{{asset('images/ufrpe.png')}}" style = "margin-left: 15px; margin-right: -10px; margin-top: 30px " height="70%"  align = "right"></a>
            </li>
        </ul>
      </div>
      @if(Auth::check())
        <!-- barra de menu usuario modulo = candidato -->
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);">
          <a class="navbar-brand" href="{{ route('home') }}" style="color: white; font-weight: bold;">
            <img src="{{asset('images/home.png')}}" height="30" class="d-inline-block align-top" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <!-- Menu da Esquerda -->
            <ul class="navbar-nav mr-auto">
              <!-- Ver Editais -->
              <li class="nav-item active">
                  <a class="nav-link" href="{{ route('home') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('VerEditais').submit();">
                     {{ __('EDITAIS PUBLICADOS') }}
                  </a>
                  <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

                  </form>
              </li>
              <!-- separador -->
              <li class="separador-lmts">
                |
              </li>
              <!-- if usuario tem dados cadastrados -->
              @if(!is_null(Auth::user()->dados))
                <!-- Editar Dados do Perfil -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('editarDadosUsuario') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('cadastroDadosUsuario').submit();">
                       {{ __('EDITAR DADOS DE USUÁRIO') }}
                    </a>
                    <form id="cadastroDadosUsuario" action="{{ route('editarDadosUsuario') }}" method="GET" style="display: none;">
                    </form>
                </li>
              @endif
            </ul>

            <!-- Menu da Direita -->
            <ul class="nav navbar-nav navbar-right">
              <!-- Logout -->
              <li class="nav-item active">
                <a class="nav-link"  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('SAIR') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>

          </div>
        </nav>


        @php($url = str_replace(URL::to('/'),'',URL::current()))
        @if(!($url == '/login'))
          @if(!($url == '/register'))
            <nav class="navbar navbar-expand-sm" role="navigation" style="height: 30px;font-size: 12px; background-color: #EEEEEE"><!-- Navegação -->
              <div class="collapse navbar-collapse" >
                <ul class="navbar-nav mr-auto">
                  @yield('navbar')
                </ul>
              </div>
            </nav>
          @endif
        @endif
      @endif

      @if(!is_null(session('tipo')))
        <!-- barra de menu usuarios api-->
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);">
          <a class="navbar-brand" href="{{ route('homeApi') }}" style="color: white; font-weight: bold;">
            <img src="{{asset('images/home.png')}}" height="30" class="d-inline-block align-top" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <!-- Menu da Esquerda -->
            <ul class="navbar-nav mr-auto">
              <!-- Editais Publicados -->
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('homeApi') }}"
                  onclick="event.preventDefault();
                  document.getElementById('VerEditais').submit();">
                  {{ __('EDITAIS PUBLICADOS') }}
                </a>
                <form id="VerEditais" action="{{ route('homeApi') }}" method="GET" style="display: none;">
                </form>
              </li>
              <!-- Visão PREG -->
              @if(session('tipo') == 'PREG')
                 <!-- separador -->
                <li class="separador-lmts">
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
            </ul>
            <!-- Menu da Direita -->
            <ul class="nav navbar-nav navbar-right">
              <!-- Logout -->
              <li class="nav-item active">
                <a class="nav-link"  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('SAIR') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
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


      @endif
      <!-- page-container -->
      <div id="container-fluid" style="background-color:#FFFFFF">
        <div id="content-wrap">
          @yield('content')
        </div>
        <div id="footer-lmts">
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

</html>
