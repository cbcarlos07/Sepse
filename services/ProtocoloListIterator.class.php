<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProtocoloListIterator {
    protected $protocoloList;
    protected $currentProtocolo = 0;

    public function __construct(ProtocoloList $protocoloList_in) {
      $this->protocoloList = $protocoloList_in;
    }
    public function getCurrentProtocolo() {
      if (($this->currentProtocolo > 0) && 
          ($this->protocoloList->getProtocoloCount() >= $this->currentProtocolo)) {
        return $this->protocoloList->getProtocolo($this->currentProtocolo);
      }
    }
    public function getNextProtocolo() {
      if ($this->hasNextProtocolo()) {
        return $this->protocoloList->getProtocolo(++$this->currentProtocolo);
      } else {
        return NULL;
      }
    }
    public function hasNextProtocolo() {
      if ($this->protocoloList->getProtocoloCount() > $this->currentProtocolo) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}