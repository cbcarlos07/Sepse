<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class LaudosList {
    private $laudos = array();
    private $laudosCount = 0;
    public function __construct() {
    }
    public function getLaudosCount() {
      return $this->laudosCount;
    }
    private function setLaudosCount($newCount) {
      $this->laudosCount = $newCount;
    }
    public function getLaudos($laudosNumberToGet) {
      if ( (is_numeric($laudosNumberToGet)) && 
           ($laudosNumberToGet <= $this->getLaudosCount())) {
           return $this->laudos[$laudosNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addLaudos(Laudos $laudos_in) {
      $this->setLaudosCount($this->getLaudosCount() + 1);
      $this->laudos[$this->getLaudosCount()] = $laudos_in;
      return $this->getLaudosCount();
    }
    public function removeLaudos(Laudos $laudos_in) {
      $counter = 0;
      while (++$counter <= $this->getLaudosCount()) {
        if ($laudos_in->getAuthorAndTitle() == 
          $this->laudos[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getLaudosCount(); $x++) {
              $this->laudos[$x] = $this->laudos[$x + 1];
          }
          $this->setLaudosCount($this->getLaudosCount() - 1);
        }
      }
      return $this->getLaudosCount();
    }
}
