<?php


namespace Controllers;

use DAO\EnterpriseDAO as EnterpriseDAO;
use DAO\EnterpriseDB_DAO as EnterpriseDB;
use Models\Enterprise as Enterprise;
use Exception as Exception;

class EnterpriseController
{
    private $enterpriseDB;

    public function getAllEnterprises()
    {
        return $this->enterpriseDB->getAll();
    }

    /**
     * EnterpriseController constructor.
     */
    public function __construct()
    {
        $this->enterpriseDB = new EnterpriseDB();
    }

    public function addEnterprise()
    {
        require_once(VIEWS_PATH . 'AdminEnterpriseCreate.php');
    }

    public function updateEnterprise()
    {

        $enterprise = $this->enterpriseDB->getSpecificEnterpriseByCuit($_GET['enterpriseCuit']);
        require_once(VIEWS_PATH . 'AdminEnterpriseUpdate.php');
    }

    public function enterpriseList()
    {
        $list = $this->enterpriseDB->getAll();
        require_once(VIEWS_PATH . "AdminEnterpriseList.php");
    }

    public function deleteEnterprise($cuit)
    {
        $message = null;
        $errorMessage = null;
        try {

            $this->enterpriseDB->deleteByCuit($cuit);
            $message = 'La empresa fue exitosamente borrada';
        } catch (Exception $exception) {

            $errorMessage = 'Hubo un problema, la empresa no fue borrada';
        } finally {

            $list = $this->enterpriseDB->getAll();
            require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
        }
    }

    public function enterpriseForm($name, $cuit, $phoneNumber, $addressName, $addressNumber, $action)
    {
        $newEnterprise = new Enterprise();
        $message = null;
        $errorMessage = null;

        try {
            if ($action == 'update') {

                $oldEnterprise = $this->enterpriseDB->getSpecificEnterpriseByCuit($cuit);
                $newEnterprise->setIdEnterprise($oldEnterprise->getIdEnterprise());
                $newEnterprise->setCuit($oldEnterprise->getCuit());
                $newEnterprise->setName($newName = (strcmp('', $name) == 0) ? $oldEnterprise->getName() : $name);
                $newEnterprise->setPhoneNumber($newPhoneNumber = (strcmp('', $phoneNumber) == 0) ? $oldEnterprise->getPhoneNumber() : $phoneNumber);
                $newEnterprise->setAddressName($newAddressName = (strcmp('', $addressName) == 0) ? $oldEnterprise->getAddressName() : $addressName);
                $newEnterprise->setAddressNumber($newAddressNumber = (strcmp('', $addressNumber) == 0) ? $oldEnterprise->getAddressNumber() : $addressNumber);
                $this->enterpriseDB->updateEnterprise($newEnterprise, $oldEnterprise->getCuit());
                $message = 'La empresa fue exitosamente actualizada';
            } else {

                $newEnterprise->setName($name);
                $newEnterprise->setCuit($cuit);
                $newEnterprise->setPhoneNumber($phoneNumber);
                $newEnterprise->setAddressName($addressName);
                $newEnterprise->setAddressNumber($addressNumber);
                $this->enterpriseDB->add($newEnterprise);
                $message = 'La empresa fue agregada con éxito';
            }
        } catch (Exception $exception) {

            $errorMessage = 'El cuit o teléfono ya se encuentra cargado';
        } finally {

            $list = $this->enterpriseDB->getAll();
            require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
        }
    }

    public function FilterByName($name)
    {
        $enterpriseList = $this->enterpriseDB->getAll();

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
        $enterprise = $this->enterpriseDB->GetByName($name);

        require_once(VIEWS_PATH . "enterpriseDetails.php");

    }

    public function getEnterpriseByCuit($id)
    {
        return $this->enterpriseDB->getById($id);
    }

    public function EnterpriseListStudent()
    {
        $list = $this->enterpriseDB->getAll();

        require_once(VIEWS_PATH . "studentEnterpriseList.php");
    }

    public function enterpriseListJobOfferFilterStudent()
    {
        return $this->enterpriseDB->getAll();
    }
}