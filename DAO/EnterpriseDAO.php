<?php


namespace DAO;

use Models\Enterprise as Enterprise;
use DAO\IEnterpriseDAO as IEnterpriseDAO;

class EnterpriseDAO implements IEnterpriseDAO
{
    private $enterpriseList = array();
    private $fileName;

    private function loadData()
    {
        $this->enterpriseList = array();
        if (file_exists($this->fileName)) {

            $content = file_get_contents($this->fileName);
            $decodedArray = ($content) ? json_decode($content, true) : array();
            foreach ($decodedArray as $enterprise) {

                $newEnterprise = new Enterprise();
                $newEnterprise->setIdEnterprise($enterprise['idEnterprise']);
                $newEnterprise->setName($enterprise['name']);
                $newEnterprise->setCuit($enterprise['cuit']);
                $newEnterprise->setPhoneNumber($enterprise['phoneNumber']);
                $newEnterprise->setAddressName($enterprise['addressName']);
                $newEnterprise->setAddressNumber($enterprise['addressNumber']);
                array_push($this->enterpriseList, $newEnterprise);
            }
        }
    }

    private function saveData()
    {
        $arrayToEncode = array();
        foreach ($this->enterpriseList as $enterprise) {

            $newEnterprise['idEnterprise'] = $enterprise->getIdEnterprise();
            $newEnterprise['name'] = $enterprise->getName();
            $newEnterprise['cuit'] = $enterprise->getCuit();
            $newEnterprise['phoneNumber'] = $enterprise->getPhoneNumber();
            $newEnterprise['addressName'] = $enterprise->getAddressName();
            $newEnterprise['addressNumber'] = $enterprise->getAddressNumber();
            array_push($arrayToEncode, $newEnterprise);
        }
        $content = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $content);
    }

    public function updateEnterprise(Enterprise $enterprise, $position)
    {
        $this->loadData();
        array_splice($this->enterpriseList, $position, 1, array($enterprise));
        $this->saveData();
    }

    public function deleteByCuit($cuit)
    {
        $deleted = false;
        $this->loadData();
        for ($c = 0; $c < count($this->enterpriseList); $c++) {

            if ($this->enterpriseList[$c]->getCuit() == $cuit) {
                array_splice($this->enterpriseList, $c, 1);
                $deleted = true;
            }
        }
        $this->saveData();
        return $deleted;
    }

    public function add(Enterprise $enterprise)
    {
        $this->loadData();
        $confirm = false;
        $validation = $this->cuitExists($enterprise->getCuit());
        if ($validation==false) {

            array_push($this->enterpriseList, $enterprise);
            $this->saveData();
            $confirm=true;
        }
        return $confirm;
    }

    public function getAll()
    {
        $this->loadData();
        return $this->enterpriseList;
    }

    public function getSpecificEnterpriseByCuit($cuit)
    {
        $value = new Enterprise();
        $this->loadData();
        for ($c = 0; $c < count($this->enterpriseList); $c++) {

            if ($this->enterpriseList[$c]->getCuit() == $cuit) {

                $value = $this->enterpriseList[$c];
            }
        }
        return $value;
    }

    public function cuitExists($cuit)
    {
        $confirm = false;
        $c = 0;
        $this->loadData();

        while ($c < count($this->enterpriseList) && $confirm == false) {

            if ($this->enterpriseList[$c]->getCuit() == $cuit) {

                $confirm = true;
            }
            $c++;
        }
        return $confirm;
    }

    public function __construct()
    {
        $this->fileName = ROOT . "Data/enterprises.json";
    }

    public function GetByName($name)
    {
        $this->loadData();
        $enterpriseFounded = null;

        if (!empty($this->enterpriseList)) {
            foreach ($this->enterpriseList as $enterprise) {
                if ($enterprise->getName() == $name) {
                    $enterpriseFounded = $enterprise;
                }
            }
        }

        return $enterpriseFounded;
    }
}