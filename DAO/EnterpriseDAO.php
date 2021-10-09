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
                $newEnterprise->setAddress($enterprise['address']);
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
            $newEnterprise['address'] = $enterprise->getAddress();
            array_push($arrayToEncode, $newEnterprise);
        }
        $content = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $content);
    }

    public function addEnterprise(Enterprise $enterprise)
    {
        $this->loadData();
        array_push($this->enterpriseList,$enterprise);
        $this->saveData();
    }

    public function getAll()
    {
        $this->loadData();
        return $this->enterpriseList;
    }

    public function __construct()
    {
        $this->fileName = ROOT."Data/enterprises.json";
    }
}