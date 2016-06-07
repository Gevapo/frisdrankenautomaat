<?php

namespace Frisdrank\Entities;

/**
 * Description of Drank
 *
 * @author gevapo 
 */
class Drank
{

    private $id;
    private $naam;
    private $pic;
    private $prijs;
    private $voorraad;

    public function __construct() {}
    
    public function createDrank($naam, $pic, $prijs, $voorraad)
    {
        $this->naam = $naam;
        $this->pic = $pic;
        $this->prijs = $prijs;
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
    
    public function getPic()
    {
        return $this->pic;
    }
    
    public function getPrijs()
    {
        return $this->prijs;
    }
    
    public function getVoorraad()
    {
        return $this->voorraad;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setNaam($naam)
    {
        $this->naam = $naam;
    }
    
    public function setPic($pic)
    {
        $this->pic = $pic;
    }
    
    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;
    }
    
    public function setVoorraad($voorraad)
    {
        $this->voorraad = $voorraad;
    }

}
