<?php


namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use DAO\CareerDB_DAO as CareerDB_DAO;
use Models\Career as Career;

class CareerController
{
    private $careerDAO;
    private $careerDB_DAO;

    public function __construct()
    {
        $this->careerDAO = new CareerDAO();
        $this->careerDB_DAO = new CareerDB_DAO();
    }

    public function careerList()
    {
        $list = $this->careerDB_DAO->getAll();
    }

    public function careersFromApiToDB (){
       
        $list = $this->careerDAO->GetAll();

        foreach($list as $career){

            $this->careerDB_DAO->add($career);
        }
    }


}

?>