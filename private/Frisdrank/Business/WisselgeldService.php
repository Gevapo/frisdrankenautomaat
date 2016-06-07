<?php

namespace Frisdrank\Business;

use Frisdrank\Data\WisselgeldDAO;
use Frisdrank\Entities\Wisselgeld;

/**
 * Description of WisselgeldService
 *
 * @author gevapo 
 */
class WisselgeldService
{

    private $wisselgeldDAO;

    public function __construct()
    {
        $this->wisselgeldDAO = new WisselgeldDAO();
    }

    public function getByName($naam)
    {
        return $this->wisselgeldDAO->getByName($naam);
    }
    
    public function decreaseWithChange($lijstMuntjes)
    {
        foreach ($lijstMuntjes as $key => $value) {
            $this->wisselgeldDAO->updateByWaarde($key, -$value);
        }
    }
    
    /**
     * 
     * @param Wisselgeld $wisselgeld
     */
    public function increaseWithOne(Wisselgeld $wisselgeld)
    {
        $waarde = $wisselgeld->getWaarde();
        $this->wisselgeldDAO->updateByWaarde($waarde, 1);
    }

    /**
     * 
     * @param float $terug
     * @return array
     */
    public function getMuntjes($terug)
    {

        $wisselgeldLijst = $this->wisselgeldDAO->getAll();

        $muntjesVoorraad = array();

        foreach ($wisselgeldLijst as $wisselgeld) {
            $muntjesVoorraad[$wisselgeld->getWaarde()] = $wisselgeld->getVoorraad();
        }

        $muntjesTerug = array();

        $munt = 2.00;

        if ($terug >= $munt && $muntjesVoorraad['2.00'] > 0) {

            $aantal = floor($terug / $munt);

            if ($muntjesVoorraad['2.00'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                
                $muntjesTerug['2.00'] = $aantal;
            } else if ($muntjesVoorraad['2.00'] > 0 && $muntjesVoorraad['2.00'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['2.00'] * $munt), 2);
                $muntjesTerug['2.00'] = $aantal;
            }
        }

        $munt = 1.00;

        if ($terug >= $munt && $muntjesVoorraad['1.00'] > 0) {
            
            $aantal = floor($terug / $munt);
            
            if ($muntjesVoorraad['1.00'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                $muntjesTerug['1.00'] = $aantal;
            } else if ($muntjesVoorraad['1.00'] > 0 && $muntjesVoorraad['1.00'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['1.00'] * $munt), 2);
                $muntjesTerug['1.00'] = $aantal;
            }
        }

        $munt = 0.50;

        if ($terug >= $munt && $muntjesVoorraad['0.50'] > 0) {
            
            $aantal = floor($terug / $munt);
            
            if ($muntjesVoorraad['0.50'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                $muntjesTerug['0.50'] = $aantal;
            } else if ($muntjesVoorraad['0.50'] > 0 && $muntjesVoorraad['0.50'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['0.50'] * $munt), 2);
                $muntjesTerug['0.50'] = $aantal;
            }
        }

        $munt = 0.20;

        if ($terug >= $munt && $muntjesVoorraad['0.20'] > 0) {
            
            $aantal = floor($terug / $munt);
            
            if ($muntjesVoorraad['0.20'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                $muntjesTerug['0.20'] = $aantal;
            } else if ($muntjesVoorraad['0.20'] > 0 && $muntjesVoorraad['0.20'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['0.20'] * $munt), 2);
                $muntjesTerug['0.20'] = $aantal;
            }
        }

        $munt = 0.10;

        if ($terug >= $munt && $muntjesVoorraad['0.10'] > 0) {
            
            $aantal = floor($terug / $munt);
            
            if ($muntjesVoorraad['0.10'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                $muntjesTerug['0.10'] = $aantal;
            } else if ($muntjesVoorraad['0.10'] > 0 && $muntjesVoorraad['0.10'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['0.10'] * $munt), 2);
                $muntjesTerug['0.10'] = $aantal;
            }
        }

        $munt = 0.05;

        if ($terug >= $munt && $muntjesVoorraad['0.05'] > 0) {
            
            $aantal = floor($terug / $munt);
            
            if ($muntjesVoorraad['0.05'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                $muntjesTerug['0.05'] = $aantal;
            } else if ($muntjesVoorraad['0.05'] > 0 && $muntjesVoorraad['0.05'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['0.05'] * $munt), 2);
                $muntjesTerug['0.05'] = $aantal;
            }
        }

        $munt = 0.02;

        if ($terug >= $munt && $muntjesVoorraad['0.02'] > 0) {
            
            $aantal = floor($terug / $munt);
            
            if ($muntjesVoorraad['0.02'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                $muntjesTerug['0.02'] = $aantal;
            } else if ($muntjesVoorraad['0.02'] > 0 && $muntjesVoorraad['0.02'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['0.02'] * $munt), 2);
                $muntjesTerug['0.02'] = $aantal;
            }
        }

        $munt = 0.01;

        if ($terug >= $munt && $muntjesVoorraad['0.01'] > 0) {
            
            $aantal = floor($terug / $munt);
            
            if ($muntjesVoorraad['0.01'] >= $aantal && $aantal > 0) {
                
                $terug = round($terug - ($aantal * $munt), 2);
                $muntjesTerug['0.01'] = $aantal;
            } else if ($muntjesVoorraad['0.01'] > 0 && $muntjesVoorraad['0.01'] < $aantal && $aantal > 0) {
                
                $terug = round($terug - ($muntjesVoorraad['0.01'] * $munt), 2);
                $muntjesTerug['0.01'] = $aantal;
            }
        }

        return $muntjesTerug;
    }

}
