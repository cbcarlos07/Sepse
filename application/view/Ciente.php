<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_GET['ciente'])){
    $ciente = 'S';
    $cod = $_GET['codigo'];
    
    echo 'Ciente = '.$ciente.'<br>';
    echo 'C&oacute;digo = '.$cod.'<br>';
   // header("Location:http://localhost/sepse");
   //echo "<META HTTP-EQUIV='REFRESH' CONTENT='1; URL=http://localhost/sepse'>";
    
}else{
    $ciente = 'N';
}


