<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LaudosListIterator {
    protected $laudosList;
    protected $currentLaudos = 0;

    public function __construct(LaudosList $laudosList_in) {
      $this->laudosList = $laudosList_in;
    }
    public function getCurrentLaudos() {
      if (($this->currentLaudos > 0) && 
          ($this->laudosList->getLaudosCount() >= $this->currentLaudos)) {
        return $this->laudosList->getLaudos($this->currentLaudos);
      }
    }
    public function getNextLaudos() {
      if ($this->hasNextLaudos()) {
        return $this->laudosList->getLaudos(++$this->currentLaudos);
      } else {
        return NULL;
      }
    }
    public function hasNextLaudos() {
      if ($this->laudosList->getLaudosCount() > $this->currentLaudos) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}