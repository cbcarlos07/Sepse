<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BioquimicoList {
    private $bioquimico = array();
    private $bioquimicoCount = 0;
    public function __construct() {
    }
    public function getBioquimicoCount() {
      return $this->bioquimicoCount;
    }
    private function setBioquimicoCount($newCount) {
      $this->bioquimicoCount = $newCount;
    }
    public function getBioquimico($bioquimicoNumberToGet) {
      if ( (is_numeric($bioquimicoNumberToGet)) && 
           ($bioquimicoNumberToGet <= $this->getBioquimicoCount())) {
           return $this->bioquimico[$bioquimicoNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addBioquimico(Bioquimico $bioquimico_in) {
      $this->setBioquimicoCount($this->getBioquimicoCount() + 1);
      $this->bioquimico[$this->getBioquimicoCount()] = $bioquimico_in;
      return $this->getBioquimicoCount();
    }
    public function removeBioquimico(Bioquimico $bioquimico_in) {
      $counter = 0;
      while (++$counter <= $this->getBioquimicoCount()) {
        if ($bioquimico_in->getAuthorAndTitle() == 
          $this->bioquimico[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getBioquimicoCount(); $x++) {
              $this->bioquimico[$x] = $this->bioquimico[$x + 1];
          }
          $this->setBioquimicoCount($this->getBioquimicoCount() - 1);
        }
      }
      return $this->getBioquimicoCount();
    }
}
