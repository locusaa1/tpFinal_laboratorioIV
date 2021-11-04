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

    public function getCareerById ($careerId)
    {
        $careerById = null;

        foreach($this->careerList() as $career)
        {
            if($career->getIdCareer()==$careerId)
            {
                $careerById = $career;
            }
        }

        return $careerById;
    }

    public function updateCareerDB ()
    {
        $apiList = $this->careerDAO->getAllFromApi();

        $dBList = $this->careerDAO->getAllFromDB();

        foreach($apiList as $apiCareer){

            foreach($dBList as $dbCareer){

                if($apiCareer->getIdCareer()==$dbCareer->getIdCareer())
                {
                    if(strcmp($apiCareer->getDescription(), $dbCareer->getDescription())!=0)
                    {
                        $this->careerDAO->updateCareerDescription($apiCareer->getDescription(), $apiCareer->getIdCareer());
                    }

                    if($apiCareer->getActive())
                    {
                        if($dbCareer->getActive()==0)
                        {
                            $this->careerDAO->updateCareerActiveStatus(1, $apiCareer->getIdCareer());
                        }   
                    }else{
                        if($dbCareer->getActive()==1)
                        {
                            $this->careerDAO->updateCareerActiveStatus(0, $apiCareer->getIdCareer());
                        } 
                    }
                }

            }
        }

        if(sizeof($apiList)>sizeof($dBList))
        {
            
            for($i=sizeof($dBList); $i<=sizeof($apiList); $i++)
            {
                $this->careerDAO->add($apiList[$i]);
            }
            
        }

    }

}

?>