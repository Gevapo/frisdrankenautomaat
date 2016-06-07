<?php

namespace Frisdrank\Business;

use Frisdrank\Data\DrankDAO;

/**
 * Description of DrankService
 *
 * @author gevapo
 */
class DrankService
{

    private $drankDAO;

    public function __construct()
    {
        $this->drankDAO = new DrankDAO();
    }

    /**
     * 
     * @return Drank Array()
     */
    public function getAll()
    {
        return $this->drankDAO->getAll();
    }
    
    /**
     * 
     * @param int $id
     * @return Drank 
     */
    public function getById($id)
    {
        return $this->drankDAO->getById($id);
    }
    
    public function decreaseDrankVoorraadByOne($drank)
    {
        $this->drankDAO->decreaseByOne($drank);
    }
}
