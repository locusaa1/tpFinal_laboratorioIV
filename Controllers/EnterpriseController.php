<?php


namespace Controllers;

use DAO\EnterpriseDAO as EnterpriseDAO;
use Models\Enterprise as Enterprise;

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

            $_SESSION['delete'] = $this->enterpriseDAO->deleteByCuit($enterpriseCuit);
            require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
        } elseif ($action == 'update') {

            $enterprise = $this->enterpriseDAO->getSpecificEnterpriseByCuit($enterpriseCuit);
            $_SESSION['updateEnterprise'] = $enterprise;
            $_SESSION['updatePosition'] = array_search($enterprise, $this->enterpriseDAO->getAll());
            require_once(VIEWS_PATH . 'AdminEnterpriseCreate.php');
        }
    }


    public function FilterByName($name)
    {

        $enterprise = $this->enterpriseDAO->GetByName($name);

        if ($enterprise) {
            $_GET['enterpriseFounded'] = $enterprise;
            require_once(VIEWS_PATH . "studentEnterpriseList.php");
        } else{
            $_GET['enterpriseNotFounded'] = 1;
            require_once(VIEWS_PATH . "studentEnterpriseList.php");
        }

    }

    public function EnterpriseDetails ()
    {
        require_once(VIEWS_PATH . "enterpriseDetails.php");
    }
    
    public function AddProcess()
    {
        require_once(VIEWS_PATH . 'AdminEnterpriseCreate.php');
    }
}