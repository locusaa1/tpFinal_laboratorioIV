<?php


namespace Controllers;

use DAO\JobPositionDAO as JobPositionDAO;
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


}

?>