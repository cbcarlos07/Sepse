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
        <link rel="stylesheet" type="text/css" href="public/style/situacao.css">
        <link rel="shortcut icon" href="public/img/ham.ico">      
       
               
    </head>
      <body >
           <div id=tab >
                          <div id="tabela" >
                              <?php 
                              
                                             require 'Situacao_Controller.class.php';
                                            #require 'SituacaoPaciente.class.php'; 
                                            #require 'SituacaoList.class.php';
                                            #require 'SituacaoListIterator.class.php';
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

                               <table border=1 width=99% onload=chamaphp()>
                                       <tr id=titulo>
                                           <td WIDTH="100">&nbsp;&nbsp;PEDIDO&nbsp;&nbsp;</TD><TD>&nbsp;&nbsp;PACIENTE</TD><TD>&nbsp;&nbsp;LOCAL</TD><TD>DESCRIÇÃO</TD>
                                      </tr>
                                        <tbody>          
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
                                            session_start();
                                            
                                            
                                            
                                                
                                              
                                              
                                            
                                            
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
                                        <title>AVISO SEPSE</title>
                                        <h2>N&Atilde;O EXISTEM PROTOCOLOS EM ANDAMENTO</h2>
                                            
                    <?php                        
                                               }
                       ?>
                  </div>

           </div>
          
                <script type="text/javascript">
                    function cbalterna(cb, cod) {
//testando pra ver se foi 123
                 //   elemento = document.getElementById("fundo"+cb.id);
                  if(cb.checked)
                  {
                          
                          document.getElementById("fundo"+cb.id).style.color = "black";
                      //    window.location = 'arquivo.php?variavel='+valor
                            //$_SERVER['PHP_SELF']
                          corFonte(cb);
                          ciente(cb, cod);
                    }
                  else{
                      
                      document.getElementById("fundo"+cb.id).style.color = "white";
                     
                      corFonte(cb);
                      ciente(cb, cod);
                   }
                    
                  }
                    
                </script>
                <script type="text/javascript">
                 function ciente(cb, cdatend){
                        if(cb.checked){
                         //  window.location = " application/view/Ciente.php?codigo="+cdatend+"&ciente=S";
                        }else{
                        //    window.location = " application/view/Ciente.php?codigo="+cdatend+"&ciente=N";
                            }
                 }
                </script>
               
           <script type="text/javascript">
               function corFonte(cb) {

                   //   elemento = document.getElementById("fundo"+cb.id);
                   if(cb.checked)
                   {
                       document.getElementById("fundo"+cb.id).style.backgroundColor = "white";
                  
                   }
                   else{
                    
                       document.getElementById("fundo"+cb.id).style.backgroundColor = "red";
                      
                   }
                   //elemento.style.backgroundColor = cb.checked ? "#ed0909" : "#fff";

               }

           </script>
           
      </body>
                           
           
</html>
