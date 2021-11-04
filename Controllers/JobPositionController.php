<?php


namespace Controllers;

use DAO\JobPositionDAO as JobPositionDAO;
use Controllers\CareerController as CareerController;
use Models\JobPosition as JobPosition;

class JobPositionController
{
    private $jobPositionDAO;

    public function __construct()
    {
        $this->jobPositionDAO = new JobPositionDAO();
    }

    public function jobPositionList()
    {
        return $this->jobPositionDAO->getAllFromDB();
        
    }

    public function jobPositionsFromApiToDB (){
       
        $list = $this->jobPositionDAO->getAllFromApi();

        foreach($list as $jobPosition){

            $this->jobPositionDAO->add($jobPosition);
        }
    }

    public function getJobPositionsByCareer($idCareer)
    {
        return $this->jobPositionDAO->jobPositionsByCareer($idCareer);
    }

    public function getJobPositionsByWord($word)
    {
        $jobPositionList = $this->jobPositionList();

        $filterJobPositionList = array();

        foreach ($jobPositionList as $jobPosition) {

            if (stripos($jobPosition->getDescription(), $word) !== false) {

                array_push($filterJobPositionList, $jobPosition);
            }
        }

        return $filterJobPositionList;
    }

    public function getJobPositionDescriptionById ($jobPositionId)
    {
        $jobPositionList = $this->jobPositionList();

        $description = null;
        
        foreach ($jobPositionList as $jobPosition) {

            if ($jobPosition->getJobPositionId()==$jobPositionId) {

                $description = $jobPosition->getDescription();
            }
        }

        return $description;
    }

    public function getJobPositionCareerByJobPositionId ($jobPositionId)
    {
        $careerController = new CareerController();

        $jobPositionCareer = null;

        foreach($this->jobPositionList() as $jobPosition)
        {
            if($jobPosition->getJobPositionId()==$jobPositionId)
            {
                $jobPositionCareer = $careerController->getCareerById ($jobPosition->getCareerId());
            }
        }

        return $jobPositionCareer;
    }

    public function updateJobPositionDB ()
    {
        $apiList = $this->jobPositionDAO->getAllFromApi();

        $dBList = $this->jobPositionDAO->getAllFromDB();

        foreach($apiList as $apiJobPosition){

            foreach($dBList as $dbJobPosition){

                if($apiJobPosition->getJobPositionId()==$dbJobPosition->getJobPositionId())
                {
                    if(strcmp($apiJobPosition->getDescription(), $dbJobPosition->getDescription())!=0)
                    {
                        $this->jobPositionDAO->updateJobPositionDescription($apiJobPosition->getDescription(), $apiJobPosition->getJobPositionId());
                    }

                    if($apiJobPosition->getCareerId()!=$dbJobPosition->getCareerId())
                    {
                        $this->jobPositionDAO->updateJobPositionCareer($apiJobPosition->getCareerId(), $apiJobPosition->getJobPositionId());
                    }
                }

            }
        }

        if(sizeof($apiList)>sizeof($dBList))
        {
            
            for($i=sizeof($dBList); $i<=sizeof($apiList); $i++)
            {
                $this->jobPositionDAO->add($apiList[$i]);
            }
            
        }

    }


}

?>