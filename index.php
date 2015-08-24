<?php
require "./application/services/Url.class.php";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $modulo = Url::getURL( 0 );
/*
        if( $modulo == null )
            $modulo = "modulo1";

        if( file_exists( "modulos/" . $modulo . ".php" ) )
            require "modulos/" . $modulo . ".php";
        else
            require "modulos/404.php";
		
		*/
		 if( $modulo == null ){
			$app = "application";
			$view = "view";
				
		 }
            

        if( file_exists( "./application/view/situacaoView.php" ) )
            require "./application/view/situacaoView.php";
        else
            require "modulos/404.php";
		#header('Location:./application/view/situacaoView.php');
        ?>


