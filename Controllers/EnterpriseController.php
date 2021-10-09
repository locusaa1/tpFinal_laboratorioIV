<?php


namespace Controllers;

use DAO\EnterpriseDAO as EnterpriseDAO;

class EnterpriseController
{
    private $enterpriseDAO;

    /**
     * EnterpriseController constructor.
     */
    public function __construct()
    {
        $this->enterpriseDAO = new EnterpriseDAO();
    }

    public function getEnterprisesList()
    {
        return $this->enterpriseDAO->getAll();
    }

    public function ActionProcess($action, $enterpriseCuit)
    {
        if ($action == 'delete') {

            $_SESSION['delete']=$this->enterpriseDAO->deleteByCuit($enterpriseCuit);
            require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
        } elseif ($action == 'update') {

        } else {

        }
    }
}