<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'Paciente.class.php';
class SituacaoPaciente {
    
        
     private $atendimento;  
     private $paciente;
     private $mensagem;
     private $prestador;
     private $situacao;
     private $cirurgiaPrincipal;
     
     
     public function getCirurgiaPrincipal() {
        return $this->cirurgiaPrincipal;
    }

    public function setCirurgiaPrincipal($cirurgiaPrincipal) {
        $this->cirurgiaPrincipal = $cirurgiaPrincipal;
        return $this;
    }

    

     public function getAtendimento() {
         return $this->atendimento;
     }

     public function getPaciente() {
         return $this->paciente;
     }

     public function getMensagem() {
         return $this->mensagem;
     }

     public function setMensagem($mensagem) {
         $this->mensagem = $mensagem;
         return $this;
     }

     
     public function getPrestador() {
         return $this->prestador;
     }

     public function getSituacao() {
         return $this->situacao;
     }

     public function setAtendimento($atendimento) {
         $this->atendimento = $atendimento;
         return $this;
     }

     public function setPaciente($paciente) {
         $this->paciente = $paciente;
         return $this;
     }

     

     public function setPrestador($prestador) {
         $this->prestador = $prestador;
         return $this;
     }

     public function setSituacao($situacao) {
         $this->situacao = $situacao;
         return $this;
     }



}