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

    public function ActionProcess($action)
    {
        $values=explode('/',$_GET['action']);
        if ($values[0]=='update'){

            $this->updateEnterprise($values[1]);
        }elseif($values[0]=='delete'){

            $this->deleteEnterprise($values[1]);
        }else{

            $this->addEnterprise();
        }

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