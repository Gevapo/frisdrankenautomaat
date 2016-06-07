<?php

namespace Frisdrank\Entities;

/**
 * Description of Wisselgeld
 *
 * @author gevapo
 */
class Wisselgeld
{

    private $id;
    private $naam;
    private $voorraad;
    private $waarde;

    public function __construct()
    {
        
    }

    public function createWisselgeld($naam, $waarde, $voorraad)
    {
        $this->naam = $naam;
        $this->waarde = $waarde;
        $this->voorraad = $voorraad;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNaam()
    {
        return $this->naam;
    }

    public function getVoorraad()
    {
        return $this->voorraad;
    }

    public function getWaarde()
    {
        return $this->waarde;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNaam($naam)
    {
        $this->naam = $naam;
    }

    public function setVoorraad($voorraad)
    {
        $this->voorraad = $voorraad;
    }

    public function setWaarde($waarde)
    {
        $this->waarde = $waarde;
    }

}
