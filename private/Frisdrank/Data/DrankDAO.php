<?php

namespace Frisdrank\Data;

use Frisdrank\Data\DBConfig;
use Frisdrank\Entities\Drank;
use PDO;

/**
 * Description of DrankDAO
 *
 * @author gevapo 
 */
class DrankDAO
{

    public function getById($id)
    {
        $sql = "SELECT naam, pic, prijs, voorraad FROM dranken WHERE id = :id";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array('id' => $id));

        $resultset = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

        $drank = new Drank();
        $drank->createDrank($resultset["naam"], $resultset["pic"], $resultset["prijs"], $resultset["voorraad"]);
        $drank->setId($id);

        return $drank;
    }

    public function getAll()
    {
        $sql = "SELECT id, naam, pic, prijs, voorraad FROM dranken ORDER BY prijs DESC";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultset = $dbh->query($sql);

        $lijst = array();

        foreach ($resultset as $rij) {
            $drank = new Drank();
            $drank->createDrank($rij["naam"], $rij["pic"], $rij["prijs"], $rij["voorraad"]);
            $drank->setId($rij["id"]);
            array_push($lijst, $drank);
        }

        $dbh = null;
        return $lijst;
    }

    public function decreaseByOne($drank)
    {
        //$drank = $this->getById($id);
        $id = $drank->getId();
        /*//
        echo '<pre>';
        var_dump($drank);
        echo '</pre>';
        
        //*/

        if ($drank->getVoorraad() > 0) {
            $sql = "UPDATE dranken SET voorraad = voorraad - 1 WHERE id = $id ";

            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $resultset = $dbh->query($sql);
            //echo 'resultset ' . $resultset;
        }
        
        $drank = $this->getById($id);
        
        
    }

}
