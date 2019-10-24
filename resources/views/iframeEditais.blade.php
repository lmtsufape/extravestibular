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

  <div class="card" style="width: 100%;">

    <div class="titulo-tabela-lmts">
      <h2>Editais Abertos</h2>
    </div>
      <div class="card-body">
        <table class="table table-ordered table-hover">
          <?php $editaisAbertos = true;
                $editaisAbertosFlag = true;
                $editaisFinalizadosFlag = true; ?>
          @foreach ($editais as $edital)
            <?php if($edital->fimRecurso <= $mytime){
              $editaisAbertos = false;
            }
            else{
              $editaisAbertos = true;
            }
            ?>
            @if($editaisAbertos)
              @if($editaisAbertosFlag)
                <tr style="background-color: #F7F7F7">
                  <th> Editais Abertos</th><?php $editaisAbertosFlag = false;?>
                  <th> Publicado em </th>
                  <th> Arquivo </th>
                </tr>
              @endif
            @else
              @if($editaisFinalizadosFlag)
                <tr style="background-color: #F7F7F7">
                  <th> Editais Finalizados</th><?php $editaisFinalizadosFlag = false;?>
                  <th> Publicado em </th>
                  <th> Arquivo </th>
                </tr>
              @endif
            @endif
            <tr>

              <td style="width: 60rem">
                <div class="hover-popup-lmts">   <!-- time line  class="hover-popup-lmts"-->
                 <a>
                   <?php
                     $nomeEdital = explode(".pdf", $edital->nome);
                     echo ($nomeEdital[0]);
                    ?>
                   <span>
                     <img src="<?php
                      if($edital->inicioIsencao > $mytime){
                        echo (asset('images/timeline1.png'));
                      }

                      elseif(($edital->inicioIsencao <= $mytime) && ($edital->fimIsencao >= $mytime)){
                          echo (asset('images/timeline2.png'));
                      }

                      elseif(($edital->inicioRecursoIsencao <= $mytime) && ($edital->fimRecursoIsencao >= $mytime)){
                          echo (asset('images/timeline3.png'));

                      }

                      elseif(($edital->inicioInscricoes <= $mytime) && ($edital->fimInscricoes >= $mytime)){
                          echo (asset('images/timeline4.png'));

                      }
                      elseif(($edital->inicioRecurso <= $mytime) && ($edital->fimRecurso >= $mytime)){
                          echo (asset('images/timeline5.png'));
                      }
                      elseif($edital->fimRecurso <= $mytime){
                        echo (asset('images/timeline6.png'));
                      }


                     ?>" alt="image" height="140"/>
                   </span>
                 </a>

                </div>
              </td>
              <td> <!-- data -->
                <?php
                  $date = date_create($edital->dataPublicacao);
                 ?>
                <a>{{ date_format($date , 'd/m/y')  }}</a>
              </td>
              <td> <!-- Download -->
                <a href="{{ route('download', ['file' => $edital->pdfEdital])}}" target="_parent">Baixar Edital</a>
              </td>

            </tr>
          @endforeach

        </table>
      </div>
      <div class="card-body">
        {{ $editais->links() }}
      </div>
  </div>
</body>
</html>
