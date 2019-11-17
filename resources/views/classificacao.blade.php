<!DOCTYPE html>
<!-- Versão 19.0528-1625 -->
<html lang="{{ app()->getLocale() }}">
<head>


    <!-- CSRF Token -->


    <!--<title>{{ config('app.name', 'Laravel') }}</title> -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/field-animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylelmts.css') }}" rel="stylesheet">

    <script type="text/javascript" >


      function appendTable(table, nome, cpf, modalidade, curso, campus, colocacao, situacao, turno) {
          var nomeTable = table;
          var table = document.getElementById(nomeTable.toString());
          var row = table.insertRow(-1);
          var cell0 = row.insertCell(0);
          var cell1 = row.insertCell(1);
          var cell2 = row.insertCell(2);
          var cell3 = row.insertCell(3);
          var cell4 = row.insertCell(4);
          var cell5 = row.insertCell(5);
          var cell6 = row.insertCell(6);
          var cell7 = row.insertCell(7);
          cell0.innerHTML = nome;
          cell1.innerHTML = cpf;
          cell2.innerHTML = modalidade;
          cell3.innerHTML = curso;
          cell4.innerHTML = campus;
          cell5.innerHTML = colocacao;
          cell6.innerHTML = situacao;
          cell7.innerHTML = turno;
      }

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
            background-color: white;
        }
        .select2-container--bootstrap .select2-results__option--highlighted[aria-selected] {
            color: #fff;
            background-color: white;
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


	<title>
		Resultados Classificação do
		<?php
			$nomeEdital = explode(".pdf", $edital->nome);
			echo ($nomeEdital[0]);
	  ?>
 	</title>

</head>

<body style="background-color: white; font-family: arial">
  <div class="container-fluid justify-content-left" style="background-color: white">
    <!-- aprovados -->

    <!-- timbrado governo -->
      <div class="row" >
        <div class="col-sm-12">
          <img style="margin-left:15%" src="{{asset('images/head.jpg')}}"  height="300px" align ="center" >
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-sm-12">
          <h4 style="font-weight: bold"> Resultado <?php if($edital->resultadoFinal <= $mytime){echo('final');} else{echo('parcial');} ?> do Edital <?php $nomeEdital = explode(".pdf", $edital->nome); echo ($nomeEdital[0]); ?> publicado em {{date_format(date_create($edital->dataPublicacao), 'd/m/y')}}</h4>
        </div>
      </div>

    <!-- lista -->
      <?php
        $i = 1;
        $primeiroCurso = true;
        $cursoAtual = '';
        $posicoes = [];
      ?>
      <div class="row">
        <div class="col-sm-12">
          @foreach ($inscricoes as $inscricao)
              <!-- Pega o nome e departamento do curso da api-->
              <?php
                $nomeCurso = '';
                $campus = '';
                foreach ($cursos as $key) {
                  if($key['id'] == $inscricao->curso){
                    $nomeCurso = $key['nome'];
                    $campus = $key['campus'];
                  }
                }
              ?>
              <!-- Começar uma nova tabela sempre que achar um curso diferente -->
          		@if($cursoAtual != $inscricao->curso)
                <!-- <input type="hidden" name="{{$cursoAtual}}" value="$i"> -->
          			<?php
                  array_push($posicoes, ['cursoId' => $cursoAtual, 'posicao' => $i]);
          				$i = 1;
          				$cursoAtual =  $inscricao->curso;
          			?>
                <!-- Não fechar tabela do curso anterior caso seja o primeiro curso -->
          			@if(!$primeiroCurso)
          				</table>
          			@endif
                <div class="titulo-tabela-lmts" style="width: 100%; margin-left: 0px; <?php if(!$primeiroCurso){ echo('margin-top: 10%');} ?>">
                  <h4>{{$nomeCurso}}</h4>
                </div>
          			<table id="{{$cursoAtual}}" class="table table-sm table-striped" width="100%" style="font-size: 6px;">
        					<tr>
                    <th style="width: 20%; height: 10px"> NOME </th>
                    <th style="width: 10%; height: 10px"> CPF </th>
                    <th style="width: 10%; height: 10px"> MODALIDADE </th>
                    <th style="width: 17%; height: 10px"> CURSO PRETENDIDO</th>
                    <th style="width: 15%; height: 10px"> CAMPUS </th>
                    <th align="center" style="width: 5% ; height: 10px"> COLOCAÇÃO </th>
                    <th align="center" style="width: 6% ; height: 10px"> SITUAÇÃO </th>
                    <th align="center" style="width: 7% ; height: 10px"> TURNO </th>
        					</tr>
          		@endif

          				<tr style="background-color: white; line-height: 3px">
          					<td> {{$inscricao->user->dadosUsuario->nome}} </td>
          					<td> {{$inscricao->user->dadosUsuario->cpf}} </td>
          					<td>
                      <?php
                       if($inscricao->tipo == 'reintegracao'){
                         echo('Reintegração');
                       }
                       elseif($inscricao->tipo == 'transferenciaInterna'){
                         echo('Transferência Interna');
                       }
                       elseif($inscricao->tipo == 'transferenciaExterna'){
                         echo('Transferência Externa');
                       }
                       elseif($inscricao->tipo == 'portadorDeDiploma'){
                         echo('Portador de Diploma');
                       }
                      ?>
                    </td>
          					<td> {{$nomeCurso}} </td>
          					<td> {{$campus}} </td>
                    <td align="center"> {{$i}} </t>
          					<td align="center" style="background-color: <?php if($inscricao->situacao == 'Aprovado'){echo ('lightgreen'); }else{echo('lightyellow');}  ?>"> {{$inscricao->situacao}} </td>
          					<td align="center">
                      <?php
                        if($inscricao->turno == 'manhã'){
                          echo('Manhã');
                        }
                        else if($inscricao->turno == 'tarde'){
                          echo('Tarde');
                        }
                        else if($inscricao->turno == 'noite'){
                          echo('Noite');
                        }
                        else if($inscricao->turno == 'integral'){
                          echo('Integral');
                        }
                        else if($inscricao->turno == 'especial'){
                          echo('Especial');
                        }
                      ?>
                    </td>
          				</tr>

          	 	<?php
          			$i++;
          			$primeiroCurso = false;
          		?>
          @endforeach
          <!-- Fechar ultima tabela -->
          </table>
        </div>
      </div>

    <!-- classiificaveis -->
    <div class="row">
      <div class="col-sm-12">
        @foreach ($inscricoes as $inscricao)
            <!-- Pega o nome e departamento do curso da api-->
            <?php
              $nomeCurso = '';
              $campus = '';
              foreach ($cursos as $key) {
                if($key['id'] == $inscricao->curso){
                  $nomeCurso = $key['nome'];
                  $campus = $key['campus'];
                }
              }
            ?>
            <!-- Começar uma nova tabela sempre que achar um curso diferente -->
            @if($cursoAtual != $inscricao->curso)
              <?php
                $cursoAtual =  $inscricao->curso;
                foreach ($posicoes as $key) {
                  if($key['cursoId'] == $cursoAtual){
                    $i = $key['posicao'];
                  }
                }
              ?>
            @endif

            @if($inscricao->situacao == 'Classificável')
              <?php
               $modalidade = 'a';
               if($inscricao->tipo == 'reintegracao'){
                 $modalidade = 'Reintegração';
               }
               elseif($inscricao->tipo == 'transferenciaInterna'){
                 $modalidade = 'Transferência Interna';
               }
               elseif($inscricao->tipo == 'transferenciaExterna'){
                 $modalidade = 'Transferência Externa';
               }
               elseif($inscricao->tipo == 'portadorDeDiploma'){
                 $modalidade = 'Portador de Diploma';
               }

               $turno = 'a';
               if($inscricao->turno == 'manhã'){
                 $turno = 'Manhã';
               }
               else if($inscricao->turno == 'tarde'){
                 $turno = 'Tarde';
               }
               else if($inscricao->turno == 'noite'){
                 $turno = 'Noite';
               }
               else if($inscricao->turno == 'integral'){
                 $turno = 'Integral';
               }
               else if($inscricao->turno == 'especial'){
                 $turno = 'Especial';
               }
              ?>

              <!-- <script type="text/javascript" >

                appendTable("{{$cursoAtual}}","{{$inscricao->user->dadosUsuario->nome}}","{{$inscricao->user->dadosUsuario->cpf}}","{{$modalidade}}","{{$nomeCurso}}","{{$campus}}","{{$i}}","{{$inscricao->situacao}}","{{$turno}}");

              </script> -->

              <?php
                $i++;
                $primeiroCurso = false;
              ?>
            @endif
        @endforeach
        <!-- Fechar ultima tabela -->
        </table>
      </div>
    </div>


    <!-- footer -->
      <div class="row">
        <div class="col-sm-12">
          <img style="margin-left:15%; margin-top:20px" src="{{asset('images/foot.jpg')}}"  height="100px" align ="center" >
        </div>
      </div>


  </div>
</body>


</html>
