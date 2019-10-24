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
    <link href="{{ asset('css/app-style.css') }}" rel="stylesheet">

    <script type="text/javascript">

    </script>

    

</head>
<body>

  <div class="card" style="width: 100%;">


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
