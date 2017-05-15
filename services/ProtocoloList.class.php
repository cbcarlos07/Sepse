<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ProtocoloList {
    private $protocolo = array();
    private $protocoloCount = 0;
    public function __construct() {
    }
    public function getProtocoloCount() {
      return $this->protocoloCount;
    }
    private function setProtocoloCount($newCount) {
      $this->protocoloCount = $newCount;
    }
    public function getProtocolo($protocoloNumberToGet) {
      if ( (is_numeric($protocoloNumberToGet)) && 
           ($protocoloNumberToGet <= $this->getProtocoloCount())) {
           return $this->protocolo[$protocoloNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addProtocolo(Protocolo $protocolo_in) {
      $this->setProtocoloCount($this->getProtocoloCount() + 1);
      $this->protocolo[$this->getProtocoloCount()] = $protocolo_in;
      return $this->getProtocoloCount();
    }
    public function removeProtocolo(Protocolo $protocolo_in) {
      $counter = 0;
      while (++$counter <= $this->getProtocoloCount()) {
        if ($protocolo_in->getAuthorAndTitle() == 
          $this->protocolo[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getProtocoloCount(); $x++) {
              $this->protocolo[$x] = $this->protocolo[$x + 1];
          }
          $this->setProtocoloCount($this->getProtocoloCount() - 1);
        }
      }
      return $this->getProtocoloCount();
    }
}
