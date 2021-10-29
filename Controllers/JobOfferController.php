<?php

namespace Controllers;

use DAO\JobOfferDB_DAO as JobOfferDB_DAO;
use Controllers\JobPositionController as JobPositionController;
use Controllers\CareerController as CareerController;
use Controllers\EnterpriseController as EnterpriseController;
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

    public function filterJobOffersByWord($word, $jobOfferList)
    {
        $jobPositionController = new JobPositionController();

        $jobPositionList = $jobPositionController->getJobPositionsByWord($word);

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

        return $jobPositionController->getJobPositionCareerByJobPositionId ($idJobPosition);
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

    
    public function jobOfferPresentation ($jobOfferId)
    {
        $jobOffer = $this->jobOfferById($jobOfferId);

        echo "Empresa: " . ($this->jobOfferEnterpriseByEnterpriseId($jobOffer->getIdEnterprise()))->getName() . "<br>";
        echo "Posición: " . $this->jobOfferJobPositionDescription ($jobOffer->getIdJobPosition()) . "<br>";
        echo "Carrera: " . ($this->jobOfferCareer ($jobOffer->getIdJobPosition()))->getDescription() . "<br>";
        echo "Descripción: " . $jobOffer->getDescription() . "<br>"; 
        echo "Salario: " . settype($jobOffer->getSalary(), 'string') . "<br>";
        echo "Fecha de publicación: " . $jobOffer->getStartDate() . "<br>";
        echo "Fecha de cierre: " . $jobOffer->getLimitDate() . "<br>";

    }

    public function jobOfferStudentView()
    {
        $careerController = new CareerController();
        $careerList = $careerController->careerList();
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->enterpriseListJobOfferFilterStudent();
        require_once(VIEWS_PATH . "studentOffersView.php");
    }

    public function jobOfferEnterpriseByEnterpriseId($enterpriseId)
    {
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->enterpriseListJobOfferFilterStudent();

        $enterpriseFounded=null;

        foreach ($enterpriseList as $enterprise){
            if($enterprise->getIdEnterprise()==$enterpriseId)
            {
                $enterpriseFounded = $enterprise;
            }
        }
        
        return $enterpriseFounded;
    }

    public function studentJobOffersFilterList($careerFilter, $enterpriseFilter, $keyWordFilter)
    {
        
        $jobPositionController = new JobPositionController();

        $jobOfferList = $this->jobOfferList();

        $filterList=null;

        if($careerFilter!='')
        {
            $iterator = 0;
            foreach($jobOfferList as $jobOffer)
            {
                $career = $jobPositionController->getJobPositionCareerByJobPositionId ($jobOffer->getIdJobPosition());
                if(strcmp($career->getDescription(), $careerFilter)!=0)
                {
                    unset($jobOfferList[$iterator]);
                }
                $iterator++;
            }
            
        }

        if($enterpriseFilter!='')
        {
            $jobOfferList = array_values($jobOfferList);
            $iterator = 0;
            foreach($jobOfferList as $jobOffer)
            {
                $enterprise = $this->jobOfferEnterpriseByEnterpriseId($jobOffer->getIdEnterprise());
                
                if(strcmp($enterprise->getName(), $enterpriseFilter)!=0)
                {
                    unset($jobOfferList[$iterator]);
                }
                $iterator++;
            }
            
        }

        if($keyWordFilter!='')
        {
            $filterList = $this->filterJobOffersByWord($keyWordFilter, $jobOfferList);
             
        }
        
        if(empty($filterList))
        {
            $filterList = $jobOfferList;
        }

        if(empty($filterList))
        {
            $_GET['noMatchesFounded'] = 1;
        }

        $careerController = new CareerController();
        $careerList = $careerController->careerList();
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->enterpriseListJobOfferFilterStudent();
       
        require_once(VIEWS_PATH . "studentOffersView.php");
    }
}

?>