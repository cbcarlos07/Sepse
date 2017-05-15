<?php

/**
 * Created by PhpStorm.
 * User: carlos.bruno
 * Date: 11/05/2017
 * Time: 12:23
 */
class Laudos
{
  private $conforme;
  private $total;

    /**
     * @return mixed
     */
    public function getConforme()
    {
        return $this->conforme;
    }

    /**
     * @param mixed $conforme
     * @return Laudos
     */
    public function setConforme($conforme)
    {
        $this->conforme = $conforme;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     * @return Laudos
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }


}