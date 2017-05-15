<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SituacaoPaciente {
 
            
     private $pedido;  
     private $paciente;
     private $local;
     private $descricao;

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     * @return SituacaoPaciente
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }
     
    

    

     public function getPedido() {
         return $this->pedido;
     }
     
      public function setPedido($pedido) {
         $this->pedido = $pedido;
         return $this;
     }

     public function getPaciente() {
         return $this->paciente;
     }
     
      public function setPaciente($paciente) {
         $this->paciente = $paciente;
         return $this;
     }

     public function getLocal() {
         return $this->local;
     }

     public function setLocal($local) {
         $this->local = $local;
         return $this;
     }

}