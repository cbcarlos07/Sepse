<?php

/**
 * Created by PhpStorm.
 * User: carlos.bruno
 * Date: 11/05/2017
 * Time: 12:59
 */
class Bioquimico
{
  private $bioquimico;
  private $conforme;
  private $tempo;

    /**
     * @return mixed
     */
    public function getBioquimico()
    {
        return $this->bioquimico;
    }

    /**
     * @param mixed $bioquimico
     * @return Bioquimico
     */
    public function setBioquimico($bioquimico)
    {
        $this->bioquimico = $bioquimico;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConforme()
    {
        return $this->conforme;
    }

    /**
     * @param mixed $conforme
     * @return Bioquimico
     */
    public function setConforme($conforme)
    {
        $this->conforme = $conforme;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempo()
    {
        return $this->tempo;
    }

    /**
     * @param mixed $tempo
     * @return Bioquimico
     */
    public function setTempo($tempo)
    {
        $this->tempo = $tempo;
        return $this;
    }



}