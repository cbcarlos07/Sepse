<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Situacao_Controller{
     
    
    public function lista($inicio, $fim){
        require_once "../model/situacao_dao.php";
        $teste_DAO = new Situacao_DAO();
        $lista =   $teste_DAO->lista($inicio, $fim);
        return $lista;
    }
    public function recuperarTotal(){
        require_once "/model/situacao_dao.php";
        $teste_DAO = new Situacao_DAO();
        $lista =   $teste_DAO->recuperarTotal();
        return $lista;
    }

    public function listaProtocolo($data){
        require_once "../model/situacao_dao.php";
        $teste_DAO = new Situacao_DAO();
        $lista =   $teste_DAO->listaProtocolo($data);
        return $lista;
    }

    public function laudosConformeNaoConforme($data){
        require_once "../model/situacao_dao.php";
        $teste_DAO = new Situacao_DAO();
        $lista =   $teste_DAO->laudosConformeNaoConforme($data);
        return $lista;

    }

    public function listaSepsePorBioqumico($data){
        require_once "../model/situacao_dao.php";
        $teste_DAO = new Situacao_DAO();
        $lista =   $teste_DAO->listaSepsePorBioqumico($data);
        return $lista;
    }

    public function listaSepseNaoConforme($data){
        require_once "../model/situacao_dao.php";
        $teste_DAO = new Situacao_DAO();
        $lista =   $teste_DAO->listaSepseNaoConforme($data);
        return $lista;
    }

    public function listaSepseMediaDeTempo($data){
        require_once "../model/situacao_dao.php";
        $teste_DAO = new Situacao_DAO();
        $lista =   $teste_DAO->listaSepseMediaDeTempo($data);
        return $lista;
    }
  
  
}