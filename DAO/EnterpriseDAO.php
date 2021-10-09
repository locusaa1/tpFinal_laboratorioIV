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
            foreach ($content as $enterprise) {


            }
        }
    }
}