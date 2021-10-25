<?php

namespace Controllers;

use DAO\JobOfferDB_DAO as JobOfferDB_DAO;
use Controllers\JobPositionController as JobPositionController;
use Models\JobOffer as JobOffer;

class JobOfferController
{
    private $jobOfferDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDB_DAO();
    }

    public function jobOfferList()
    {
        return $this->jobOfferDAO->getAll();
    }

    public function newJobOffer($jobOffer)
    {
        $this->jobOfferDAO->add($jobOffer);
    }

    public function filterJobOffersByCareer($careerId)
    {
        $jobPositionController = new JobPositionController();

        $jobPositionByCareerList = $jobPositionController->getJobPositionsByCareer($careerId);

        $jobOfferByCareerList = array();

        foreach ($this->jobOfferList() as $jobOffer) 
        {
            foreach ($jobPositionByCareerList as $jobPosition)
            {
                if ($jobOffer->getIdJobPosition()==$jobPosition->getJobPositionId()) 
                {
                    array_push($jobOfferByCareerList, $jobOffer);
                }
            }
        }
        
        return $jobOfferByCareerList;
    }

    public function filterJobOffersByWord($word)
    {
        $jobPositionController = new JobPositionController();

        $jobPositionList = $jobPositionController->getJobPositionsByWord($word);

        $jobOfferList = $this->jobOfferList();

        $filterjobOfferByWordList = array();

        foreach ($jobOfferList as $jobOffer) 
        {
            foreach ($jobPositionList as $jobPosition)
            {
                if($jobOffer->getIdJobPosition()==$jobPosition->getJobPositionId())
                {
                    array_push($filterjobOfferByWordList , $jobOffer);
                }
            }
            
        }

        return $filterjobOfferByWordList;
    }

    public function jobOfferJobPositionDescription ($idJobPosition)
    {
        $jobPositionController = new JobPositionController();

        return $jobPositionController->getJobPositionDescriptionById ($idJobPosition);
    }

    public function jobOfferCareer ($idJobPosition)
    {
        $jobPositionController = new JobPositionController();

        return $jobPositionController->getJobPositionCareerByJobPositionId ($jobPositionId);
    }

    public function jobOfferById ($jobOfferId)
    {
        $jobOfferById = null;

        foreach ($this->jobOfferList() as $jobOffer) 
        {
            if($jobOffer->getIdJobOffer()==$jobOfferId)
            {
                $jobOfferById = $jobOffer;
            }
            
        }

        return $jobOfferById;
    }

    //ver
    public function jobOfferPresentation ($jobOfferId)
    {
        $jobOffer = $this->jobOfferById($jobOfferId);

        echo "Empresa: "; //pendiente
        echo "Posición: " . $this->jobOfferJobPositionDescription ($jobOffer->getIdJobPosition());
        echo "Carrera: " . $this->jobOfferCareer ($jobOffer->getIdJobPosition());
        echo "Descripción: " . $jobOffer->getDescription(); 
        echo "Salario: " . $jobOffer->getSalary();
        echo "Fecha de publicación: " . $jobOffer->getStartDate();
        echo "Fecha de cierre: " . $jobOffer->getLimitDate();

    }


}

?>