<?php


namespace Controllers;

use DAO\JobPositionDAO as JobPositionDAO;
use DAO\JobPositionDB_DAO as JobPositionDB_DAO;
use Models\JobPosition as JobPosition;

class JobPositionController
{
    private $jobPositionDAO;
    private $jobPositionDB_DAO;

    public function __construct()
    {
        $this->jobPositionDAO = new JobPositionDAO();
        $this->jobPositionDB_DAO = new JobPositionDB_DAO();
    }

    public function jobPositionList()
    {
        return $this->jobPositionDB_DAO->getAll();
        
    }

    public function jobPositionsFromApiToDB (){
       
        $list = $this->jobPositionDAO->GetAll();

        foreach($list as $jobPosition){

            $this->jobPositionDB_DAO->add($jobPosition);
        }
    }


}

?>