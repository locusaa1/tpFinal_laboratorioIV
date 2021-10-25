<?php


namespace Controllers;

use DAO\EnterpriseDAO as EnterpriseDAO;
use DAO\EnterpriseDB_DAO as EnterpriseDB;
use Models\Enterprise as Enterprise;

class EnterpriseController
{
    private $enterpriseDAO;
    private $enterpriseDB;

    /**
     * EnterpriseController constructor.
     */
    public function __construct()
    {
        $this->enterpriseDAO = new EnterpriseDAO();
        $this->enterpriseDB = new EnterpriseDB();
    }

    public function actionProcess($action)
    {
        $values = explode('/', $_GET['action']);
        if ($values[0] == 'update') {

            $this->updateEnterprise($values[1]);
        } elseif ($values[0] == 'delete') {

            $this->deleteEnterprise($values[1]);
        } else {

            $this->addEnterprise();
        }

    }

    public function addEnterprise()
    {
        require_once(VIEWS_PATH . 'AdminEnterpriseCreate.php');
    }

    private function updateEnterprise($cuit)
    {

        $_GET['update'] = $this->enterpriseDB->getSpecificEnterpriseByCuit($cuit);
        require_once(VIEWS_PATH . 'AdminEnterpriseUpdate.php');
    }

    public function enterpriseList()
    {
        $list = $this->enterpriseDB->getAll();
        require_once(VIEWS_PATH . "AdminEnterpriseList.php");
    }

    private function deleteEnterprise($cuit)
    {
        $_GET['delete'] = $this->enterpriseDB->deleteByCuit($cuit);
        $list = $this->enterpriseDB->getAll();
        require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
    }

    public function enterpriseForm($name, $cuit, $phoneNumber, $addressName, $addressNumber, $action)
    {
        $newEnterprise = new Enterprise();

        if ($action == 'update') {

            $oldEnterprise = $this->enterpriseDB->getSpecificEnterpriseByCuit($cuit);
            $newEnterprise->setIdEnterprise($oldEnterprise->getIdEnterprise());
            $newEnterprise->setCuit($oldEnterprise->getCuit());
            $newEnterprise->setName($newName = (strcmp('', $name) == 0) ? $oldEnterprise->getName() : $name);
            $newEnterprise->setPhoneNumber($newPhoneNumber = (strcmp('', $phoneNumber) == 0) ? $oldEnterprise->getPhoneNumber() : $phoneNumber);
            $newEnterprise->setAddressName($newAddressName = (strcmp('', $addressName) == 0) ? $oldEnterprise->getAddressName() : $addressName);
            $newEnterprise->setAddressNumber($newAddressNumber = (strcmp('', $addressNumber) == 0) ? $oldEnterprise->getAddressNumber() : $addressNumber);
            $this->enterpriseDB->updateEnterprise($newEnterprise, $oldEnterprise->getCuit());
            $_GET['update'] = 'true';
        } else {

            $newEnterprise->setName($name);
            $newEnterprise->setCuit($cuit);
            $newEnterprise->setPhoneNumber($phoneNumber);
            $newEnterprise->setAddressName($addressName);
            $newEnterprise->setAddressNumber($addressNumber);
            $_GET['add'] = $this->enterpriseDB->add($newEnterprise);
        }
        $list = $this->enterpriseDB->getAll();
        require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
    }

    public function FilterByName($name)
    {
        $enterpriseList = $this->enterpriseDAO->getAll();

        $_GET['getIn'] = 1;

        $filterEnterpriseList = array();

        foreach ($enterpriseList as $enterprise) {

            if (stripos($enterprise->getName(), $name) !== false) {

                array_push($filterEnterpriseList, $enterprise);
            }
        }

        if (empty($filterEnterpriseList)) {
            $list = $enterpriseList;
        }

        require_once(VIEWS_PATH . 'studentEnterpriseList.php');
    }

    public function EnterpriseDetails($name)
    {
        $enterprise = $this->enterpriseDAO->GetByName($name);

        require_once(VIEWS_PATH . "enterpriseDetails.php");

    }

    public function EnterpriseListStudent()
    {
        $list = $this->enterpriseDAO->getAll();

        require_once(VIEWS_PATH . "studentEnterpriseList.php");
    }
}