<?php

/**
 * Created by PhpStorm.
 * User: carlos.bruno
 * Date: 02/05/2017
 * Time: 15:31
 */
class Protocolo
{
private $setor;
private $pedido;
private $dataPedido;
private $paciente;
private $laudo;
private $bioquimico;
private $tempoTotal;
private $tempo;
private $indicador;
private $lactato;
private $leuco;
private $plaquetas;

    /**
     * @return mixed
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    /**
     * @param mixed $indicador
     * @return Protocolo
     */
    public function setIndicador($indicador)
    {
        $this->indicador = $indicador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSetor()
    {
        return $this->setor;
    }

    /**
     * @param mixed $setor
     * @return Protocolo
     */
    public function setSetor($setor)
    {
        $this->setor = $setor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * @param mixed $pedido
     * @return Protocolo
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataPedido()
    {
        return $this->dataPedido;
    }

    /**
     * @param mixed $dataPedido
     * @return Protocolo
     */
    public function setDataPedido($dataPedido)
    {
        $this->dataPedido = $dataPedido;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @param mixed $paciente
     * @return Protocolo
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLaudo()
    {
        return $this->laudo;
    }

    /**
     * @param mixed $laudo
     * @return Protocolo
     */
    public function setLaudo($laudo)
    {
        $this->laudo = $laudo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBioquimico()
    {
        return $this->bioquimico;
    }

    /**
     * @param mixed $bioquimico
     * @return Protocolo
     */
    public function setBioquimico($bioquimico)
    {
        $this->bioquimico = $bioquimico;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempoTotal()
    {
        return $this->tempoTotal;
    }

    /**
     * @param mixed $tempoTotal
     * @return Protocolo
     */
    public function setTempoTotal($tempoTotal)
    {
        $this->tempoTotal = $tempoTotal;
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
     * @return Protocolo
     */
    public function setTempo($tempo)
    {
        $this->tempo = $tempo;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getLactato()
    {
        return $this->lactato;
    }

    /**
     * @param mixed $lactato
     * @return Protocolo
     */
    public function setLactato($lactato)
    {
        $this->lactato = $lactato;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLeuco()
    {
        return $this->leuco;
    }

    /**
     * @param mixed $leuco
     * @return Protocolo
     */
    public function setLeuco($leuco)
    {
        $this->leuco = $leuco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlaquetas()
    {
        return $this->plaquetas;
    }

    /**
     * @param mixed $plaquetas
     * @return Protocolo
     */
    public function setPlaquetas($plaquetas)
    {
        $this->plaquetas = $plaquetas;
        return $this;
    }






}