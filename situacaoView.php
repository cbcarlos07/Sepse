<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if(isset($_GET['ciente'])){
    $ciente = $_GET['ciente'];
}else{
    $ciente = 'N';
}
if(isset($_GET['codigo'])){
    $cd = $_GET['codigo'];
}else{
    $cd = 0;
}

if(isset($_GET['ciente'])){
    echo 'Ciente: '.$ciente;
}


?>


<html>
    <head>
        <!--<title>AVISO SEPSE</title>-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta HTTP-EQUIV="refresh" CONTENT="30">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
        <link href="css/situacao.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="public/img/ham.ico">      
       
               
    </head>
      <body >

      <!-- Modal -->
      <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalLabel">Informe a compet&ecirc;ncia</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="dtp_input1" class="col-md-12 control-label"></label>
                          <div class="input-group date form_datetime col-md-12"    data-date-format="mm/yyyy" data-link-field="dtp_input1" data-date-viewmode="years" data-date-minviewmode="months">
                              <input class="form-control" id="campodata" size="16" type="text"  readonly>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                          </div>
                          <input type="hidden" id="dtp_input1" value="" /><br/>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <a type="button" class="btn btn-primary btn-sim">OK</a>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  </div>
              </div>
          </div>
      </div>

      <ul class="nav nav-tabs">

          <li class="dropdown">
              <a href="#" class="dropdown-toggle test"  data-toggle="dropdown">Protocolo de Sepse
                  <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a tabindex="-1" href="#" data-toggle="modal" data-target="#delete-modal">Sepse</a></li>
                  <li><a tabindex="-1" href="#">Dor Tor&aacute;cica</a></li>

              </ul>
          </li>
      </ul>

     <!-- <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Protocolos</a>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right ">
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle test"  data-toggle="dropdown">Protocolo de Sepse
                              <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <li><a tabindex="-1" href="#" data-toggle="modal" data-target="#delete-modal">Sepse</a></li>
                              <li><a tabindex="-1" href="#">Dor Tor&aacute;cica</a></li>

                          </ul>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>-->
      <div class="container-fluid">
           <div style="margin-top: 45px;">
           <div id=tab class="col-lg-12">
                          <div id="tabela" class="col-lg-12">
                              <?php 
                              
                                            require 'controller/Situacao_Controller.class.php';
                                            #require 'SituacaoPaciente.class.php'; 
                                            #require 'SituacaoList.class.php';
                                            require 'services/SituacaoListIterator.class.php';
                                            $dao = new Situacao_Controller();


                                            $total = $dao->recuperarTotal();
                                            //echo "Total: $total";
                                              if($total > 0){
                                                  echo "<title>($total) AVISO SEPSE </title>";
                              ?>
                              <!-- if browser is chrome -->
                              
                                <div style="display: none;">
                                        <audio controls="controls" height="50px" width="100px" autoplay="autoplay" >
                                          <source src="public/audio/som.mp3" type="audio/mpeg" />
                                        <!--  <source src="som.ogg" type="audio/ogg" /> -->
                                        <embed height="50px" width="100px" src="som.mp3" />
                                        </audio>
                                </div>

                               <table border=1 width=100% onload=chamaphp() style="font-family: font-family: 'Tahoma','Arial'; font-weight: bold;">
                                       <tr id=titulo>
                                           <td WIDTH="100">&nbsp;&nbsp;PEDIDO&nbsp;&nbsp;</TD><TD>&nbsp;&nbsp;PACIENTE</TD><TD>&nbsp;&nbsp;LOCAL</TD><TD>DESCRIÇÃO</TD>
                                      </tr>
                                        <tbody style="font-size: 25px;">
                                        <?php

                                            /* @var $pagina type */
                                            if(!isset($_GET['pagina']))
                                            {
                                                $pagina = 1;
                                            }  
                                            else{
                                                $pagina = $_GET['pagina'];
                                            }
                                                //.
                     
                                            // bloco 2 - defina o número de registros exibidos por página
                                            $num_por_pagina = 30; 

                                            // bloco 3 - descubra o número da página que será exibida
                                            // se o numero da página não for informado, definir como 1

                                            
                                            
                                            
                                                
                                              
                                              
                                            
                                            
                                            // bloco 4 - construa uma cláusula SQL "SELECT" que nos retorne somente os registros desejados
                                            // definir o número do primeiro registro da página. Faça a continha na calculadora que você entenderá minha fórmula.
                                            $primeiro_registro = ($pagina*$num_por_pagina) - $num_por_pagina;

                                             // consulta apenas os registros da página em questão utilizando como auxílio a definição LIMIT. Ordene os registros pela quantidade de pontos, começando do maior para o menor DESC.


                                             /* 
                                             * To change this license header, choose License Headers in Project Properties.
                                             * To change this template file, choose Tools | Templates
                                             * and open the template in the editor.
                                             */

                                            
                                                        echo "<bgsound src='public/audio/coleta.wav'  loop=3 volume=0 ></bgsound>";
                                         
                                                        $refresh = "";
                                                        // echo "total: $total  Numero por pagina: $num_por_pagina";
                                                         if($total > $num_por_pagina){
                                                              if(!isset($_SESSION['pagina'])){
                                                              $pagina = 1;
                                                              $_SESSION['pagina'] = $pagina ;
                                                          }  else{
                                                              if( $_SESSION['pagina'] == 1){
                                                                  $pagina = 2;
                                                                  $_SESSION['pagina'] = $pagina ;
                                                              }
                                                              else {
                                                                  $pagina = 1;
                                                                  $_SESSION['pagina'] = $pagina;

                                                              }
                                                          }


                                                             if($pagina == 1){
                                                             $rs = $dao->lista($primeiro_registro, $num_por_pagina);
                                                           //  $refresh = "refresh:20; url={$_SERVER['PHP_SELF']}?pagina=2" ;
                                                             header($refresh);

                                                             }else{
                                                                     $rs = $dao->lista($num_por_pagina+1, $total);
                                                                     /*echo '<meta http-equiv="refresh" content="6" />';
                                                                     $refresh = "refresh:6; url={$_SERVER['PHP_SELF']}?pagina=1" ;
                                                                     header($refresh);*/


                                                             }

                                                                 $total_paginas = $total / $num_por_pagina;
                                                                 $prev = 1;
                                                                 $next = 2;

                                                                             if ($pagina > 1) {
                                                                                 $prev_link = "<a href='{$_SERVER['PHP_SELF']}?pagina=$prev' >Anterior</a>";

                                                                                 } else { // senão não há link para a página anterior

                                                                                 $prev_link = "Anterior";

                                                                                 }


                                                                 // se número total de páginas for maior que a página corrente, então temos link para a próxima página
                                                               if ($total_paginas > $pagina) {
                                                               $next_link = "<a href='{$_SERVER['PHP_SELF']}?pagina=$next' >Próxima</a>";
                                                               } else { // senão não há link para a próxima página
                                                               $next_link = "Próxima";

                                                               }

                                                               // vamos arredondar para o alto o número de páginas que serão necessárias para exibir todos os registros. Por exemplo, se temos 20 registros e mostramos 6 por página, nossa variável $total_paginas será igual a 20/6, que resultará em 3.33. Para exibir os 2 registros restantes dos 18 mostrados nas primeiras 3 páginas (0.33), será necessária a quarta página. Logo, sempre devemos arredondar uma fração de número real para um inteiro de cima e isto é feito com a função ceil().
                                                               //echo "onload=chamaphp()";
                                                               $total_paginas = ceil($total_paginas);
                                                               $painel = "";
                                                               for ($x=1; $x<=$total_paginas; $x++) {
                                                                 if ($x==$pagina) { // se estivermos na página corrente, não exibir o link para visualização desta página
                                                                   $painel .= " [$x] ";
                                                                 } else {
                                                                   $painel .= " <a href='{$_SERVER['PHP_SELF']}?pagina=$x'>[$x]</a>";
                                                                 }
                                                               }






                                                         // exibir painel na tela
                                                         echo "$prev_link | $painel | $next_link";

                                                         }else{
                                                          //   echo 'não é maior que o total';
                                                             $rs = $dao->lista($primeiro_registro, $num_por_pagina);
                                                             echo '<meta http-equiv="refresh" content="60" />';
                                                         }

                                                         // se página maior que 1 (um), então temos link para a página anterior

                                                         $i = 0;
                                                         $spList = new SituacaoListIterator($rs);
                                                         $sp = new SituacaoPaciente();
                                                         $paciente = new Paciente();


                                                        while($spList->hasNextSituacao()){
                                                             $i++;

                                                            $sp = $spList->getNextSituacao();
                                                           if($i % 2 == 0){
                                                               $par = "#d5e6ef";
                                                           }else{
                                                               $par = "#ffffff";
                                                           }  
                                                             echo "<tr bgcolor=$par id=fundoc".$i." class=corpo >";
                                                             #echo "<td align=center><a href='#'><img id=$i src=public/img/salcir.png width=29 height=29 onclick=mudaImagem();></a></td>";

                                                             echo "<td align=center> ".$sp->getPedido()." </td>";
                                                             echo "<td>".$sp->getPaciente()."</td>";
                                                             echo "<td>".$sp->getLocal()."</td>";
                                                             echo "<td>".$sp->getDescricao()."</td>";
                                                             echo "</tr>";


                                                         }
                                              
                                           
                                        
                                            
                       
                    ?>
                                            <tbody>              
                      </table>

                              <?php
                               }else{
                               ?>
                                       <div class="alert alert-success" style="margin-top: 10%; ">
                                        <title>AVISO SEPSE</title>
                                        <h2 style="text-align: center">N&Atilde;O EXISTEM PROTOCOLOS EM ANDAMENTO</h2>
                                       </div>
                                            
                    <?php                        
                                               }
                       ?>
                  </div>

           </div>
         </div>
      </div>
                <script src="js/jquery-1.8.3.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <script src="js/bootstrap-datetimepicker.js"></script>
                <script src="js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
      <script type="text/javascript">
          $('.form_datetime').datetimepicker({
              language:  'pt-BR',
              weekStart: 0,
              todayBtn:  1,
              autoclose: 1,
              todayHighlight: 1,
              startView: 3,
              minView: 3,
              forceParse: 0,
              showMeridian: 1
          });
      </script>

       <script>
           $('.btn-sim').on('click',function () {

               var competencia = document.getElementById('campodata').value;
               //alert('Data: '+competencia);
               if(competencia == ""){
                   alert('Por favor informe a competência')
                   document.getElementById('campodata').focus();

               }else{
                   console.log("Competencia: "+competencia);
                   var form = $('<form action="services/sepse_excel.php" method="post" >'+
                       '<input type="hidden" value="'+competencia+'" name="data" />'+
                       '</form>');
                   $('body').append(form);
                   form.submit();
                   $('#delete-modal').modal('hide');
               }


           });


       </script>

               

           
      </body>
                           
           
</html>
