<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use Models\Career as Career;

class CareerController
{
    private $careerDAO;

    public function __construct()
    {
        $this->careerDAO = new CareerDAO();
    }

    public function careerList()
    {
        return $this->careerDAO->getAllFromDB();
    }

    public function careersFromApiToDB (){
       
        $list = $this->careerDAO->getAllFromApi();

        foreach($list as $career){

            $this->careerDAO->add($career);
        }
    }


}

?>