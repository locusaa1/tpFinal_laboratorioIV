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

    //recivo por get un strin, con barras separando la acción del cuit
    //rompo el string en un array con explode
    //me fijo qué acción desea el usuario
    //según la acción redirijo a donde sea necesario
    public function ActionProcess($action)
    {
        $values=explode('/',$_GET['action']);
        if ($values[0]=='update'){

            $this->updateEnterprise($values[1]);
            die(var_dump($values));
        }elseif($values[0]=='delete'){

            $this->deleteEnterprise($values[1]);
        }else{

            $this->addEnterprise();
        }
        /*if ($_GET['action'] == 'delete') {

            $this->deleteEnterprise();
        } elseif ($_GET['action'] == 'update') {

            $_GET['update'] = $this->enterpriseDAO->getSpecificEnterpriseByCuit($_GET['enterpriseCuit']);
            require_once(VIEWS_PATH . 'AdminEnterpriseCreate.php');
        }else{

            require_once (VIEWS_PATH. 'AdminEnterpriseCreate.php');
        }*/
    }

    public function addEnterprise()
    {
        require_once(VIEWS_PATH . 'AdminEnterpriseCreate.php');
    }

    private function updateEnterprise($cuit){

        $_GET['update']=$this->enterpriseDAO->getSpecificEnterpriseByCuit($cuit);
        require_once (VIEWS_PATH.'AdminEnterpriseCreate.php');
    }

    private function deleteEnterprise($cuit)
    {
        $_GET['delete'] = $this->enterpriseDAO->deleteByCuit($cuit);
        $list = $this->enterpriseDAO->getAll();
        require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
    }

    public function Add($name, $cuit, $phoneNumber, $addressName, $addressNumber)
    {
        $newEnterprise = new Enterprise();
        $newEnterprise->setName($name);
        $newEnterprise->setCuit($cuit);
        $newEnterprise->setPhoneNumber($phoneNumber);
        $newEnterprise->setAddressName($addressName);
        $newEnterprise->setAddressNumber($addressNumber);

        if (isset($_SESSION['updateEnterprise'])) {

            $newEnterprise->setIdEnterprise($_SESSION['updateEnterprise']->getIdEnterprise());
            $this->enterpriseDAO->updateEnterprise($newEnterprise, $_SESSION['updatePosition']);
            unset($_SESSION['updateEnterprise']);
            unset($_SESSION['updatePosition']);
            $_SESSION['update'] = true;
        } else {

            $this->enterpriseDAO->addEnterprise($newEnterprise);
        }
        require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
    }

    public function FilterByName($name)
    {
        $enterpriseList = $this->enterpriseDAO->getAll();
        $_GET['getIn'] = 1;
        $_SESSION['similarArray'] = array();
        foreach ($enterpriseList as $enterprise) {

            if (stripos($enterprise->getName(), $name) !== false) {

                array_push($_SESSION['similarArray'], $enterprise);
            }
        }
        require_once(VIEWS_PATH . 'studentEnterpriseList.php');
    }

    public function EnterpriseDetails($name)
    {
        $enterprise = $this->enterpriseDAO->GetByName($name);
        if ($enterprise) {
            $_GET['enterpriseForDetail'] = $enterprise;
            require_once(VIEWS_PATH . "enterpriseDetails.php");
        }
    }
}