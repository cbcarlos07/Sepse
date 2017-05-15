<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BioquimicoListIterator {
    protected $bioquimicoList;
    protected $currentBioquimico = 0;

    public function __construct(BioquimicoList $bioquimicoList_in) {
      $this->bioquimicoList = $bioquimicoList_in;
    }
    public function getCurrentBioquimico() {
      if (($this->currentBioquimico > 0) && 
          ($this->bioquimicoList->getBioquimicoCount() >= $this->currentBioquimico)) {
        return $this->bioquimicoList->getBioquimico($this->currentBioquimico);
      }
    }
    public function getNextBioquimico() {
      if ($this->hasNextBioquimico()) {
        return $this->bioquimicoList->getBioquimico(++$this->currentBioquimico);
      } else {
        return NULL;
      }
    }
    public function hasNextBioquimico() {
      if ($this->bioquimicoList->getBioquimicoCount() > $this->currentBioquimico) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}