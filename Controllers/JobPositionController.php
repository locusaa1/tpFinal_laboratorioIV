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


}

?>