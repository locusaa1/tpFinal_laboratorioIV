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

    public function addEnterprise(Enterprise $enterprise)
    {
        $this->loadData();
        array_push($this->enterpriseList, $enterprise);
        $this->saveData();
    }

    public function getAll()
    {
        $this->loadData();
        return $this->enterpriseList;
    }

    public function deleteByCuit($cuit)
    {
        $deleted = false;
        $this->loadData();
        for ($c = 0; $c < count($this->enterpriseList); $c++) {

            if ($this->enterpriseList[$c]->getCuit() == $cuit) {
                array_splice($this->enterpriseList, $c, 1);
                $deleted=true;
            }
        }
        $this->saveData();
        return $deleted;
    }

    public function getSpecificPositionByCuit($cuit){
        //valor a retornar es la posición a reemplazar de la empresa
        //levantar toda la info
        //comparar hasta dar con el objeto que quiero
        //devolver la posición en la que se encuentra
    }

    public function __construct()
    {
        $this->fileName = ROOT . "Data/enterprises.json";
    }
}