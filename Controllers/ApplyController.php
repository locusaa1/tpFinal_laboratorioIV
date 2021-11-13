<?php

namespace Controllers;

use DAO\ApplyDAO as ApplyDAO;
use Models\Apply as Apply;

class ApplyController
{
    private $applyDAO;

    public function __construct()
    {
        $this->applyDAO = new ApplyDAO();
    }

    public function GetApplyList()
    {
        return $this->applyDAO->getAllFromDB();
    }

    public function GetApplyListByJobOffer($idJobOffer)
    {
        
    }

    public function generateNewApply (Apply $apply)
    {
        $this->applyDAO->add($apply);
    }

    public function verifyIfStudentAlreadyApplyToOffer($idUser, $idJobOffer)
    {
        $applicationFlag = false;

        foreach ($this->GetApplyList() as $apply)
        {
            if($apply->getIdUser()==$idUser && $apply->getIdJobOffer()==$idJobOffer)
            {
                $applicationFlag = true;
            }
        }

        return $applicationFlag;
    }

    public function getJobOffersIdByStudentApplications ()
    {
        $jobOffersIdList = array();

        foreach ($this->GetApplyList() as $apply)
        {
            if($apply->getIdUser()==$_SESSION['user']->getIdUser())
            {
                array_push($jobOffersIdList, $apply->getIdJobOffer());
            }
        }

        return $jobOffersIdList;
    }

}

?>