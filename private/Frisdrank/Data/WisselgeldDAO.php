<?php

namespace Frisdrank\Data;

use Frisdrank\Data\DBConfig;
use Frisdrank\Entities\Wisselgeld;
use PDO;

/**
 * Description of WisselgeldDAO
 *
 * @author gevapo 
 */
class WisselgeldDAO
{

    public function getByName($naam)
    {
        $sql = "SELECT id, waarde, voorraad FROM wisselgeld WHERE naam = :naam";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array('naam' => $naam));

        $resultset = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

        $wisselgeld = new Wisselgeld();
        $wisselgeld->createWisselgeld($naam, $resultset["waarde"], $resultset["voorraad"]);
        $wisselgeld->setId($resultset["id"]);

        return $wisselgeld;
    }

    public function getVoorraadById()
    {
        
    }

    /**
     * 
     * @return array Wisselgeld
     */
    public function getAll()
    {
        $sql = "SELECT id, naam, waarde, voorraad FROM wisselgeld ORDER BY waarde DESC";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultset = $dbh->query($sql);

        $lijst = array();

        foreach ($resultset as $rij) {
            $wisselGeld = new Wisselgeld();
            $wisselGeld->createWisselgeld($rij["naam"], $rij["waarde"], $rij["voorraad"]);
            $wisselGeld->setId($rij["id"]);
            array_push($lijst, $wisselGeld);
        }

        $dbh = null;
        return $lijst;
    }

    public function updateByWaarde($waarde, $aantal)
    {
        $sql = "UPDATE wisselgeld SET voorraad = voorraad + $aantal WHERE waarde = $waarde";
        //echo "$sql<br>";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultset = $dbh->query($sql);
    }

}
